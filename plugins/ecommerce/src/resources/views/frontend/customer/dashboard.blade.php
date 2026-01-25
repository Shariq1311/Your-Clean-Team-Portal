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
                        <h3 class="card-title">{{ trans('ecomm::content.my_dashboard') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="h3">{{ $customerDashboard['orders']['total'] }}</div>
                                        <div>{{ trans('ecomm::content.orders') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="h3">{{ $customerDashboard['wishlist_count'] }}</div>
                                        <div>{{ trans('ecomm::content.wishlist') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="h3">{{ $customerDashboard['cart_items_count'] }}</div>
                                        <div>{{ trans('ecomm::content.cart') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="h3">{{ $customerDashboard['downloadable_items'] }}</div>
                                        <div>{{ trans('ecomm::content.downloads') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h4>{{ trans('ecomm::content.recent_orders') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ trans('ecomm::content.order') }}</th>
                                        <th>{{ trans('ecomm::content.date') }}</th>
                                        <th>{{ trans('ecomm::content.total') }}</th>
                                        <th>{{ trans('ecomm::content.status') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customerDashboard['recent_orders'] ?? [] as $order)
                                        <tr>
                                            <td><a href="{{ $order['view_url'] }}">{{ $order['code'] }}</a></td>
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
                                                <a href="{{ $order['view_url'] }}" class="btn btn-sm btn-primary">
                                                    {{ trans('ecomm::content.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ trans('ecomm::content.no_orders_yet') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ url('admin/ecommerce/orders') }}" class="btn btn-primary">{{ trans('ecomm::content.view_all_orders') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
