@extends('cms::layouts.backend')

@section('content')
<div id="pos-terminal" class="container-fluid">
    <div class="row">
        <!-- Left Side - Products -->
        <div class="col-md-8">
            <!-- Search and Filters -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" 
                                   id="product-search" 
                                   class="form-control" 
                                   placeholder="Search products by name, SKU, or barcode...">
                        </div>
                        <div class="col-md-3">
                            <select id="category-filter" class="form-control">
                                <option value="">All Categories</option>
                                <!-- Categories will be loaded via JS -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="clear-search" class="btn btn-secondary">Clear</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>
                    <div class="card-actions">
                        <span id="products-count" class="text-muted">Loading products...</span>
                    </div>
                </div>
                <div class="card-body">
                    <div id="products-grid" class="row">
                        <!-- Loading skeleton will be shown here initially -->
                        <div id="products-loading" class="row">
                            <!-- Loading skeleton cards -->
                            @for ($i = 0; $i < 8; $i++)
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card placeholder-glow">
                                    <div class="placeholder bg-secondary" style="height: 120px;"></div>
                                    <div class="card-body">
                                        <h6 class="card-title placeholder-glow">
                                            <span class="placeholder col-8"></span>
                                        </h6>
                                        <p class="card-text placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                            <span class="placeholder col-4"></span>
                                        </p>
                                        <span class="placeholder col-5 btn btn-primary disabled"></span>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                        
                        <!-- Actual products will be loaded here -->
                        <div id="products-container" class="row" style="display: none;">
                            <!-- Products will be populated via JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div id="products-pagination" class="d-flex justify-content-center mt-3">
                        <!-- Pagination will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Cart and Checkout -->
        <div class="col-md-4">
            <!-- Session Info -->
            @if($currentSession)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title text-success">
                        <i class="ti ti-circle-check"></i> Active Session
                    </h5>
                    <p class="mb-1"><strong>{{ $currentSession->session_name ?: 'Session #' . $currentSession->id }}</strong></p>
                    <p class="mb-1"><small>Opened: {{ mc_date_format($currentSession->opened_at) }}</small></p>
                    <p class="mb-0"><small>Opening Balance: {{ pos_format_price($currentSession->opening_balance) }}</small></p>
                </div>
            </div>
            @else
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <i class="ti ti-alert-triangle"></i> No Active Session
                    </h5>
                    <p class="mb-2">Start a session to begin sales</p>
                    <a href="{{ route('admin.sessions.create') }}" class="btn btn-primary btn-sm">Start Session</a>
                </div>
            </div>
            @endif

            <!-- Customer Info -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Customer</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <input type="text" 
                               id="customer-name" 
                               class="form-control form-control-sm" 
                               placeholder="Customer name"
                               value="{{ pos_get_default_customer() }}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" 
                                   id="customer-phone" 
                                   class="form-control form-control-sm" 
                                   placeholder="Phone">
                        </div>
                        <div class="col-6">
                            <input type="email" 
                                   id="customer-email" 
                                   class="form-control form-control-sm" 
                                   placeholder="Email">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Cart</h3>
                    <div class="card-actions">
                        <button type="button" id="clear-cart" class="btn btn-sm btn-outline-danger">Clear</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="cart-items" class="cart-items-container">
                        <div id="empty-cart" class="text-center p-4 text-muted">
                            <i class="ti ti-shopping-cart" style="font-size: 2rem;"></i>
                            <p class="mb-0 mt-2">Your cart is empty</p>
                            <small>Add products to start creating an order</small>
                        </div>
                        <!-- Cart items will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Cart Totals -->
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">Subtotal:</div>
                        <div class="col-auto" id="cart-subtotal">{{ pos_format_price(0) }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">Tax:</div>
                        <div class="col-auto" id="cart-tax">{{ pos_format_price(0) }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">Discount:</div>
                        <div class="col-auto" id="cart-discount">{{ pos_format_price(0) }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col"><strong>Total:</strong></div>
                        <div class="col-auto"><strong id="cart-total">{{ pos_format_price(0) }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- Discount -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Discount</h3>
                </div>
                <div class="card-body">
                    <div id="discount-applied" style="display: none;" class="alert alert-success alert-sm mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span id="applied-discount-text">Discount applied</span>
                            <button type="button" id="remove-discount" class="btn btn-sm btn-outline-danger">Remove</button>
                        </div>
                    </div>
                    <div id="discount-input-area">
                        <div class="row">
                            <div class="col-8">
                                <input type="text" 
                                       id="discount-code" 
                                       class="form-control form-control-sm" 
                                       placeholder="Discount code">
                            </div>
                                                    <div class="col-4">
                            <button type="button" id="apply-discount" class="btn btn-sm btn-primary">Apply</button>
                            <button type="button" id="remove-discount" class="btn btn-sm btn-outline-danger mt-1" style="display: none;">Remove</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <button type="button" id="hold-order" class="btn btn-warning btn-block">
                                <i class="ti ti-clock"></i> Hold Order
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" id="load-hold" class="btn btn-info btn-block">
                                <i class="ti ti-download"></i> Load Hold
                            </button>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select id="payment-method" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                        </select>
                    </div>
                    
                    <!-- Cash Payment Fields -->
                    <div id="cash-payment" class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" 
                                       id="amount-paid" 
                                       class="form-control" 
                                       placeholder="0.00" 
                                       step="0.01">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Change</label>
                                <input type="number" 
                                       id="change-amount" 
                                       class="form-control" 
                                       readonly>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" id="complete-order" class="btn btn-success btn-block btn-lg" disabled>
                        <i class="ti ti-check"></i> Complete Sale
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hold Orders Modal -->
<div class="modal fade" id="holdOrdersModal" tabindex="-1" style="z-index: 1060;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hold Orders</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="hold-orders-list">
                    <!-- Hold orders will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Receipt Modal -->
<div class="modal fade" id="printModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="receipt-content">
                    <!-- Receipt will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function() {
    // POS Terminal JavaScript
    const pos = {
        cart: [],
        currentPage: 1,
        itemsPerPage: 12,
        appliedDiscount: null,
        discountAmount: 0,
        customerInfo: {},
        
        init() {
            this.loadCategories();
            this.loadProducts();
            this.loadCart();
            this.bindEvents();
            this.updateCartDisplay();
            this.updatePaymentFields(); // Initialize payment fields state
        },
        
        bindEvents() {
            // Product search
            $('#product-search').on('input', debounce(() => {
                this.currentPage = 1;
                this.loadProducts();
            }, 300));
            
            // Clear search
            $('#clear-search').click(() => {
                $('#product-search').val('');
                $('#category-filter').val('');
                this.currentPage = 1;
                this.loadProducts();
            });
            
            // Category filter
            $('#category-filter').change(() => {
                this.currentPage = 1;
                this.loadProducts();
            });
            
            // Cart actions
            $('#clear-cart').click(() => this.clearCart());
            $('#apply-discount').click(() => this.applyDiscount());
            $('#remove-discount').click(() => this.removeDiscount());
            $('#hold-order').click(() => this.holdOrder());
            $('#load-hold').click(() => this.loadHoldOrders());
            $('#complete-order').click(() => this.completeOrder());
            
            // Payment method change
            $('#payment-method').change(() => this.updatePaymentFields());
            
            // Amount paid change
            $('#amount-paid').on('input', () => this.calculateChange());
            
            // Customer info change
            $('#customer-name, #customer-phone, #customer-email').on('change', () => {
                this.updateCustomerInfo();
            });
        },
        
        loadProducts() {
            // Show loading skeleton
            $('#products-loading').show();
            $('#products-container').hide();
            $('#products-count').text('Loading products...');
            
            $.get(Your Clean Team.adminUrl + '/ajax/pos-search-products', {
                search: $('#product-search').val(),
                category: $('#category-filter').val(),
                page: this.currentPage,
                limit: this.itemsPerPage
            })
            .done((data) => {
                if (data.success) {
                    this.displayProducts(data.products);
                    this.displayPagination(data.pagination);
                    $('#products-count').text(`${data.pagination.total} products found`);
                    
                    // Hide loading skeleton and show products
                    $('#products-loading').hide();
                    $('#products-container').show();
                } else {
                    this.showError('Failed to load products');
                    $('#products-loading').hide();
                }
            })
            .fail(() => {
                this.showError('Failed to load products');
                $('#products-loading').hide();
            });
        },
        
        displayProducts(products) {
            const container = $('#products-container');
            container.empty();
            
            if (products.length === 0) {
                container.html('<div class="col-12 text-center"><p class="text-muted">No products found</p></div>');
                return;
            }
            
            products.forEach(product => {
                const productCard = `
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card product-card h-100" data-product-id="${product.id}" style="cursor: pointer;">
                            <div class="card-body p-2">
                                <img src="${product.thumbnail}" alt="${product.title}" class="img-fluid mb-2">
                                <h6 class="card-title text-truncate">${product.title}</h6>
                                <p class="card-text small text-muted mb-1">SKU: ${product.sku || 'N/A'}</p>
                                <p class="card-text"><strong>${product.price_formatted}</strong></p>
                                <button class="btn btn-primary btn-sm btn-block add-to-cart" 
                                        data-product-id="${product.id}"
                                        data-product-name="${product.title}"
                                        data-product-price="${product.price}"
                                        data-product-sku="${product.sku || ''}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.append(productCard);
            });
            
            // Bind add to cart events
            $('.add-to-cart').click((e) => {
                e.stopPropagation();
                const btn = $(e.target);
                this.addToCart({
                    id: btn.data('product-id'),
                    name: btn.data('product-name'),
                    price: btn.data('product-price'),
                    sku: btn.data('product-sku'),
                    quantity: 1
                });
            });
        },
        
        loadCategories() {
            $.get(Your Clean Team.adminUrl + '/ajax/pos-get-categories')
            .done((data) => {
                if (data.success) {
                    const select = $('#category-filter');
                    select.find('option:not(:first)').remove(); // Keep "All Categories" option
                    
                    data.categories.forEach(category => {
                        select.append(`<option value="${category.id}">${category.name}</option>`);
                    });
                }
            })
            .fail(() => {
                console.warn('Failed to load categories');
            });
        },
        
        addToCart(product) {
            $.post(Your Clean Team.adminUrl + '/ajax/pos-add-to-cart', {
                post_id: product.id,
                quantity: product.quantity || 1
            })
            .done((data) => {
                if (data.success) {
                    this.loadCart(); // Reload cart from server
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message);
                }
            })
            .fail(() => {
                this.showError('Failed to add product to cart');
            });
        },
        
        updateCartDisplay() {
            const cartItems = $('#cart-items');
            const emptyCart = $('#empty-cart');
            
            if (this.cart.length === 0) {
                emptyCart.show();
                cartItems.find('.cart-item').remove();
                $('#complete-order').prop('disabled', true);
                this.updateTotals();
                return;
            } else {
                emptyCart.hide();
            }
            
            // Remove existing cart items but keep empty cart message
            cartItems.find('.cart-item').remove();
            
            this.cart.forEach((item, index) => {
                const thumbnailUrl = item.thumbnail;
                const itemPrice = item.price || 0;
                const lineTotal = itemPrice * item.quantity;

                console.log(item);
                
                const cartItem = `
                    <div class="cart-item border rounded mb-3 p-3 bg-light">
                        <div class="d-flex align-items-start">
                            <div class="cart-item-image me-3">
                                <img src="${thumbnailUrl}" class="rounded border" width="50" height="50" 
                                     style="object-fit: cover;" alt="${item.name}">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1 text-truncate fw-semibold" style="max-width: 150px;">${item.name}</h6>
                                        <div class="text-muted small">${this.formatPrice(itemPrice)} each</div>
                                    </div>
                                    <div class="input-group input-group-sm" style="width: 110px;">
                                        <button class="btn btn-outline-secondary decrease-qty" data-index="${index}" type="button">
                                            <span>
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-minus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /></svg>
                                            </span>
                                        </button>
                                        <input type="number" class="form-control text-center item-qty fw-semibold" 
                                               value="${item.quantity}" min="1" data-index="${index}" readonly>
                                        <button class="btn btn-outline-secondary increase-qty" data-index="${index}" type="button">
                                            <span>
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                            </span>
                                        </button>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger ms-2 remove-item" data-index="${index}" title="Remove item">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                          
                                    </button>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="text-end">
                                        <strong class="text-primary fs-6">${this.formatPrice(lineTotal)}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                cartItems.append(cartItem);
            });
            
            // Bind cart item events
            $('.remove-item').click((e) => {
                const index = $(e.target).closest('.remove-item').data('index');
                this.removeFromCart(index);
            });
            
            $('.decrease-qty').click((e) => {
                const index = $(e.target).data('index');
                this.updateQuantity(index, -1);
            });
            
            $('.increase-qty').click((e) => {
                const index = $(e.target).data('index');
                this.updateQuantity(index, 1);
            });
            
            $('.item-qty').change((e) => {
                const index = $(e.target).data('index');
                const qty = parseInt($(e.target).val()) || 1;
                this.cart[index].quantity = qty;
                this.updateCartDisplay();
                this.saveCart();
            });
            
            $('#complete-order').prop('disabled', false);
            this.updateTotals();
        },
        
        updateTotals() {
            const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * (parseFloat('{{ config("pos-system.tax_rate", 0) }}') / 100);
            const discount = this.discountAmount;
            const total = subtotal + tax - discount;
            
            $('#cart-subtotal').text(this.formatPrice(subtotal));
            $('#cart-tax').text(this.formatPrice(tax));
            $('#cart-discount').text(this.formatPrice(discount));
            $('#cart-total').text(this.formatPrice(total));
        },
        
        formatPrice(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount);
        },
        
        clearCart() {
            if (!confirm('Are you sure you want to clear the cart?')) {
                return;
            }
            
            $.post(Your Clean Team.adminUrl + '/ajax/pos-clear-cart')
            .done((data) => {
                if (data.success) {
                    this.cart = [];
                    this.appliedDiscount = null;
                    this.discountAmount = 0;
                    this.customerInfo = {};
                    
                    // Clear customer inputs
                    $('#customer-name').val('{{ pos_get_default_customer() }}');
                    $('#customer-phone').val('');
                    $('#customer-email').val('');
                    
                    this.updateCartDisplay();
                    $('#remove-discount').hide();
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message || 'Failed to clear cart');
                }
            })
            .fail(() => {
                this.showError('Failed to clear cart');
            });
        },
        
        removeFromCart(index) {
            if (index >= 0 && index < this.cart.length) {
                const item = this.cart[index];
                
                $.post(Your Clean Team.adminUrl + '/ajax/pos-remove-cart-item', {
                    post_id: item.post_id || item.id
                })
                .done((data) => {
                    if (data.success) {
                        this.loadCart(); // Reload cart from server
                        this.showSuccess(data.message);
                    } else {
                        this.showError(data.message);
                    }
                })
                .fail(() => {
                    this.showError('Failed to remove item from cart');
                });
            }
        },
        
        updateQuantity(index, change) {
            if (index >= 0 && index < this.cart.length) {
                const item = this.cart[index];
                const newQuantity = item.quantity + change;
                
                if (newQuantity <= 0) {
                    this.removeFromCart(index);
                } else {
                    $.post(Your Clean Team.adminUrl + '/ajax/pos-update-cart-item', {
                        post_id: item.post_id || item.id,
                        quantity: newQuantity
                    })
                    .done((data) => {
                        if (data.success) {
                            this.loadCart(); // Reload cart from server
                        } else {
                            this.showError(data.message);
                        }
                    })
                    .fail(() => {
                        this.showError('Failed to update cart item');
                    });
                }
            }
        },
        
        applyDiscount() {
            const code = $('#discount-code').val();
            if (!code) {
                this.showError('Please enter a discount code');
                return;
            }
            
            $.post(Your Clean Team.adminUrl + '/ajax/pos-apply-discount', {
                code: code,
                cart: this.cart
            })
            .done((data) => {
                if (data.success) {
                    this.appliedDiscount = data.discount;
                    this.discountAmount = data.discount_amount || 0;
                    this.showSuccess(`Discount "${code}" applied successfully`);
                    this.updateTotals();
                    $('#discount-code').val(''); // Clear the input
                    $('#remove-discount').show(); // Show remove button
                } else {
                    this.showError(data.message || 'Invalid discount code');
                }
            })
            .fail(() => {
                this.showError('Failed to apply discount');
            });
        },
        
        removeDiscount() {
            this.appliedDiscount = null;
            this.discountAmount = 0;
            this.updateTotals();
            $('#remove-discount').hide();
            this.showSuccess('Discount removed');
        },
        
        holdOrder() {
            // First reload cart from server to ensure synchronization
            $.get(Your Clean Team.adminUrl + '/ajax/pos-get-cart')
            .done((cartData) => {
                if (cartData.success) {
                    this.cart = cartData.cart.items || [];
                    this.updateCartDisplay();
                    
                    if (this.cart.length === 0) {
                        this.showError('Cart is empty');
                        return;
                    }
                    
                    $.post(Your Clean Team.adminUrl + '/ajax/pos-hold-order', {
                        cart: this.cart,
                        customer_name: $('#customer-name').val(),
                        customer_phone: $('#customer-phone').val(),
                        customer_email: $('#customer-email').val()
                    })
                    .done((data) => {
                        if (data.success) {
                            this.cart = [];
                            this.updateCartDisplay();
                            this.showSuccess('Order placed on hold');
                        } else {
                            this.showError(data.message || 'Failed to hold order');
                        }
                    })
                    .fail(() => {
                        this.showError('Failed to hold order');
                    });
                } else {
                    this.showError('Failed to load cart');
                }
            })
            .fail(() => {
                this.showError('Failed to load cart');
            });
        },
        
        loadHoldOrders() {
            $('#holdOrdersModal').modal('show');
            
            // Load hold orders list
            $.get(Your Clean Team.adminUrl + '/ajax/pos-get-hold-orders')
            .done((data) => {
                if (data.success) {
                    this.displayHoldOrders(data.orders);
                } else {
                    $('#hold-orders-list').html('<div class="alert alert-warning">No hold orders found</div>');
                }
            })
            .fail(() => {
                $('#hold-orders-list').html('<div class="alert alert-danger">Failed to load hold orders</div>');
            });
        },
        
        displayHoldOrders(orders) {
            const container = $('#hold-orders-list');
            container.empty();
            
            if (orders.length === 0) {
                container.html('<div class="alert alert-info">No hold orders found</div>');
                return;
            }
            
            orders.forEach(order => {
                const orderCard = `
                    <div class="card mb-2">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">${order.order_number}</h6>
                                    <small class="text-muted">${order.customer_name} • ${order.items_count} items</small>
                                    <br><small class="text-muted">${order.created_at}</small>
                                </div>
                                <div class="text-right">
                                    <div class="font-weight-bold mb-2">${order.total_amount}</div>
                                    <button class="btn btn-primary btn-sm load-hold-order" 
                                            data-order-id="${order.id}"
                                            data-order-number="${order.order_number}">
                                        Load Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.append(orderCard);
            });
            
            // Bind load order events
            $('.load-hold-order').click((e) => {
                const btn = $(e.target);
                const orderId = btn.data('order-id');
                const orderNumber = btn.data('order-number');
                
                if (confirm(`Load order ${orderNumber} to cart? This will replace your current cart.`)) {
                    this.loadHoldOrderToCart(orderId, btn);
                }
            });
        },
        
        loadHoldOrderToCart(orderId, button) {
            button.prop('disabled', true).text('Loading...');
            
            $.post(Your Clean Team.adminUrl + '/ajax/pos-load-hold-order', {
                order_id: orderId
            })
            .done((data) => {
                if (data.success) {
                    // Load cart data
                    this.cart = data.cart_data.items || [];
                    this.discountAmount = data.cart_data.discount_amount || 0;
                    this.appliedDiscount = data.cart_data.applied_discount || null;
                    
                    // Load customer data
                    if (data.cart_data.customer) {
                        $('#customer-name').val(data.cart_data.customer.name || '');
                        $('#customer-phone').val(data.cart_data.customer.phone || '');
                        $('#customer-email').val(data.cart_data.customer.email || '');
                        this.updateCustomerInfo();
                    }
                    
                    // Update display
                    this.updateCartDisplay();
                    this.saveCart();
                    
                    // Show/hide discount button
                    if (this.appliedDiscount) {
                        $('#remove-discount').show();
                    }
                    
                    // Close modal
                    $('#holdOrdersModal').modal('hide');
                    
                    this.showSuccess(data.message);
                } else {
                    this.showError(data.message || 'Failed to load hold order');
                }
            })
            .fail(() => {
                this.showError('Failed to load hold order');
            })
            .always(() => {
                button.prop('disabled', false).text('Load Order');
            });
        },
        
        completeOrder() {
            if (this.cart.length === 0) {
                this.showError('Cart is empty');
                return;
            }
            
            $.post(Your Clean Team.adminUrl + '/ajax/pos-complete-order', {
                cart: this.cart,
                payment_method: $('#payment-method').val(),
                paid_amount: $('#amount-paid').val(),
                customer_name: $('#customer-name').val(),
                customer_phone: $('#customer-phone').val(),
                customer_email: $('#customer-email').val()
            })
            .done((data) => {
                if (data.success) {
                    this.cart = [];
                    this.appliedDiscount = null;
                    this.discountAmount = 0;
                    this.customerInfo = {};
                    
                    // Clear customer inputs
                    $('#customer-name').val('{{ pos_get_default_customer() }}');
                    $('#customer-phone').val('');
                    $('#customer-email').val('');
                    $('#amount-paid').val('');
                    $('#change-amount').val('');
                    
                    // Clear localStorage
                    localStorage.removeItem('pos_cart');
                    
                    this.updateCartDisplay();
                    $('#remove-discount').hide();
                    this.showSuccess('Order completed successfully!');
                    
                    // Show print receipt modal if receipt data is provided
                    if (data.receipt_html) {
                        $('#receipt-content').html(data.receipt_html);
                        $('#printModal').modal('show');
                    }
                } else {
                    this.showError(data.message || 'Failed to complete order');
                }
            })
            .fail(() => {
                this.showError('Failed to complete order');
            });
        },
        
        updatePaymentFields() {
            const method = $('#payment-method').val();
            
            if (method === 'card') {
                // For card payments, set paid amount to total automatically
                const total = this.getTotalAmount();
                $('#amount-paid').val(total.toFixed(2));
                $('#cash-payment').hide();
                $('#change-amount').val('0.00');
            } else {
                // For cash payments, show payment fields and clear amount
                $('#cash-payment').show();
                $('#change-amount').val('0.00');
            }
        },
        
        calculateChange() {
            const total = this.getTotalAmount();
            const paid = parseFloat($('#amount-paid').val()) || 0;
            const change = Math.max(0, paid - total);
            $('#change-amount').val(change.toFixed(2));
        },
        
        updateCustomerInfo() {
            // Save customer info to the cart object for local storage
            this.customerInfo = {
                name: $('#customer-name').val(),
                phone: $('#customer-phone').val(),
                email: $('#customer-email').val()
            };
            this.saveCart();
        },
        
        saveCart() {
            // Cart is automatically saved on server through cart manager
            // No client-side saving needed - server manages cart persistence
            // Customer info is stored separately if needed
        },
        
        loadCart() {
            $.get(Your Clean Team.adminUrl + '/ajax/pos-get-cart')
            .done((data) => {
                if (data.success) {
                    this.cart = data.cart.items || [];
                    this.discountAmount = data.cart.discount_amount || 0;
                    
                    // Update totals in UI
                    $('#cart-subtotal').text(this.formatPrice(data.cart.subtotal));
                    $('#cart-tax').text(this.formatPrice(data.cart.tax_amount));
                    $('#cart-discount').text(this.formatPrice(data.cart.discount_amount));
                    $('#cart-total').text(this.formatPrice(data.cart.total_amount));
                    
                    this.updateCartDisplay();
                }
            })
            .fail(() => {
                console.warn('Failed to load cart from server');
                this.cart = [];
                this.updateCartDisplay();
            });
        },
        
        getTotalAmount() {
            const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * (parseFloat('{{ config("pos-system.tax_rate", 0) }}') / 100);
            const discount = this.discountAmount;
            return subtotal + tax - discount;
        },
        
        displayPagination(pagination) {
            const container = $('#products-pagination');
            container.empty();
            
            if (pagination.last_page <= 1) {
                return; // No pagination needed
            }
            
            let paginationHtml = '<nav><ul class="pagination pagination-sm justify-content-center">';
            
            // Previous button
            if (pagination.current_page > 1) {
                paginationHtml += `<li class="page-item">
                    <a class="page-link" href="#" data-page="${pagination.current_page - 1}">Previous</a>
                </li>`;
            }
            
            // Page numbers
            for (let page = 1; page <= pagination.last_page; page++) {
                if (page === pagination.current_page) {
                    paginationHtml += `<li class="page-item active">
                        <span class="page-link">${page}</span>
                    </li>`;
                } else {
                    paginationHtml += `<li class="page-item">
                        <a class="page-link" href="#" data-page="${page}">${page}</a>
                    </li>`;
                }
            }
            
            // Next button
            if (pagination.current_page < pagination.last_page) {
                paginationHtml += `<li class="page-item">
                    <a class="page-link" href="#" data-page="${pagination.current_page + 1}">Next</a>
                </li>`;
            }
            
            paginationHtml += '</ul></nav>';
            container.html(paginationHtml);
            
            // Bind click events
            container.find('a.page-link').click((e) => {
                e.preventDefault();
                const page = parseInt($(e.target).data('page'));
                if (page && page !== this.currentPage) {
                    this.currentPage = page;
                    this.loadProducts();
                }
            });
        },
        
        showSuccess(message) {
            // Create a mock response object that get_message_response can handle
            const mockResponse = {
                status: true,
                data: {
                    message: message
                }
            };
            show_message(mockResponse);
        },

        showError(message) {
            // Create a mock response object that get_message_response can handle
            const mockResponse = {
                status: false,
                data: {
                    message: message
                }
            };
            show_message(mockResponse);
        },

        formatPrice(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD'
            }).format(amount || 0);
        }
    };
    
    // Initialize POS
    pos.init();
    
    // Utility function for debouncing
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
</script>
@endsection

@section('header')
<style>
.product-card:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
    transition: all 0.2s ease;
}

.cart-items-container {
    max-height: 350px;
    overflow-y: auto;
}

.cart-item {
    transition: background-color 0.2s ease;
    border-left: 3px solid transparent;
}

.cart-item:hover {
    background-color: #f8f9fa;
    border-left-color: #007bff;
}

#pos-terminal .card {
    border-radius: 8px;
}

.btn-block {
    width: 100%;
}

.placeholder-glow .placeholder {
    animation: placeholder-glow 2s ease-in-out infinite alternate;
}

@keyframes placeholder-glow {
    50% {
        opacity: .5;
    }
}

.product-card img {
    height: 120px;
    object-fit: cover;
    border-radius: 4px;
}

#empty-cart i {
    opacity: 0.5;
}

@media print {
    body * {
        visibility: hidden;
    }
    #receipt-content, #receipt-content * {
        visibility: visible;
    }
    #receipt-content {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>
@endsection 