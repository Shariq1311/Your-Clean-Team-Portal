<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                {{ Field::text($model, 'order_number', [
                    'readonly' => true,
                    'label' => trans('Order Number')
                ]) }}

                {{ Field::text($model, 'customer_name', [
                    'readonly' => true,
                    'label' => trans('Customer Name')
                ]) }}

                {{ Field::text($model, 'subtotal', [
                    'readonly' => true,
                    'label' => trans('Subtotal')
                ]) }}
                
                {{ Field::text($model, 'total_amount', [
                    'readonly' => true,
                    'label' => trans('Total Amount')
                ]) }}
            </div>

            <div class="col-md-6">
                {{ Field::text($model, 'customer_phone', [
                    'readonly' => true,
                    'label' => trans('Customer Phone')
                ]) }}

                {{ Field::text($model, 'customer_email', [
                    'readonly' => true,
                    'label' => trans('Customer Email')
                ]) }}
          
                {{ Field::text($model, 'tax_amount', [
                    'readonly' => true,
                    'label' => trans('Tax Amount')
                ]) }}

                {{ Field::text($model, 'paid_amount', [
                    'readonly' => true,
                    'label' => trans('Paid Amount')
                ]) }}
            </div>
        </div>

        {{ Field::text($model, 'discount_amount', [
            'readonly' => true,
            'label' => trans('Discount Amount')
        ]) }}

        {{ Field::text($model, 'change_amount', [
            'readonly' => true,
            'label' => trans('Change Amount')
        ]) }}

        {{ Field::textarea($model, 'notes', [
            'label' => trans('Notes')
        ]) }}
    </div>

    <div class="col-md-4">
        {{ Field::select($model, 'payment_method', [
            'label' => trans('Payment Method'),
            'options' => $payment_methods ?? [
                'cash' => 'Cash',
                'card' => 'Card'
            ]
        ]) }}

        {{ Field::select($model, 'status', [
            'label' => trans('Status'),
            'options' => $statuses ?? [
                'pending' => 'Pending',
                'completed' => 'Completed',
                'hold' => 'Hold',
                'cancelled' => 'Cancelled',
                'refunded' => 'Refunded'
            ]
        ]) }}

        @if($model->completed_at)
        {{ Field::text($model, 'completed_at', [
            'readonly' => true,
            'label' => trans('Completed At'),
            'value' => $model->completed_at ? $model->completed_at->format('Y-m-d H:i:s') : ''
        ]) }}
        @endif
    </div>
</div> 