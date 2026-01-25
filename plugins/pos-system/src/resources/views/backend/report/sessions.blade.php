@extends('cms::layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <!-- Date Filter Form -->
                    <form method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Date From</label>
                                <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date To</label>
                                <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.pos-system.reports.sessions') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Session Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sessions</h5>
                                    <h3 class="text-primary">{{ $totals['total_sessions'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Active Sessions</h5>
                                    <h3 class="text-success">{{ $totals['active_sessions'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales</h5>
                                    <h3 class="text-info">{{ pos_format_price($totals['total_sales']) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Transactions</h5>
                                    <h3 class="text-warning">{{ $totals['total_transactions'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sessions Data Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Session Name</th>
                                    <th>User</th>
                                    <th>Opened At</th>
                                    <th>Closed At</th>
                                    <th>Status</th>
                                    <th>Opening Balance</th>
                                    <th>Closing Balance</th>
                                    <th>Total Sales</th>
                                    <th>Transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sessions as $session)
                                <tr>
                                    <td>{{ $session->session_name ?: 'Session #' . $session->id }}</td>
                                    <td>{{ $session->user->name ?? 'N/A' }}</td>
                                    <td>{{ mc_date_format($session->opened_at) }}</td>
                                    <td>{{ $session->closed_at ? mc_date_format($session->closed_at) : 'N/A' }}</td>
                                    <td>
                                        @if($session->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ pos_format_price($session->opening_balance) }}</td>
                                    <td>{{ $session->closing_balance ? pos_format_price($session->closing_balance) : 'N/A' }}</td>
                                    <td>{{ pos_format_price($session->getTotalSales()) }}</td>
                                    <td>{{ $session->total_transactions }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No sessions found for selected period</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 