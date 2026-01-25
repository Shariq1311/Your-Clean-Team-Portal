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
            <a href="{{ route('admin.ecommerce.my-orders.index') }}" class="btn btn-tabler">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
                {{ trans('ecomm::content.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Order Items -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.order_items') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>{{ trans('ecomm::content.product') }}</th>
                                    <th>{{ trans('ecomm::content.price') }}</th>
                                    <th>{{ trans('ecomm::content.discount_price') }}</th>
                                    <th>{{ trans('ecomm::content.quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order['items'] ?? [] as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item['thumbnail'])
                                                <img src="{{ upload_url($item['thumbnail']) }}" class="avatar me-3" alt="Product">
                                            @else
                                                <div class="avatar bg-secondary me-3">-</div>
                                            @endif
                                            <div>
                                                <div class="font-weight-medium">{{ $item['title'] ?? 'N/A' }}</div>
                                                <div class="text-muted">{{ $item['sku_code'] ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>{{ $item['compare_price'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Order Summary -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.order_summary') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.order_code') }}:</div>
                        <div class="col-6 text-end">{{ $order['code'] }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.order_date') }}:</div>
                        <div class="col-6 text-end">{{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y H:i') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.status') }}:</div>
                        <div class="col-6 text-end">{!! $order['status_badge'] ?? '' !!}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.payment_status') }}:</div>
                        <div class="col-6 text-end">{!! $order['payment_status_badge'] ?? '' !!}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.delivery_status') }}:</div>
                        <div class="col-6 text-end">{!! $order['delivery_status_badge'] ?? '' !!}</div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.subtotal') }}:</div>
                        <div class="col-6 text-end">{{ $order['total_price'] }}</div>
                    </div>
                    @if($order['discount'] > 0)
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.discount') }}:</div>
                        <div class="col-6 text-end text-danger">-{{ $order['discount'] }}</div>
                    </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-6"><strong>{{ trans('ecomm::content.total') }}:</strong></div>
                        <div class="col-6 text-end"><strong>{{ $order['total'] }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.customer_information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.name') }}:</div>
                        <div class="col-6 text-end">{{ $order['name'] }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.email') }}:</div>
                        <div class="col-6 text-end">{{ $order['email'] }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.phone') }}:</div>
                        <div class="col-6 text-end">{{ $order['phone'] ?? 'N/A' }}</div>
                    </div>
                    @if($order['address'])
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.address') }}:</div>
                        <div class="col-6 text-end">{{ $order['address'] }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Information -->
            @if($order['payment_method'])
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.payment_information') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.payment_method') }}:</div>
                        <div class="col-6 text-end">{{ $order['payment_method']['name'] }}</div>
                    </div>
                    @if($order['payment_method']['description'])
                    <div class="row mb-2">
                        <div class="col-6">{{ trans('ecomm::content.description') }}:</div>
                        <div class="col-6 text-end">{{ $order['payment_method']['description'] }}</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection 