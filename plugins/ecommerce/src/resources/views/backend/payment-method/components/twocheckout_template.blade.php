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
    trans('ecomm::content.twocheckout_test_account_number'),
    'data[test_account_number]',
    [
        'value' => $data['test_account_number'] ?? '',
        'placeholder' => '901248204'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.twocheckout_test_secret_word'),
    'data[test_secret_word]',
    [
        'value' => $data['test_secret_word'] ?? '',
        'placeholder' => 'tango',
        'type' => 'password'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.twocheckout_live_account_number'),
    'data[live_account_number]',
    [
        'value' => $data['live_account_number'] ?? '',
        'placeholder' => 'Your account number'
    ]
)}}

{{ Field::text(
    trans('ecomm::content.twocheckout_live_secret_word'),
    'data[live_secret_word]',
    [
        'value' => $data['live_secret_word'] ?? '',
        'placeholder' => 'Your secret word',
        'type' => 'password'
    ]
)}}
