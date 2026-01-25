@extends('cms::layouts.backend')

{{-- @php 
    // show permissions
    dd(auth()->user()->getAllPermissions()->pluck('name'));
@endphp --}}
@section('content')
    {{ $dataTable->render() }}

@endsection
