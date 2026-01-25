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
    trans('ecomm::content.paymongo_test_secret_key'),
    'data[test_secret_key]',
    [
        'value' => $data['test_secret_key'] ?? '',
        'placeholder' => 'sk_test_xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.paymongo_test_public_key'),
    'data[test_public_key]',
    [
        'value' => $data['test_public_key'] ?? '',
        'placeholder' => 'pk_test_xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.paymongo_live_secret_key'),
    'data[live_secret_key]',
    [
        'value' => $data['live_secret_key'] ?? '',
        'placeholder' => 'sk_live_xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.paymongo_live_public_key'),
    'data[live_public_key]',
    [
        'value' => $data['live_public_key'] ?? '',
        'placeholder' => 'pk_live_xxxxxxxxxxxxxxx'
    ]
)}}
