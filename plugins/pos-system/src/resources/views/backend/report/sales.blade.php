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
                                    <a href="{{ route('admin.pos-system.reports.sales') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Sales Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Orders</h5>
                                    <h3 class="text-primary">{{ $totals['total_orders'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales</h5>
                                    <h3 class="text-success">{{ pos_format_price($totals['total_sales']) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Cash Sales</h5>
                                    <h3 class="text-info">{{ pos_format_price($totals['cash_sales']) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card Sales</h5>
                                    <h3 class="text-warning">{{ pos_format_price($totals['card_sales']) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Data Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total Orders</th>
                                    <th>Total Sales</th>
                                    <th>Cash Sales</th>
                                    <th>Card Sales</th>
                                    <th>Digital Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($salesData as $data)
                                <tr>
                                    <td>{{ mc_date_format($data->date) }}</td>
                                    <td>{{ $data->total_orders }}</td>
                                    <td>{{ pos_format_price($data->total_sales) }}</td>
                                    <td>{{ pos_format_price($data->cash_sales) }}</td>
                                    <td>{{ pos_format_price($data->card_sales) }}</td>
                                    <td>{{ pos_format_price($data->digital_sales) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No sales data found for selected period</td>
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