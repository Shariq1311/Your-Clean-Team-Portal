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
    trans('ecomm::content.flutterwave_test_public_key'),
    'data[test_public_key]',
    [
        'value' => $data['test_public_key'] ?? '',
        'placeholder' => 'FLWPUBK_TEST-xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.flutterwave_test_secret_key'),
    'data[test_secret_key]',
    [
        'value' => $data['test_secret_key'] ?? '',
        'placeholder' => 'FLWSECK_TEST-xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.flutterwave_test_encryption_key'),
    'data[test_encryption_key]',
    [
        'value' => $data['test_encryption_key'] ?? '',
        'placeholder' => 'FLWSECK_TESTxxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.flutterwave_live_public_key'),
    'data[live_public_key]',
    [
        'value' => $data['live_public_key'] ?? '',
        'placeholder' => 'FLWPUBK-xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.flutterwave_live_secret_key'),
    'data[live_secret_key]',
    [
        'value' => $data['live_secret_key'] ?? '',
        'placeholder' => 'FLWSECK-xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.flutterwave_live_encryption_key'),
    'data[live_encryption_key]',
    [
        'value' => $data['live_encryption_key'] ?? '',
        'placeholder' => 'xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}
