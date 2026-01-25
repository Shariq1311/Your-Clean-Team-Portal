@extends('cms::layouts.frontend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('ecomm::frontend.customer.sidebar')
            </div>
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('ecomm::content.my_downloads') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(count($downloads) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('cms::app.title') }}</th>
                                            <th>{{ trans('ecomm::content.order') }}</th>
                                            <th>{{ trans('ecomm::content.file_name') }}</th>
                                            <th>{{ trans('ecomm::content.file_size') }}</th>
                                            <th>{{ trans('ecomm::content.downloads') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($downloads as $download)
                                            <tr>
                                                <td>{{ $download['title'] }}</td>
                                                <td>
                                                    <a href="{{ route('admin.ecommerce.my-orders.show', $download['order_id']) }}">
                                                        {{ $download['order_code'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $download['file_name'] }}</td>
                                                <td>{{ $download['file_size'] }}</td>
                                                <td>
                                                    @if($download['download_limit'] > 0)
                                                        {{ $download['download_count'] }} / {{ $download['download_limit'] }}
                                                    @else
                                                        {{ $download['download_count'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ $download['download_url'] }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download"></i> {{ trans('ecomm::content.download') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-download fa-3x text-muted"></i>
                                </div>
                                <h4>{{ trans('ecomm::content.no_downloadable_items') }}</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
