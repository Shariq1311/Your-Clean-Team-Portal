{{-- modules\Backend\resources\views\backend\payment-method\components\razorpay_template.blade.php --}}

{{ Field::select(
    trans('cms::app.mode'),
    'data[mode]',
    [
        'value' => $data['mode'] ?? '',
        'options' => [
            'test' => trans('cms::app.test'),
            'live' => trans('cms::app.live'),
        ],
    ]
)}}

{{ Field::text(
    trans('ecomm::content.razorpay_test_key_id'),
    'data[test_key_id]',
    [
        'value' => $data['test_key_id'] ?? '',
        'placeholder' => 'rzp_test_xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.razorpay_test_key_secret'),
    'data[test_key_secret]',
    [
        'value' => $data['test_key_secret'] ?? '',
        'placeholder' => 'xxxxxxxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.razorpay_live_key_id'),
    'data[live_key_id]',
    [
        'value' => $data['live_key_id'] ?? '',
        'placeholder' => 'rzp_live_xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.razorpay_live_key_secret'),
    'data[live_key_secret]',
    [
        'value' => $data['live_key_secret'] ?? '',
        'placeholder' => 'xxxxxxxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.razorpay_webhook_secret'),
    'data[webhook_secret]',
    [
        'value' => $data['webhook_secret'] ?? '',
        'placeholder' => 'whsec_xxxxxxxxxxxxxxx',
        'help' => trans('ecomm::content.razorpay_webhook_secret_help')
    ]
)}}
