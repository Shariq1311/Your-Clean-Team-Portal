@extends('cms::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('ecomm::frontend.customer.sidebar')
            </div>
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('ecomm::content.my_wishlist') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(count($wishlistItems) > 0)
                            <div class="row">
                                @foreach($wishlistItems as $item)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card h-100">
                                            <div class="position-relative">
                                                @if($item['thumbnail'])
                                                    <img src="{{ $item['thumbnail'] }}" class="card-img-top" alt="{{ $item['title'] }}">
                                                @else
                                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                                        <i class="fas fa-image fa-3x text-muted"></i>
                                                    </div>
                                                @endif
                                                
                                                <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 remove-wishlist" data-id="{{ $item['id'] }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $item['title'] }}</h5>
                                                
                                                <div class="mt-2">
                                                    @if(!empty($item['sale_price']) && $item['sale_price'] < $item['price'])
                                                        <span class="text-decoration-line-through text-muted">
                                                            {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($item['price']) }}
                                                        </span>
                                                        <span class="ms-2 fw-bold text-danger">
                                                            {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($item['sale_price']) }}
                                                        </span>
                                                    @else
                                                        <span class="fw-bold">
                                                            {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($item['price']) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="mt-auto pt-3">
                                                    <div class="d-grid gap-2">
                                                        <a href="{{ $item['url'] }}" class="btn btn-primary">
                                                            {{ trans('ecomm::content.view_product') }}
                                                        </a>
                                                        <button class="btn btn-success add-to-cart" data-id="{{ $item['id'] }}">
                                                            {{ trans('ecomm::content.add_to_cart') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-heart fa-3x text-muted"></i>
                                </div>
                                <h4>{{ trans('ecomm::content.no_items_in_wishlist') }}</h4>
                                <p>{{ trans('ecomm::content.browse_products_to_add_wishlist') }}</p>
                                <a href="{{ route('home') }}" class="btn btn-primary">
                                    {{ trans('ecomm::content.browse_products') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    
                    fetch('/ajax/cart/add-to-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('Product added to cart successfully');
                        } else {
                            alert('Error adding product to cart');
                        }
                    });
                });
            });
            
            // Remove from wishlist functionality
            document.querySelectorAll('.remove-wishlist').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    
                    fetch('/ajax/wishlist/remove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Remove the product card from the UI
                            this.closest('.col-md-6').remove();
                            
                            // Check if wishlist is now empty
                            if (document.querySelectorAll('#recent-content-table tbody tr:visible').length === 0) {
                                window.location.reload(); // Reload to show empty state
                            }
                        } else {
                            alert('Error removing product from wishlist');
                        }
                    });
                });
            });
        });
    </script>
@endsection
