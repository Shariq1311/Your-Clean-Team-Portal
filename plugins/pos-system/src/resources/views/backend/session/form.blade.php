@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        @if($model->id)
            @include('pos::backend.session.components.form_update')
        @else
            @include('pos::backend.session.components.form_create')
        @endif
    @endcomponent
@endsection 