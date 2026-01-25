@extends('cms::layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">POS Reports</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4>Sales Report</h4>
                                    <p>View daily sales reports and analytics</p>
                                    <a href="{{ route('admin.pos-system.reports.sales') }}" class="btn btn-primary">View Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4>Session Report</h4>
                                    <p>View cash register session reports</p>
                                    <a href="{{ route('admin.pos-system.reports.sessions') }}" class="btn btn-primary">View Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4>Product Report</h4>
                                    <p>View product performance and sales</p>
                                    <a href="{{ route('admin.pos-system.reports.products') }}" class="btn btn-primary">View Report</a>
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