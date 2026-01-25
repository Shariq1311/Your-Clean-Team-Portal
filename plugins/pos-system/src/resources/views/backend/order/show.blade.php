@extends('cms::layouts.backend')

@section('content')
<div class="container-fluid">
    <!-- Order Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <span>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /></svg>
                       </span>
                        POS Order Details #{{ $order->order_number }}
                    </h4>
                    <div>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm">
                            <span class="d-flex">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </span>
                            {{ trans('cms::app.edit') }}
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
                            <span class="d-flex">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                            </span>
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <span class="me-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                        </span>
                        Order Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Order Number</label>
                                <p class="mb-0">{{ $order->order_number }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Customer Name</label>
                                <p class="mb-0">{{ $order->customer_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <p class="mb-0">{{ $order->customer_email ?? 'Not set' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <p class="mb-0">{{ $order->customer_phone ?? 'Not set' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Method</label>
                                <p class="mb-0">{!! $order->getPaymentMethodBadge() !!}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="mb-0">{!! $order->getStatusBadge() !!}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('cms::app.created_at') }}</label>
                                <p class="mb-0">{{ mc_date_format($order->created_at) }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('cms::app.updated_at') }}</label>
                                <p class="mb-0">{{ mc_date_format($order->updated_at) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <span class="me-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-box"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /></svg>
                        </span>
                        Order Items ({{ $order->orderItems->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->product_name }}</strong>
                                    </td>
                                    <td>{{ $item->product_sku ?? 'N/A' }}</td>
                                    <td>{{ pos_format_price($item->product_price) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>{{ pos_format_price($item->total_amount) }}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>{{ pos_format_price($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax:</span>
                        <span>{{ pos_format_price($order->tax_amount) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount:</span>
                        <span class="text-success">-{{ pos_format_price($order->discount_amount) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total:</strong>
                        <strong>{{ pos_format_price($order->total_amount) }}</strong>
                    </div>
                    @if($order->payment_method === 'cash')
                    <div class="d-flex justify-content-between mb-2">
                        <span>Paid Amount:</span>
                        <span>{{ pos_format_price($order->paid_amount) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Change:</span>
                        <span>{{ pos_format_price($order->change_amount) }}</span>
                    </div>
                    @endif
                </div>
            </div>

            @if($order->notes)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Notes</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 