@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])

        <div class="row">
            <div class="col-md-8">

                {{ Field::text($model, 'commission_amount', ['label' => trans('ecomm::content.commission_amount')]) }}


			{{ Field::text($model, 'commission_rate', ['label' => trans('ecomm::content.commission_rate')]) }}


			{{ Field::text($model, 'currency_code', ['label' => trans('ecomm::content.currency_code')]) }}


			{{ Field::text($model, 'order_amount', ['label' => trans('ecomm::content.order_amount')]) }}


			{{ Field::text($model, 'order_id', ['label' => trans('ecomm::content.order_id')]) }}


			{{ Field::text($model, 'order_item_id', ['label' => trans('ecomm::content.order_item_id')]) }}


			{{ Field::text($model, 'paid_at', ['label' => trans('ecomm::content.paid_at')]) }}


			{{ Field::text($model, 'vendor_amount', ['label' => trans('ecomm::content.vendor_amount')]) }}


			{{ Field::text($model, 'vendor_id', ['label' => trans('ecomm::content.vendor_id')]) }}


            </div>

            <div class="col-md-4">

                {{ Field::text($model, 'status', ['label' => trans('ecomm::content.status')]) }}


            </div>
        </div>

    @endcomponent
@endsection
