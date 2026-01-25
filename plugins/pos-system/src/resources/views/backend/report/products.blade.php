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
                                    <a href="{{ route('admin.pos-system.reports.products') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Product Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Products Sold</h5>
                                    <h3 class="text-primary">{{ $totals['products_sold'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Quantity</h5>
                                    <h3 class="text-success">{{ $totals['total_quantity'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Revenue</h5>
                                    <h3 class="text-info">{{ pos_format_price($totals['total_revenue']) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Avg. Sale Price</h5>
                                    <h3 class="text-warning">{{ pos_format_price($totals['avg_price']) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Sales Data Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Quantity Sold</th>
                                    <th>Unit Price</th>
                                    <th>Total Revenue</th>
                                    <th>Times Sold</th>
                                    <th>Last Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productSales as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_sku ?: 'N/A' }}</td>
                                    <td>{{ $product->total_quantity }}</td>
                                    <td>{{ pos_format_price($product->unit_price) }}</td>
                                    <td>{{ pos_format_price($product->total_revenue) }}</td>
                                    <td>{{ $product->times_sold }}</td>
                                    <td>{{ mc_date_format($product->last_sold) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No product sales found for selected period</td>
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