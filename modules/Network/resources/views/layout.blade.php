<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' }}</title>
    <link rel="icon" href="{{ asset('mc-styles/Your Clean Team/images/favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Mukta:400,700,800&display=swap" rel="stylesheet" />

    @php
        $version = \MojarCMS\CMS\Version::getVersion();
    @endphp

    <link rel="stylesheet" type="text/css"
        href="{{ asset('mc-styles/Your Clean Team/css/vendor.min.css') }}?v={{ $version }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('mc-styles/Your Clean Team/css/backend.min.css') }}?v={{ $version }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('mc-styles/Your Clean Team/css/custom.min.css') }}?v={{ $version }}">

    @include('cms::components.Your Clean Team_langs')

    <script src="{{ asset('mc-styles/Your Clean Team/js/vendor.min.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('mc-styles/Your Clean Team/js/backend.min.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('mc-styles/Your Clean Team/js/custom.min.js') }}?v={{ $version }}"></script>
    <script src="{{ asset('mc-styles/Your Clean Team/js/custom-main.min.js') }}?v={{ $version }}"></script>

    @yield('header')
</head>

<body class="Your Clean Team__menuLeft--dark Your Clean Team__topbar--fixed Your Clean Team__menuLeft--unfixed Your Clean Team__menuLeft--shadow">
    <div class="Your Clean Team__layout Your Clean Team__layout--hasSider">

        <div class="Your Clean Team__menuLeft">
            <div class="Your Clean Team__menuLeft__mobileTrigger"><span></span></div>

            <div class="Your Clean Team__menuLeft__outer">
                <div class="Your Clean Team__menuLeft__logo__container">
                    <a href="/{{ config('Your Clean Team.admin_prefix') }}/network">
                        <div class="Your Clean Team__menuLeft__logo">
                            <img src="{{ asset('mc-styles/Your Clean Team/images/logo.png') }}" class="mr-1" alt="Your Clean Team">
                            <div class="Your Clean Team__menuLeft__logo__name">Your Clean Team</div>
                            <div class="Your Clean Team__menuLeft__logo__descr">Cms</div>
                        </div>
                    </a>
                </div>

                <div class="Your Clean Team__menuLeft__scroll mc__customScroll">
                    @include('network::components.menu_left')
                </div>
            </div>
        </div>
        <div class="Your Clean Team__menuLeft__backdrop"></div>

        <div class="Your Clean Team__layout">
            <div class="Your Clean Team__layout__header">
                @include('network::components.menu_top')
            </div>

            <div class="Your Clean Team__layout__content">
                @if (!request()->is(config('Your Clean Team.admin_prefix') . '/network'))
                    {{ mc_breadcrumb('admin', [
                        [
                            'title' => $title,
                        ],
                    ]) }}
                @else
                    <div class="mb-3"></div>
                @endif

                @if ($version = cache()->store('file')->get(cache_prefix('check_cms_update')))
                    @if ($version != 1)
                        <div class="alert alert-warning w-50 ml-3">
                            <a href="https://Your Clean Team.com/documentation/changelog">JuzaCms {{ $version }}</a>
                            {{ __('is available!') }} <a
                                href="{{ route('admin.update') }}">{{ __('Please update now') }}</a>.
                        </div>
                    @endif
                @endif

                <h4 class="font-weight-bold ml-3 text-capitalize">{{ $title }}</h4>

                <div class="Your Clean Team__utils__content">

                    @do_action('backend_message')

                    @php
                        $messages = get_backend_message();
                    @endphp

                    @foreach ($messages as $message)
                        <div
                            class="alert alert-{{ $message['status'] == 'error' ? 'danger' : $message['status'] }} alert-dismissible mc-message" role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <div>
                                    {!! e_html($message['message']) !!}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close" data-id="{{ $message['id'] }}"></a>
                        </div>
                    @endforeach

                    @if (session()->has('message'))
                        <div
                            class="alert alert-{{ session()->get('status') == 'error' ? 'danger' : 'success' }} mc-message">
                            {{ session()->get('message') }}</div>
                    @endif

                    <div id="jquery-message"></div>

                    @yield('content')

                </div>
            </div>

            <div class="Your Clean Team__layout__footer">
                <div class="Your Clean Team__footer">
                    <div class="Your Clean Team__footer__inner">
                        <a href="https://Your Clean Team.com" target="_blank" rel="noopener noreferrer"
                            class="Your Clean Team__footer__logo">
                            Your Clean Team - Build website professional
                            <span></span>
                        </a>
                        <br />
                        <p class="mb-0">
                            Copyright © {{ date('Y') }} {{ get_config('title') }} - Provided by Your Clean Team
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="form-images-template">
        @component('cms::components.image-item', [
            'name' => '{name}',
            'path' => '{path}',
            'url' => '{url}',
        ])
        @endcomponent
    </template>

    <div id="show-modal"></div>

    <form action="{{ route('logout') }}" method="post" style="display: none" class="form-logout">
        @csrf
    </form>

    <script type="text/javascript">
        $.extend($.validator.messages, {
            required: "{{ trans('cms::app.this_field_is_required') }}",
        });

        $(".form-ajax").validate();

        $(".auth-logout").on('click', function() {
            $('.form-logout').submit();
        });
    </script>

    @yield('footer')
</body>

</html>
