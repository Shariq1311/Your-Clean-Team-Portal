@extends('cms::layouts.backend')

@section('content')
    @if($model->id)
        @include('sticket::backend.ticket_support.components.view-form')
    @else
        @include('sticket::backend.ticket_support.components.create-form')
    @endif
@endsection
