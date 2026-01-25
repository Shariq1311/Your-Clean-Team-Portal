class WishlistManager {
    constructor() {
        this.isLoading = false;
        this.init();
    }

    init() {
        this.bindEvents();
        this.setupGlobalFunction();
    }

    bindEvents() {
        // Add to wishlist button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-add-to-wishlist')) {
                e.preventDefault();
                e.stopPropagation();
                const button = e.target.closest('.btn-add-to-wishlist');
                this.handleAddToWishlist(button);
            }
        });

        // Remove from wishlist button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-wishlist-item')) {
                e.preventDefault();
                e.stopPropagation();
                const button = e.target.closest('.remove-wishlist-item');
                this.handleRemoveFromWishlist(button);
            }
        });

        // Move to cart button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-move-to-cart')) {
                e.preventDefault();
                e.stopPropagation();
                const button = e.target.closest('.btn-move-to-cart');
                this.handleMoveToCart(button);
            }
        });

        // Move all to cart button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-move-all-to-cart')) {
                e.preventDefault();
                e.stopPropagation();
                this.handleMoveAllToCart();
            }
        });

        // Clear wishlist button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-clear-wishlist')) {
                e.preventDefault();
                e.stopPropagation();
                this.handleClearWishlist();
            }
        });
    }

    setupGlobalFunction() {
        // Global function for adding to wishlist
        window.addToWishlist = (postId, type) => {
            const button = document.createElement('button');
            button.dataset.id = postId;
            button.dataset.type = type || 'products';
            this.handleAddToWishlist(button);
        };
    }

    async handleAddToWishlist(button) {
        if (this.isLoading) return;
    
        const productId = button.dataset.id;
        const type = button.dataset.type || 'products';
    
        if (!productId) {
            if (window.ToastManager) {
                window.ToastManager.error('Invalid product ID');
            }
            return;
        }
    
        try {
            this.setButtonLoading(button, true);
    
            const response = await this.addToWishlist(productId, type);
            
            // Fixed success detection - check for status: true instead of success
            const isSuccess = response.status === true || response.status === 'success';
    
            if (isSuccess) {
                if (window.ToastManager) {
                    const message = response.data?.message || response.message || 'Item added to wishlist successfully';
                    // Check if message indicates item was already in wishlist
                    if (message.toLowerCase().includes('already')) {
                        window.ToastManager.info(message);
                    } else {
                        window.ToastManager.success(message);
                    }
                }
                this.updateWishlistCount();
                this.updateWishlistButtonState(button, true);
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.data?.message || response.message || response.error || 'Failed to add item to wishlist';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Add to wishlist error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while adding to wishlist');
            }
        } finally {
            this.setButtonLoading(button, false);
        }
    }

    async handleRemoveFromWishlist(button) {
        if (this.isLoading) return;

        const productId = button.dataset.id;
        const type = button.dataset.type || 'products';
        const row = button.closest('tr');

        if (!productId) {
            if (window.ToastManager) {
                window.ToastManager.error('Invalid product ID');
            }
            return;
        }

        try {
            this.setRowLoading(row, true);

            const response = await this.removeFromWishlist(productId, type);

            const isSuccess = response.success === true || response.status === 'success';

            if (isSuccess) {
                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'Item removed from wishlist successfully');
                }

                // Animate row removal
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '0';

                setTimeout(() => {
                    row.remove();
                    this.updateWishlistCount();

                    // Check if wishlist is empty
                    if (this.isWishlistEmpty()) {
                        this.showEmptyState();
                    }
                }, 300);
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to remove item';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Remove wishlist error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while removing item');
            }
        } finally {
            this.setRowLoading(row, false);
        }
    }

    async handleMoveToCart(button) {
        if (this.isLoading) return;

        const productId = button.dataset.id;
        const type = button.dataset.type || 'products';
        const quantity = button.dataset.qty || 1;
        const row = button.closest('tr');

        try {
            this.setButtonLoading(button, true);

            const response = await this.moveToCart(productId, type, quantity);

            const isSuccess = response.success === true || response.status === 'success';

            if (isSuccess) {
                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'Item moved to cart successfully');
                }

                // Animate row removal
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '0';

                setTimeout(() => {
                    row.remove();
                    this.updateWishlistCount();
                    // Update cart count if CartManager exists
                    if (window.CartManager) {
                        window.CartManager.updateCartCount();
                    }

                    // Check if wishlist is empty
                    if (this.isWishlistEmpty()) {
                        this.showEmptyState();
                    }
                }, 300);
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to move item to cart';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Move to cart error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while moving item to cart');
            }
        } finally {
            this.setButtonLoading(button, false);
        }
    }

    async handleMoveAllToCart() {
        if (this.isLoading) return;
    
        try {
            this.isLoading = true;
            this.setGlobalLoading(true);
    
            const response = await this.moveAllToCart();
    
            const isSuccess = response.success === true || response.status === 'success';
    
            if (isSuccess) {
                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'All items moved to cart successfully');
                }
    
                // Fixed selector - select direct children of wishlistItemsList tbody
                const wishlistTable = document.querySelector('#wishlistItemsList');
                const rows = wishlistTable ? wishlistTable.querySelectorAll('tr') : [];
                
                if (rows.length > 0) {
                    // Clear all rows with animation
                    rows.forEach((row, index) => {
                        setTimeout(() => {
                            row.style.transition = 'opacity 0.3s ease';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 300);
                        }, index * 100);
                    });
    
                    setTimeout(() => {
                        this.showEmptyState();
                        this.updateWishlistCount();
                        // Update cart count if CartManager exists
                        if (window.CartManager) {
                            window.CartManager.updateCartCount();
                        }
                    }, rows.length * 100 + 300);
                } else {
                    // If no rows found, immediately show empty state
                    this.showEmptyState();
                    this.updateWishlistCount();
                    if (window.CartManager) {
                        window.CartManager.updateCartCount();
                    }
                }
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to move all items to cart';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Move all to cart error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while moving items to cart');
            }
        } finally {
            this.isLoading = false;
            this.setGlobalLoading(false);
        }
    }
    
    async handleClearWishlist() {
        if (this.isLoading) return;
    
        if (!confirm('Are you sure you want to clear your entire wishlist?')) {
            return;
        }
    
        try {
            this.isLoading = true;
            this.setGlobalLoading(true);
    
            const response = await this.clearWishlist();
    
            const isSuccess = response.success === true || response.status === 'success' || response.status === true;
    
            if (isSuccess) {
                if (window.ToastManager) {
                    window.ToastManager.success(response.message || 'Wishlist cleared successfully');
                }
    
                // Check if we have the table structure or just show empty state directly
                const wishlistItemsContainer = document.querySelector('#wishlistItems');
                const wishlistTable = document.querySelector('#wishlistItemsList');
                
                if (wishlistTable && wishlistItemsContainer) {
                    const rows = wishlistTable.querySelectorAll('tr');
                    
                    if (rows.length > 0) {
                        // Animate rows removal
                        rows.forEach((row, index) => {
                            setTimeout(() => {
                                row.style.transition = 'opacity 0.3s ease';
                                row.style.opacity = '0';
                            }, index * 50);
                        });
    
                        // After all animations, show empty state
                        setTimeout(() => {
                            this.showEmptyState();
                            this.updateWishlistCount();
                        }, rows.length * 50 + 300);
                    } else {
                        // No rows found, directly show empty state
                        this.showEmptyState();
                        this.updateWishlistCount();
                    }
                } else {
                    // Fallback: directly show empty state if elements not found
                    this.showEmptyState();
                    this.updateWishlistCount();
                }
            } else {
                if (window.ToastManager) {
                    const errorMessage = response.message || response.data?.message || response.error || 'Failed to clear wishlist';
                    window.ToastManager.error(errorMessage);
                }
            }
        } catch (error) {
            console.error('Clear wishlist error:', error);
            if (window.ToastManager) {
                window.ToastManager.error('An error occurred while clearing wishlist');
            }
        } finally {
            this.isLoading = false;
            this.setGlobalLoading(false);
        }
    }

    // API Methods
    async addToWishlist(postId, type) {
        const response = await fetch('/ajax/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: postId,
                type: type
            })
        });

        return await response.json();
    }

    async removeFromWishlist(postId, type) {
        const response = await fetch('/ajax/wishlist/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: postId,
                type: type
            })
        });

        return await response.json();
    }

    async moveToCart(postId, type, quantity) {
        const response = await fetch('/ajax/wishlist/move-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                post_id: postId,
                type: type,
                quantity: quantity
            })
        });

        return await response.json();
    }

    async moveAllToCart() {
        const response = await fetch('/ajax/wishlist/move-all-to-cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        return await response.json();
    }

    async clearWishlist() {
        const response = await fetch('/ajax/wishlist/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        });

        return await response.json();
    }

    // UI Helper Methods
    setButtonLoading(button, loading) {
        if (loading) {
            button.disabled = true;
            button.dataset.originalText = button.innerHTML;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
            button.style.minWidth = button.offsetWidth + 'px';
        } else {
            button.disabled = false;
            button.innerHTML = button.dataset.originalText || button.innerHTML;
            button.style.minWidth = '';
        }
    }

    setRowLoading(row, loading) {
        if (loading) {
            row.style.opacity = '0.6';
            row.style.pointerEvents = 'none';
        } else {
            row.style.opacity = '1';
            row.style.pointerEvents = 'auto';
        }
    }

    setGlobalLoading(loading) {
        const container = document.querySelector('#wishlistItems');
        if (container) {
            if (loading) {
                container.style.opacity = '0.6';
                container.style.pointerEvents = 'none';
            } else {
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
            }
        }
    }

    updateWishlistButtonState(button, inWishlist) {
        if (inWishlist) {
            button.classList.add('in-wishlist');
            button.innerHTML = '<i class="fas fa-heart"></i> In Wishlist';
        } else {
            button.classList.remove('in-wishlist');
            button.innerHTML = '<i class="far fa-heart"></i> Add to Wishlist';
        }
    }

    async updateWishlistCount() {
        try {
            const response = await fetch('/ajax/wishlist/get-items', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (response.ok) {
                const data = await response.json();
                const count = data.total_items || data.count || 0;
                this.setWishlistCount(count);
            }
        } catch (error) {
            console.error('Error updating wishlist count:', error);
        }
    }

    setWishlistCount(count) {
        const countElements = document.querySelectorAll('.wishlist-count');
        countElements.forEach(el => {
            el.textContent = count;
        });
    }

    isWishlistEmpty() {
        const rows = document.querySelectorAll('#wishlistItemsList tr');
        return rows.length === 0;
    }

    showEmptyState() {
        const container = document.querySelector('#wishlistItems');
        if (container) {
            container.innerHTML = `
                <div class="empty-wishlist-state text-center py-5">
                    <div class="empty-wishlist-icon mb-4">
                        <i class="fa fa-heart fa-4x text-muted"></i>
                    </div>
                    <h4 class="mb-3">Your wishlist is empty</h4>
                    <p class="mb-4">Start adding items to your wishlist to save them for later</p>
                    <a href="/products" class="thm-btn">
                        Continue Shopping
                        <span class="icon-right-arrow"></span>
                    </a>
                </div>
            `;
        }
    }
}

// Initialize WishlistManager when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
    window.WishlistManager = new WishlistManager();
}); 