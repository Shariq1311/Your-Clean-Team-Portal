<!-- Vendor Orders Widget -->

<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.recent_orders') }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
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
                                        {{ trans('ecomm::content.total_orders') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $vendorDashboard['orders']['total'] ?? 0 }}
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
                                    <span class="bg-green text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-copy-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path stroke="none" d="M0 0h24v24H0z" /><path d="M7 9.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 16.737a2 2 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1" /><path d="M11 14l2 2l4 -4" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.completed') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $vendorDashboard['orders']['completed'] ?? 0 }}
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
                                    <span class="bg-yellow text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-progress-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" /><path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" /><path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" /><path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" /><path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" /><path d="M9 12l2 2l4 -4" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.processing') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $vendorDashboard['orders']['processing'] ?? 0 }}
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
                                    <span class="bg-purple text-white avatar">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-alarm-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7.587 7.566a7 7 0 1 0 9.833 9.864m1.35 -2.645a7 7 0 0 0 -8.536 -8.56" /><path d="M12 12v1h1" /><path d="M5.261 5.265l-1.011 .735" /><path d="M17 4l2.75 2" /><path d="M3 3l18 18" /></svg>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ trans('ecomm::content.pending') }}
                                    </div>
                                    <div class="text-muted">
                                        {{ $vendorDashboard['orders']['pending'] ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ trans('ecomm::content.order') }}</th>
                            <th>{{ trans('ecomm::content.product') }}</th>
                            <th>{{ trans('ecomm::content.customer') }}</th>
                            <th>{{ trans('ecomm::content.quantity') }}</th>
                            <th>{{ trans('ecomm::content.line_price') }}</th>
                            <th>{{ trans('ecomm::content.status') }}</th>
                            <th>{{ trans('ecomm::content.date') }}</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendorDashboard['recent_orders'] ?? [] as $order)
                            <tr>
                                <td>
                                    <a href="{{ $order['view_url'] }}">{{ $order['order_code'] ?? 'N/A' }}</a>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 150px;" title="{{ $order['product_title'] }}">
                                        {{ $order['product_title'] }}
                                    </div>
                                </td>
                                <td>
                                    {{ $order['customer_name'] }}
                                </td>
                                <td>
                                    {{ $order['quantity'] }}
                                </td>
                                <td>
                                    {{ ecom_price_with_unit( intval($order['line_price']) ) }}
                                </td>
                                <td>
                                    @php
                                        $statusColor = match($order['status']) {
                                            'completed' => 'success',
                                            'processing' => 'info',
                                            'cancelled' => 'danger',
                                            default => 'warning'
                                        };
                                        $statusText = match($order['status']) {
                                            'completed' => trans('ecomm::content.completed'),
                                            'processing' => trans('ecomm::content.processing'),
                                            'cancelled' => trans('ecomm::content.cancelled'),
                                            default => trans('ecomm::content.pending')
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
                                </td>
                                <td>
                                    {{ $order['created_at'] }}
                                </td>
                                <td>
                                    <a href="{{ $order['view_url'] }}" class="btn btn-sm btn-primary">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">{{ trans('ecomm::content.no_orders') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.order_items.index') }}" class="btn btn-primary">{{ trans('ecomm::content.view_all_orders') }}</a>
        </div>
    </div>
</div>