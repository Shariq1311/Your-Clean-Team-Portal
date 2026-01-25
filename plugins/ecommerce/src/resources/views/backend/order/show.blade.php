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
                        {{ trans('ecomm::content.order_details') }} #{{ $order->code }}
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
                            {{ trans('ecomm::content.back') }}
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
                        {{ trans('ecomm::content.order_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.order_code') }}</label>
                                <p class="mb-0">{{ $order->code }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.customer_name') }}</label>
                                <p class="mb-0">{{ $order->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.email') }}</label>
                                <p class="mb-0">{{ $order->email ?? trans('ecomm::content.not_set') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.phone') }}</label>
                                <p class="mb-0">{{ $order->phone ?? trans('ecomm::content.not_set') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.address') }}</label>
                                <p class="mb-0">{{ $order->address ?? trans('ecomm::content.not_set') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">{{ trans('ecomm::content.other_address') }}</label>
                                <p class="mb-0">{{ $order->other_address ?? trans('ecomm::content.not_set') }}</p>
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
                        {{ trans('ecomm::content.order_items') }} ({{ $order->orderItems->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ trans('ecomm::content.product') }}</th>
                                    <th>{{ trans('ecomm::content.quantity') }}</th>
                                    <th>{{ trans('ecomm::content.unit_price') }}</th>
                                    <th>{{ trans('ecomm::content.line_price') }}</th>
                                    <th>{{ trans('ecomm::content.vendor') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->orderItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->post && $item->post->thumbnail)
                                                <img src="{{ upload_url($item->post->thumbnail) }}" alt="{{ $item->title }}" 
                                                     class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $item->title }}</div>
                                                @if($item->post)
                                                    <small class="text-muted">{{ $item->post->title }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->quantity }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">${{ number_format($item->price, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">${{ number_format($item->line_price, 2) }}</span>
                                    </td>
                                    <td>
                                        @if($item->post && $item->post->createdBy)
                                            <span class="badge bg-info">{{ $item->post->createdBy->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ trans('cms::app.admin') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">{{ trans('ecomm::content.no_order_items') }}</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-sticky-note me-2"></i>
                        {{ trans('ecomm::content.notes') }}
                    </h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <!-- Order Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <span class="me-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-timeline"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 16l6 -7l5 5l5 -6" /><path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        </span>
                        {{ trans('ecomm::content.order_status') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.status') }}</label>
                        <div>
                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                {{ $statuses[$order->status] ?? $order->status }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.payment_status') }}</label>
                        <div>
                            <span class="badge bg-{{ $order->payment_status === 'completed' ? 'success' : ($order->payment_status === 'pending' ? 'warning' : 'danger') }}">
                                {{ $paymentStatuses[$order->payment_status] ?? $order->payment_status }}
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.delivery_status') }}</label>
                        <div>
                            <span class="badge bg-{{ $order->delivery_status === 'delivered' ? 'success' : ($order->delivery_status === 'pending' ? 'warning' : 'info') }}">
                                {{ $deliveryStatuses[$order->delivery_status] ?? $order->delivery_status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <span class="me-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" /><path d="M3 10l18 0" /><path d="M7 15l.01 0" /><path d="M11 15l2 0" /></svg>
                        </span>
                        {{ trans('ecomm::content.payment_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.payment_method') }}</label>
                        <p class="mb-0">{{ $order->paymentMethod ? $order->paymentMethod->name : $order->payment_method_name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.total_price') }}</label>
                        <p class="mb-0 text-success fw-bold fs-5">${{ number_format($order->total_price, 2) }}</p>
                    </div>
                    @if($order->discount)
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.discount') }}</label>
                        <p class="mb-0 text-danger">-${{ number_format($order->discount, 2) }}</p>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.total') }}</label>
                        <p class="mb-0 text-primary fw-bold fs-4">${{ number_format($order->total, 2) }}</p>
                    </div>
                    @if($order->discount_codes)
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.discount_codes') }}</label>
                        <p class="mb-0">{{ $order->discount_codes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Customer Information -->
            @if($order->user)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <span class="me-2">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                        </span>
                        {{ trans('ecomm::content.customer_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('cms::app.name') }}</label>
                        <p class="mb-0">{{ $order->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('ecomm::content.email') }}</label>
                        <p class="mb-0">{{ $order->user->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ trans('cms::app.created_at') }}</label>
                        <p class="mb-0">{{ mc_date_format($order->user->created_at) }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 0.5rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.table td {
    vertical-align: middle;
}

.badge {
    font-size: 0.75em;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .d-flex.align-items-center {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .d-flex.align-items-center img {
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection 