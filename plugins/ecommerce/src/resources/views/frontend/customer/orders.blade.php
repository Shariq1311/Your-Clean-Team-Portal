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
                        <h3 class="card-title">{{ trans('ecomm::content.my_orders') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ trans('ecomm::content.order_number') }}</th>
                                        <th>{{ trans('ecomm::content.date') }}</th>
                                        <th>{{ trans('ecomm::content.total') }}</th>
                                        <th>{{ trans('ecomm::content.status') }}</th>
                                        <th>{{ trans('ecomm::content.payment') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td><a href="{{ route('admin.ecommerce.my-orders.show', $order->id) }}">{{ $order->code }}</a></td>
                                            <td>{{ mc_date_format($order->created_at) }}</td>
                                            <td>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($order->total) }}</td>
                                            <td>
                                                @php
                                                    $statusColor = match($order->status) {
                                                        'completed' => 'success',
                                                        'processing' => 'info',
                                                        'cancelled' => 'danger',
                                                        default => 'warning'
                                                    };
                                                    
                                                    $statusText = match($order->status) {
                                                        'completed' => trans('ecomm::content.completed'),
                                                        'processing' => trans('ecomm::content.processing'),
                                                        'cancelled' => trans('ecomm::content.cancelled'),
                                                        default => trans('ecomm::content.pending'),
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusColor }}">{{ $statusText }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $paymentStatusColor = match($order->payment_status) {
                                                        'completed' => 'success',
                                                        'failed' => 'danger',
                                                        default => 'warning'
                                                    };
                                                    
                                                    $paymentStatusText = match($order->payment_status) {
                                                        'completed' => trans('ecomm::content.completed'),
                                                        'failed' => trans('ecomm::content.failed'),
                                                        default => trans('ecomm::content.pending'),
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $paymentStatusColor }}">{{ $paymentStatusText }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.ecommerce.my-orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                                    {{ trans('ecomm::content.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">{{ trans('ecomm::content.no_orders_yet') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
