/**
 * Cart Manager System
 * Handles all cart operations with real-time UI updates
 */
class CartManager {
    constructor() {
        this.isLoading = false;
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateCartCount();
    }

    bindEvents() {
        // Quantity controls
        document.addEventListener('click', (e) => {
            if (e.target.closest('.quantity-btn')) {
                e.preventDefault();
                e.stopPropagation();
                const btn = e.target.closest('.quantity-btn');
                const action = btn.dataset.action;
                const input = btn.closest('.quantity-control').querySelector('input[type="number"]');
                this.handleQuantityChange(input, action);
            }
        });

        // Direct quantity input change
        document.addEventListener('change', (e) => {
            if (e.target.matches('.quantity-control input[type="number"]')) {
                this.handleQuantityChange(e.target);
            }
        });

        // Remove item buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-item')) {
                const btn = e.target.closest('.remove-item');
                this.handleRemoveItem(btn);
            }
        });

        // Add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-add-to-cart')) {
                e.preventDefault();
                const btn = e.target.closest('.btn-add-to-cart');
                this.handleAddToCart(btn);
            }
        });
    }

    async handleQuantityChange(input, action) {
        if (this.isLoading) return;

        // Prevent rapid multiple clicks
        if (input.dataset.updating === 'true') return;
        input.dataset.updating = 'true';

        const currentValue = parseInt(input.value) || 1;
        let newValue = currentValue;

        if (action === 'increase') {
            newValue = Math.min(currentValue + 1, 999);
        } else if (action === 'decrease') {
            newValue = Math.max(currentValue - 1, 1);
        } else {
            // Direct input change
            newValue = Math.max(parseInt(input.value) || 1, 1);
        }

        if (newValue === currentValue) return;

        const row = input.closest('tr');
        const itemId = input.dataset.id;
        const itemType = input.dataset.type || 'products';

        try {
            this.setRowLoading(row, true);

            const response = await this.updateCartItem(itemId, itemType, newValue);

            const isSuccess = response.success === true || response.status === 'success' || response.success === 'true';

            if (isSuccess) {
                input.value = newValue;

                // Update line price immediately
                const row = input.closest('tr');
                const linePriceEl = row.querySelector('.line-price');
                const itemPriceEl = row.querySelector('td:nth-child(2)');

                if (linePriceEl && itemPriceEl) {
                    // Extract price value and calculate line total
                    const priceText = itemPriceEl.textContent.trim();
                    const priceMatch = priceText.match(/[\d,]+\.?\d*/);
                    if (priceMatch) {
                        const unitPrice = parseFloat(priceMatch[0].replace(/,/g, ''));
                        const lineTotal = unitPrice * newValue;
                        const currency = priceText.replace(/[\d,\.]/g, '').trim();
                        linePriceEl.textContent = `${currency}${lineTotal.toLocaleString()}`;
                    }
                }

                this.updateCartDisplay(response.cart?.data || response.data || response.cart);
                // Force immediate cart count update
                setTimeout(() => this.updateCartCount(), 100);
                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'Cart updated successfully');
                }
            } else {
                input.value = currentValue;
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to update cart';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Cart update error:', error);
            input.value = currentValue;
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while updating the cart');
            }
        } finally {
            this.setRowLoading(row, false);
            // Remove updating flag
            input.dataset.updating = 'false';
        }
    }

    async handleRemoveItem(btn) {
        if (this.isLoading) return;

        const row = btn.closest('tr');
        const itemId = btn.dataset.id;
        const itemType = btn.dataset.type || 'products';

        try {
            this.setRowLoading(row, true);

            const response = await this.removeCartItem(itemId, itemType);

            if (response.success || response.status === 'success') {
                // Animate row removal
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '0';

                setTimeout(() => {
                    row.remove();

                    // Update cart display with proper data structure
                    const cartData = response.cart?.data || response.data || response.cart || response;
                    this.updateCartDisplay(cartData);
                    // Force immediate cart count update
                    setTimeout(() => this.updateCartCount(), 100);

                    // Check if cart is empty
                    if (this.isCartEmpty()) {
                        this.showEmptyState();
                    }
                }, 300);

                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'Item removed from cart');
                }
            } else {
                if (window.ToastManager) {
                    window.ToastManager.error(response.message || 'Failed to remove item');
                }
            }
        } catch (error) {
            console.error('Remove item error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while removing the item');
            }
        } finally {
            this.setRowLoading(row, false);
        }
    }

    async handleAddToCart(btn) {
        if (this.isLoading || btn.disabled) return;

        const productId = btn.dataset.id;
        const type = btn.dataset.type || 'products';
        const quantity = parseInt(btn.dataset.qty) || 1;

        try {
            this.setButtonLoading(btn, true);

            const response = await this.addToCart(productId, type, quantity);

            // Handle different response formats - be more flexible with success detection
            const isSuccess = response.status === true ||
                response.status === 'success' ||
                response.success === 'true' ||
                response.success === true ||
                (response.cart && !response.error);

            if (isSuccess) {
                if (window.ToastManager) {
                    const message = response.message || response.data?.message || 'Item added to cart successfully';
                    // Check if message indicates item was already in cart or quantity updated
                    if (message.toLowerCase().includes('already') ||
                        message.toLowerCase().includes('updated') ||
                        message.toLowerCase().includes('quantity')) {
                        window.ToastManager.info(message);
                    } else {
                        window.ToastManager.success(message);
                    }
                }
                // Force immediate cart count update
                setTimeout(() => this.updateCartCount(), 100);
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to add item to cart';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Add to cart error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('Network error occurred while adding to cart');
            }
        } finally {
            this.setButtonLoading(btn, false);
        }
    }

    async addToCart(productId, type, quantity) {
        const response = await fetch('/ajax/cart/add-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: productId,
                type: type,
                quantity: quantity
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return response.json();
    }

    async updateCartItem(itemId, type, quantity) {
        const response = await fetch('/ajax/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: itemId,
                type: type,
                quantity: quantity
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return response.json();
    }

    async removeCartItem(itemId, type) {
        const response = await fetch('/ajax/cart/remove-item', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: itemId,
                type: type
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return response.json();
    }

    async updateCartCount() {
        try {
            const response = await fetch('/ajax/cart/get-items', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
    
            if (response.ok) {
                const data = await response.json();
                // Try multiple possible count sources
                const count = data.total_items ||
                    data.count ||
                    data.item_count ||
                    (data.items && data.items.items ? data.items.items.length : 0) ||
                    (data.data ? data.data.total_items : 0) ||
                    0;
                this.setCartCount(count);
            }
        } catch (error) {
            console.error('Error updating cart count:', error);
        }
    }

    setCartCount(count) {
        const cartCounters = document.querySelectorAll('.cart-count');
        cartCounters.forEach(counter => {
            counter.textContent = count;
            counter.style.display = count > 0 ? '' : 'none';
        });
    }

    updateCartDisplay(cartData) {
        if (!cartData) return;

        // Handle nested data structures
        const data = cartData.data || cartData;
        const pricing = data.pricing || data;

        // Update subtotal
        const subtotalElements = document.querySelectorAll('[data-cart-subtotal]');
        subtotalElements.forEach(el => {
            const subtotal = pricing.subtotal_formatted ||
                pricing.subtotal ||
                data.subtotal ||
                data.total_price;
            if (subtotal) {
                el.textContent = subtotal;
            }
        });

        // Update total
        const totalElements = document.querySelectorAll('[data-cart-total]');
        totalElements.forEach(el => {
            const total = pricing.total_formatted ||
                pricing.total ||
                data.total ||
                data.total_price;
            if (total) {
                el.textContent = total;
            }
        });

        // Update discount
        const discountElements = document.querySelectorAll('[data-cart-discount]');
        const discountRows = document.querySelectorAll('.discount-row');

        const discount = pricing.discount_formatted ||
            pricing.discount ||
            data.discount ||
            data.total_discount;

        if (discount && discount !== "$0.00" && discount !== "0") {
            discountElements.forEach(el => {
                el.textContent = '-' + discount;
            });
            discountRows.forEach(row => {
                row.style.display = '';
            });
        } else {
            discountRows.forEach(row => {
                row.style.display = 'none';
            });
        }

        // Update individual item line prices
        const rows = document.querySelectorAll('#cartItemsList tr');
        rows.forEach(row => {
            const itemId = row.dataset.itemId;
            const itemType = row.dataset.itemType;
            const itemKey = `${itemType}_${itemId}`;

            // Try multiple possible data structures
            let itemData = null;
            if (data.items && data.items[itemKey]) {
                itemData = data.items[itemKey];
            } else if (cartData.items && cartData.items[itemKey]) {
                itemData = cartData.items[itemKey];
            }

            if (itemData && itemData.line_price) {
                const linePriceEl = row.querySelector('.line-price');
                if (linePriceEl) {
                    linePriceEl.textContent = itemData.line_price_formatted || itemData.line_price;
                }
            }
        });

        // Update cart count with multiple fallbacks
        const count = data.total_items ||
            data.count ||
            data.item_count ||
            cartData.total_items ||
            cartData.count ||
            0;
        this.setCartCount(count);
    }

    setRowLoading(row, isLoading) {
        if (!row) return;

        if (isLoading) {
            row.style.opacity = '0.6';
            row.style.pointerEvents = 'none';

            // Add skeleton loading effect
            const overlay = document.createElement('div');
            overlay.className = 'loading-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center';
            overlay.style.cssText = 'top: 0; left: 0; background: rgba(255,255,255,0.8); z-index: 10;';
            overlay.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';

            row.style.position = 'relative';
            row.appendChild(overlay);
        } else {
            row.style.opacity = '';
            row.style.pointerEvents = '';

            const overlay = row.querySelector('.loading-overlay');
            if (overlay) {
                overlay.remove();
            }
        }
    }

    setButtonLoading(button, isLoading) {
        if (!button) return;

        const originalText = button.dataset.originalText || button.innerHTML;

        if (isLoading) {
            button.dataset.originalText = originalText;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
            button.style.minWidth = button.offsetWidth + 'px';
        } else {
            button.disabled = false;
            button.innerHTML = originalText;
            button.style.minWidth = '';
        }
    }

    isCartEmpty() {
        const cartRows = document.querySelectorAll('#cartItemsList tr');
        return cartRows.length === 0;
    }

    showEmptyState() {
        const cartItems = document.getElementById('cartItems');
        if (cartItems) {
            cartItems.innerHTML = `
                <div class="empty-cart-state text-center py-5">
                    <div class="empty-cart-icon mb-4">
                        <i class="fa fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h4 class="mb-3">Your cart is empty</h4>
                    <a href="/products" class="thm-btn">
                        Continue Shopping
                        <span class="icon-right-arrow"></span>
                    </a>
                </div>
            `;
        }
    }
}

// Initialize cart manager when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeCartManager);
} else {
    initializeCartManager();
}

function initializeCartManager() {
    window.CartManager = new CartManager();

    // Global function for backward compatibility
    window.addToCart = function (postId, type = 'products', quantity = 1) {
        if (window.CartManager) {
            const btn = document.createElement('button');
            btn.dataset.id = postId;
            btn.dataset.type = type;
            btn.dataset.qty = quantity;
            window.CartManager.handleAddToCart(btn);
        }
    };
} 