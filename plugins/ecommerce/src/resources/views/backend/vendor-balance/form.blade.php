@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])

        <div class="row">
            <div class="col-md-12">

                {{ Field::text($model, 'balance', ['label' => trans('ecomm::content.balance')]) }}


			{{ Field::text($model, 'currency_code', ['label' => trans('ecomm::content.currency_code')]) }}


			{{ Field::text($model, 'pending_balance', ['label' => trans('ecomm::content.pending_balance')]) }}


			{{ Field::text($model, 'total_earnings', ['label' => trans('ecomm::content.total_earnings')]) }}


			{{ Field::text($model, 'total_withdrawals', ['label' => trans('ecomm::content.total_withdrawals')]) }}


			{{ Field::text($model, 'vendor_id', ['label' => trans('ecomm::content.vendor_id')]) }}


            </div>
        </div>

    @endcomponent
@endsection
