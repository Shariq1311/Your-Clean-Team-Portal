@extends('cms::layouts.backend')

@section('content')
    <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
            <span class="status-indicator status-blue status-indicator-animated">
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
                <span class="status-indicator-circle"></span>
            </span>
        </div>
        <div class="col">
            <h2 class="page-title">
                {{ $title }}
            </h2>
        </div>
        <div class="col-md-auto ms-auto d-print-none">
            <button type="button" class="btn btn-primary me-2" id="move-all-to-cart-btn">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                {{ trans('ecomm::content.move_all_to_cart') }}
            </button>
            <button type="button" class="btn btn-danger" id="clear-wishlist-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
                {{ trans('ecomm::content.clear_wishlist') }}
            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.wishlist_items') }}</h3>
                </div>
                <div class="card-body">
                    @if($total_items > 0)
                        <div class="table-responsive">
                            {{ $dataTable->render() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="empty">
                                <div class="empty-img">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-heart-broken" style="width: 80px; height: 80px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M11.001 3.8l-.001 1.963l-1.894 3.79l-.047 .11a1 1 0 0 0 .341 1.137l3.332 2.499l-1.626 3.254a1 1 0 0 0 -.106 .447v3.417l-7.197 -7.127a6 6 0 0 1 6.956 -9.621zm5.77 -.739l.246 .037a6 6 0 0 1 3.184 10.193l-.044 .037l-7.157 7.088v-3.181l1.894 -3.788l.047 -.11a1 1 0 0 0 -.341 -1.137l-3.333 -2.5l1.627 -3.253a1 1 0 0 0 .106 -.447v-2.187a6 6 0 0 1 3.77 -.752"/>
                                    </svg>
                                </div>
                                <p class="empty-title">{{ trans('ecomm::content.wishlist_is_empty') }}</p>
                                <p class="empty-subtitle text-muted">{{ trans('ecomm::content.add_some_products_to_your_wishlist') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.wishlist_summary') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.total_items') }}:</div>
                        <div class="col-6 text-end" id="wishlist-total-items">{{ $total_items }}</div>
                    </div>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.ecommerce.my-cart.index') }}" class="btn btn-primary">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                            {{ trans('ecomm::content.view_cart') }}
                        </a>
                        {{-- <a href="{{ route('admin.ecommerce.orders.create') }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 17a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M9.592 4.592l2.538 2.538a6 6 0 0 1 0 8.54l-2.538 2.538a6 6 0 0 1 -8.54 0l-2.538 -2.538a6 6 0 0 1 0 -8.54z" />
                                <path d="M20 4v2h2" />
                                <path d="M13 13l3 3l5 -5" />
                            </svg>
                            {{ trans('ecomm::content.proceed_to_checkout') }}
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Remove item from wishlist
            $(document).on('click', '.remove-item', function() {
                var postId = $(this).data('post-id');
                var type = $(this).data('type');
                
                if (confirm('{{ trans("ecomm::content.are_you_sure_remove_item") }}')) {
                    $.ajax({
                        url: '{{ route("admin.ecommerce.my-wishlist.remove-item") }}',
                        type: 'POST',
                        data: {
                            post_id: postId,
                            type: type,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                MojarCMSTable.reloadTable();
                                updateWishlistSummary(response.total_items);
                            }
                        }
                    });
                }
            });

            // Move item to cart
            $(document).on('click', '.move-to-cart', function() {
                var postId = $(this).data('post-id');
                var type = $(this).data('type');
                
                $.ajax({
                    url: '{{ route("admin.ecommerce.my-wishlist.move-to-cart") }}',
                    type: 'POST',
                    data: {
                        post_id: postId,
                        type: type,
                        quantity: 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            MojarCMSTable.reloadTable();
                            updateWishlistSummary(response.total_items);
                        }
                    }
                });
            });

            // Move all items to cart
            $('#move-all-to-cart-btn').click(function() {
                if (confirm('{{ trans("ecomm::content.are_you_sure_move_all_to_cart") }}')) {
                    $.ajax({
                        url: '{{ route("admin.ecommerce.my-wishlist.move-all-to-cart") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            }
                        }
                    });
                }
            });

            // Clear wishlist
            $('#clear-wishlist-btn').click(function() {
                if (confirm('{{ trans("ecomm::content.are_you_sure_clear_wishlist") }}')) {
                    $.ajax({
                        url: '{{ route("admin.ecommerce.my-wishlist.clear") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            }
                        }
                    });
                }
            });

            function updateWishlistSummary(totalItems) {
                $('#wishlist-total-items').text(totalItems);
            }
        });
    </script>
@endsection 