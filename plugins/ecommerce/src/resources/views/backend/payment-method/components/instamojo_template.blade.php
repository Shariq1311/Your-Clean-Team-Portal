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
    trans('ecomm::content.instamojo_test_api_key'),
    'data[test_api_key]',
    [
        'value' => $data['test_api_key'] ?? '',
        'placeholder' => 'test_xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.instamojo_test_auth_token'),
    'data[test_auth_token]',
    [
        'value' => $data['test_auth_token'] ?? '',
        'placeholder' => 'test_xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.instamojo_live_api_key'),
    'data[live_api_key]',
    [
        'value' => $data['live_api_key'] ?? '',
        'placeholder' => 'xxxxxxxxxxxxxxx'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.instamojo_live_auth_token'),
    'data[live_auth_token]',
    [
        'value' => $data['live_auth_token'] ?? '',
        'placeholder' => 'xxxxxxxxxxxxxxx',
        'type' => 'password'
    ]
)}}