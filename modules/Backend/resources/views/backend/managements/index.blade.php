@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        @php
            $settings = [
                'email' => [
                    'title' => trans('cms::app.managements-area.email'),
                    'icon' => [
                        'type' => 'svg',
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>',
                    ],
                    'children' => [
                        [
                            'id' => 'email_templates',
                            'title' => trans('cms::app.managements-area.email_templates'),
                            'description' => trans('cms::app.managements-area.email_templates_settings_description'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-template',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'url' => route('admin.email-template.index'),
                            'priority' => -9980,
                        ],
                        [
                            'id' => 'email_logs',
                            'title' => trans('cms::app.managements-area.email_logs'),
                            'description' => trans('cms::app.managements-area.email_logs_settings_description'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-logs',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'url' => route('admin.logs.email'),
                            'priority' => -9970,
                        ],
                    ],
                ],
                'tools' => [
                    'title' => trans('cms::app.managements-area.tools'),
                    'icon' => [
                        'type' => 'svg',
                        'svg' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                    ],
                    'children' => [
                        [
                            'id' => 'email_templates',
                            'title' => trans('cms::app.import'),
                            'description' => trans('cms::app.managements-area.email_templates_settings_description'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-template',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'url' => "imports",
                            'priority' => -9980,
                        ],
                        [
                            'id' => 'log-viewer',
                            'title' => trans('cms::app.managements-area.log_viewer'),
                            'description' => trans('cms::app.managements-area.log_viewer_settings_description'),
                            'url' => route('admin.logs.error.index'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-template',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'priority' => -9950,
                        ],
                        [
                            'id' => 'dev-tools',
                            'title' => trans('cms::app.managements-area.dev_tools'),
                            'description' => trans('cms::app.managements-area.dev_tools_settings_description'),
                            // 'url' => Route::has('admin.dev-tool') ? route('admin.dev-tool') : '#',
                            'url' => Route::has('admin.dev-tool') ? route('admin.dev-tool') : '#',
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-template',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'priority' => -9940,
                        ],
                        [
                            'id' => 'translations',
                            'title' => trans('cms::app.translations'),
                            'description' => trans('cms::app.managements-area.translations_settings_description'),
                            'url' => route('admin.translations.index'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'email-template',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'priority' => -9930,
                        ],
                        [
                            'id' => 'api-documentation',
                            'title' => trans('cms::app.api_documentation'),
                            'description' => trans('cms::app.managements-area.api_documentation_settings_description'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'api-documentation',
                                'svg' =>
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-code"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M20 21l2 -2l-2 -2" /><path d="M17 17l-2 2l2 2" /></svg>',
                            ],
                            'url' => route('admin.api.documentation'),
                            'priority' => -9920,
                        ],
                        [
                            'id' => 'updates',
                            'title' => trans('cms::app.updates'),
                            'description' => trans('cms::app.managements-area.updates_settings_description'),
                            'icon' => [
                                'type' => 'svg',
                                'value' => 'api-documentation',
                                'svg' =>
                                    '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-rotate-clockwise-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5" /><path d="M5.63 7.16l0 .01" /><path d="M4.06 11l0 .01" /><path d="M4.63 15.1l0 .01" /><path d="M7.16 18.37l0 .01" /><path d="M11 19.94l0 .01" /></svg>',
                            ],
                            'url' => route('admin.update'),
                            'priority' => -9910,
                        ],
                    ],
                ]
            ];
        @endphp
        <div class="container-xl">
            @foreach ($settings as $groupKey => $group)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0 d-flex align-items-center">
                            <span class="settings-icon-wrapper me-2">
                                {!! $group['icon']['svg'] !!}
                            </span>
                            <span class="me-2">{{ $group['title'] }}</span>
                            <span
                                class="badge bg-primary-subtle text-primary fs-6">{{ trans('cms::app.managements-area.system') }}</span>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($group['children'] as $setting)
                                <div class="col-12 col-sm-6 col-md-4" id="panel-section-item-settings-{{ $setting['id'] }}">
                                    <div class="card card-sm settings-card h-100">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-auto">
                                                    <div class="settings-icon-wrapper">
                                                        {!! $setting['icon']['svg'] !!}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h3 class="settings-title mb-1">
                                                        <a href="{{ $setting['url'] }}"
                                                            class="text-decoration-none stretched-link">
                                                            {{ $setting['title'] }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-muted mb-0 settings-description">
                                                        {{ $setting['description'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
