@extends('cms::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('ecomm::frontend.customer.sidebar')
            </div>
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">{{ trans('ecomm::content.order') }} #{{ $order->code }}</h3>
                        <div>
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
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4>{{ trans('ecomm::content.order_details') }}</h4>
                                <p><strong>{{ trans('ecomm::content.date') }}:</strong> {{ mc_date_format($order->created_at) }}</p>
                                <p>
                                    <strong>{{ trans('ecomm::content.payment_status') }}:</strong> 
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
                                </p>
                                <p>
                                    <strong>{{ trans('ecomm::content.delivery_status') }}:</strong>
                                    @php
                                        $deliveryStatusColor = match($order->delivery_status) {
                                            'delivered' => 'success',
                                            'shipped' => 'info',
                                            'processing' => 'primary',
                                            default => 'warning'
                                        };
                                        
                                        $deliveryStatusText = match($order->delivery_status) {
                                            'delivered' => trans('ecomm::content.delivered'),
                                            'shipped' => trans('ecomm::content.shipped'),
                                            'processing' => trans('ecomm::content.processing'),
                                            default => trans('ecomm::content.pending'),
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $deliveryStatusColor }}">{{ $deliveryStatusText }}</span>
                                </p>
                                <p><strong>{{ trans('ecomm::content.payment_method') }}:</strong> {{ $order->payment_method_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>{{ trans('ecomm::content.shipping_address') }}</h4>
                                <p>{{ $order->name }}</p>
                                <p>{{ $order->address }}</p>
                                @if($order->phone)
                                    <p>{{ $order->phone }}</p>
                                @endif
                                @if($order->email)
                                    <p>{{ $order->email }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <h4>{{ trans('ecomm::content.order_items') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cms::app.product') }}</th>
                                        <th>{{ trans('ecomm::content.quantity') }}</th>
                                        <th>{{ trans('ecomm::content.price') }}</th>
                                        <th>{{ trans('ecomm::content.total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                @if($item->post)
                                                    <a href="{{ HookAction::getPermalink('product', $item->post) }}">
                                                        {{ $item->post->title }}
                                                    </a>
                                                @else
                                                    {{ $item->title }}
                                                @endif
                                                
                                                @if($item->variant_attributes)
                                                    <div class="small text-muted">
                                                        {{ $item->variant_attributes }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($item->price) }}</td>
                                            <td>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($item->line_price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>{{ trans('ecomm::content.subtotal') }}</strong></td>
                                        <td>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($order->total_price) }}</td>
                                    </tr>
                                    @if($order->discount > 0)
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>{{ trans('ecomm::content.discount') }}</strong></td>
                                            <td>-{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($order->discount) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>{{ trans('ecomm::content.total') }}</strong></td>
                                        <td><strong>{{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($order->total) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        @if($order->notes)
                            <div class="mt-4">
                                <h4>{{ trans('ecomm::content.notes') }}</h4>
                                <p>{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('admin/ecommerce/orders') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> {{ trans('ecomm::content.back_to_orders') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
