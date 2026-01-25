<div class="row">
    <div class="col-md-8">

        <div class="row">
            <div class="col-md-6">
                {{ Field::text($model, 'code', [
                    'readonly' => true
                ]) }}

                {{ Field::text($model, 'name', [
                    'readonly' => true
                ]) }}

                {{ Field::text($model, 'total', [
                    'readonly' => true,
                    'label' => trans('ecomm::content.total')
                ]) }}
                
                {{ Field::text($model, 'quantity', [
                    'readonly' => true,
                    'label' => trans('ecomm::content.quantity')
                ]) }}
            </div>

            <div class="col-md-6">
                {{ Field::text($model, 'phone', [
                    'readonly' => true,
                    'label' => trans('ecomm::content.phone')
                ]) }}

                {{ Field::text($model, 'email', [
                    'readonly' => true
                ]) }}
          
                {{ Field::text($model, 'total_price', [
                    'readonly' => true,
                    'label' => trans('ecomm::content.total_price')
                ]) }}

                {{ Field::text($model, 'payment_method_name', [
                    'readonly' => true,
                    'label' => trans('ecomm::content.payment_method_name')
                ]) }}
            </div>
        </div>

        {{ Field::text($model, 'address', [
            'readonly' => true,
            'label' => trans('ecomm::content.address')
        ]) }}

        {{ Field::text($model, 'other_address', [
            'readonly' => true,
            'label' => trans('ecomm::content.other_address')
        ]) }}

        {{ Field::textarea($model, 'notes') }}
    </div>

    <div class="col-md-4">
        {{ Field::select($model, 'payment_method_id', [
            'label' => trans('ecomm::content.payment_method'),
            'options' => $paymentMethods
        ]) }}

        {{-- status --}}
        {{ Field::select($model, 'status', [
            'label' => trans('ecomm::content.status'),
            'options' => $statuses
        ]) }}

        {{ Field::select($model, 'payment_status', [
            'label' => trans('ecomm::content.payment_status'),
            'options' => $paymentStatuses
        ]) }}

        {{ Field::select($model, 'delivery_status', [
            'label' => trans('ecomm::content.delivery_status'),
            'options' => $deliveryStatuses
        ]) }}
    </div>
</div>
