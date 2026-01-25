<!-- Customer Dashboard Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.my_dashboard') }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.orders') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $customerDashboard['orders']['total'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-pink text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.96 6.053" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.wishlist') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $customerDashboard['wishlist_count'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-azure text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.cart') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $customerDashboard['cart_items_count'] }} {{ trans('ecomm::content.items') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-teal text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.downloads') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $customerDashboard['downloadable_items'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.recent_orders') }}</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter">
                        <thead>
                            <tr>
                                <th>{{ trans('ecomm::content.order') }}</th>
                                <th>{{ trans('ecomm::content.date') }}</th>
                                <th>{{ trans('ecomm::content.total') }}</th>
                                <th>{{ trans('ecomm::content.status') }}</th>
                                <th>{{ trans('ecomm::content.payment') }}</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customerDashboard['recent_orders'] as $order)
                                <tr>
                                    <td>
                                        <a href="{{ $order['view_url'] }}">{{ $order['code'] }}</a>
                                    </td>
                                    <td>{{ $order['created_at'] }}</td>
                                    <td>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($order['total']) }}</td>
                                    <td>
                                        @php
                                            $statusColor = match($order['status']) {
                                                'completed' => 'success',
                                                'processing' => 'info',
                                                'cancelled' => 'danger',
                                                default => 'warning'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">{{ $order['status_text'] }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $paymentStatusColor = match($order['payment_status']) {
                                                'completed' => 'success',
                                                'failed' => 'danger',
                                                default => 'warning'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $paymentStatusColor }}">{{ $order['payment_status_text'] }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ $order['view_url'] }}" class="btn btn-sm btn-primary">
                                            {{ trans('ecomm::content.view') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">{{ trans('ecomm::content.no_orders_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.ecommerce.my-orders.index') }}" class="btn btn-primary">{{ trans('ecomm::content.view_all_orders') }}</a>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row g-2">
                <div class="col-4">
                    <a href="{{ route('admin.ecommerce.my-orders.index') }}" class="btn w-100">
                        {{ trans('ecomm::content.my_orders') }}
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('admin.ecommerce.my-wishlist.index') }}" class="btn w-100">
                        {{ trans('ecomm::content.my_wishlist') }}
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('admin.ecommerce.my-cart.index') }}" class="btn w-100">
                        {{ trans('ecomm::content.my_cart') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
