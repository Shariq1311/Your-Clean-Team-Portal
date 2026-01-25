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
            <button type="button" class="btn btn-danger" id="clear-cart-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                </svg>
                {{ trans('ecomm::content.clear_cart') }}
            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.cart_items') }}</h3>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart-off" style="width: 80px; height: 80px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M17 17a2 2 0 1 0 2 2" />
                                        <path d="M17 17h-11v-11" />
                                        <path d="M9.239 5.231l10.761 .769l-1 7h-2m-4 0h-7" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                </div>
                                <p class="empty-title">{{ trans('ecomm::content.cart_is_empty') }}</p>
                                <p class="empty-subtitle text-muted">{{ trans('ecomm::content.add_some_products_to_your_cart') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.cart_summary') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.total_items') }}:</div>
                        <div class="col-6 text-end" id="cart-total-items">{{ $total_items }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.total_price') }}:</div>
                        <div class="col-6 text-end" id="cart-total-price">{{ $total_price }}</div>
                    </div>
                    <hr>
                    <div class="d-grid">
                        {{-- <a href="{{ route('admin.ecommerce.orders.create') }}" class="btn btn-primary" id="checkout-btn" {{ $total_items == 0 ? 'disabled' : '' }}>
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
            // Handle quantity buttons
            $(document).on('click', '.decrease-quantity', function() {
                var input = $(this).closest('.input-group').find('.quantity-input');
                var value = parseInt(input.val());
                if (value > 1) {
                    input.val(value - 1).trigger('change');
                }
            });

            $(document).on('click', '.increase-quantity', function() {
                var input = $(this).closest('.input-group').find('.quantity-input');
                var value = parseInt(input.val());
                input.val(value + 1).trigger('change');
            });

            // Update quantity
            $(document).on('change', '.quantity-input', function() {
                var postId = $(this).data('post-id');
                var type = $(this).data('type');
                var quantity = $(this).val();
                
                $.ajax({
                    url: '{{ route("admin.ecommerce.my-cart.update-quantity") }}',
                    type: 'POST',
                    data: {
                        post_id: postId,
                        type: type,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            MojarCMSTable.reloadTable();
                            updateCartSummary(response.total_items, response.total_price);
                        } 
                    }
                });
            });

            // Remove item from cart
            $(document).on('click', '.remove-item', function() {
                var postId = $(this).data('post-id');
                var type = $(this).data('type');
                
                if (confirm('{{ trans("ecomm::content.are_you_sure_remove_item") }}')) {
                    $.ajax({
                        url: '{{ route("admin.ecommerce.my-cart.remove-item") }}',
                        type: 'POST',
                        data: {
                            post_id: postId,
                            type: type,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                MojarCMSTable.reloadTable();
                                updateCartSummary(response.total_items, response.total_price);
                            }
                        }
                    });
                }
            });

            // Clear cart
            $('#clear-cart-btn').click(function() {
                if (confirm('{{ trans("ecomm::content.are_you_sure_clear_cart") }}')) {
                    $.ajax({
                        url: '{{ route("admin.ecommerce.my-cart.clear") }}',
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

            function updateCartSummary(totalItems, totalPrice) {
                $('#cart-total-items').text(totalItems);
                $('#cart-total-price').text(totalPrice);
                
                if (totalItems == 0) {
                    $('#checkout-btn').prop('disabled', true);
                } else {
                    $('#checkout-btn').prop('disabled', false);
                }
            }
        });
    </script>
@endsection 