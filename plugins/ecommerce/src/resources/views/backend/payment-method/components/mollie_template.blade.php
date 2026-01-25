{{
    Field::select(
        trans('cms::app.mode'),
        'data[mode]',
        [
            'value' => $data['mode'] ?? '',
            'options' => [
                'sandbox' => trans('cms::app.sandbox'),
                'live' => trans('cms::app.live'),
            ],
        ]
    )
}}
{{ Field::text(
    trans('ecomm::content.sandbox_api_key'),
    'data[sandbox_api_key]',
    [
        'value' => $data['sandbox_api_key'] ?? ''
    ]
) }}
{{ Field::text(
    trans('ecomm::content.live_api_key'),
    'data[live_api_key]',
    [
        'value' => $data['live_api_key'] ?? ''
    ]
) }}