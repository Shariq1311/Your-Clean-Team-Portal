@php
    $siteTitle = get_config('title', 'Your Clean Team');
    $publicLogoPath = 'mc-styles/YourCleanTeam/logo.png';
@endphp

@if ($differentAuthLogo = get_config('different_auth_logo'))
    <img src="{{ upload_url($differentAuthLogo) }}" height="36" alt="{{ $siteTitle }}">
@elseif ($logo = get_config('logo'))
    <img src="{{ upload_url($logo) }}" height="36" alt="{{ $siteTitle }}">
@elseif (file_exists(public_path($publicLogoPath)))
    <img src="{{ asset($publicLogoPath) }}" height="36" alt="{{ $siteTitle }}">
@elseif (file_exists(public_path('logo.png')))
    <img src="{{ asset('logo.png') }}" height="36" alt="{{ $siteTitle }}">
@else
    <h1 class="mb-5 px-3">
        <strong>{{ trans('cms::message.login_form.welcome', ['name' => $siteTitle]) }}</strong>
    </h1>
@endif
