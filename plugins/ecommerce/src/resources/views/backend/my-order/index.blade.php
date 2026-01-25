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
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('ecomm::content.my_orders') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 