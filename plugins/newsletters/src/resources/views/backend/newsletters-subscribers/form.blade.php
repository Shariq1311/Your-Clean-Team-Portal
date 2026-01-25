@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model,
        'cardTitle' => trans('newsletters::content.newsletters_form')
    ])

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        {{ Field::text($model, 'email', ['label' => trans('newsletters::content.email')]) }}
                    </div>
                </div>

                {{ Field::checkbox($model, 'is_subscribed', ['label' => trans('newsletters::content.is_subscribed')]) }}
            </div>
        </div>

    @endcomponent
@endsection
