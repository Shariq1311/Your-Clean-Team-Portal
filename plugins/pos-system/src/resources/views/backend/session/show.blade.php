@extends('cms::layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.sessions.edit', $session->id) }}" class="btn btn-primary">
                            <i class="ti ti-edit"></i> {{ trans('cms::app.edit') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Session Info -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Session Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>Session Name:</strong></div>
                                        <div class="col-sm-8">{{ $session->session_name ?: 'Session #' . $session->id }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>User:</strong></div>
                                        <div class="col-sm-8">{{ $session->user->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>Status:</strong></div>
                                        <div class="col-sm-8">
                                            @if($session->status === 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Closed</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>Opened At:</strong></div>
                                        <div class="col-sm-8">{{ mc_date_format($session->opened_at) }}</div>
                                    </div>
                                    @if($session->closed_at)
                                    <div class="row mb-3">
                                        <div class="col-sm-4"><strong>Closed At:</strong></div>
                                        <div class="col-sm-8">{{ mc_date_format($session->closed_at) }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Financial Info -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Financial Summary</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Opening Balance:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->opening_balance) }}</div>
                                    </div>
                                    @if($session->closing_balance !== null)
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Closing Balance:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->closing_balance) }}</div>
                                    </div>
                                    @endif
                                    @if($session->expected_balance !== null)
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Expected Balance:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->expected_balance) }}</div>
                                    </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Cash Sales:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->total_cash_sales) }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Card Sales:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->total_card_sales) }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Digital Sales:</strong></div>
                                        <div class="col-sm-6">{{ pos_format_price($session->total_digital_sales) }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Total Sales:</strong></div>
                                        <div class="col-sm-6"><strong>{{ pos_format_price($session->getTotalSales()) }}</strong></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-6"><strong>Total Transactions:</strong></div>
                                        <div class="col-sm-6">{{ $session->total_transactions }}</div>
                                    </div>
                                    @if($session->status === 'closed' && $session->closing_balance !== null)
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6"><strong>Cash Difference:</strong></div>
                                        <div class="col-sm-6">
                                            <span class="{{ $session->getCashDifference() >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ pos_format_price($session->getCashDifference()) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($session->notes)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Notes</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ $session->notes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Recent Orders -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Recent Orders ({{ $session->orders->count() }})</h4>
                                </div>
                                <div class="card-body">
                                    @if($session->orders->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Order Number</th>
                                                    <th>Customer</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($session->orders->take(10) as $order)
                                                <tr>
                                                    <td>{{ $order->order_number }}</td>
                                                    <td>{{ $order->customer_name }}</td>
                                                    <td>{{ pos_format_price($order->total_amount) }}</td>
                                                    <td>{{ ucfirst($order->payment_method) }}</td>
                                                    <td>{{ $order->getStatusBadge() }}</td>
                                                    <td>{{ mc_date_format($order->created_at) }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.pos-system.orders.show', $order->id) }}" 
                                                           class="btn btn-sm btn-primary">View</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($session->orders->count() > 10)
                                    <div class="text-center mt-3">
                                        <a href="{{ route('admin.orders.index', ['session_id' => $session->id]) }}" 
                                           class="btn btn-secondary">View All Orders</a>
                                    </div>
                                    @endif
                                    @else
                                    <p class="text-muted text-center">No orders found for this session.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 