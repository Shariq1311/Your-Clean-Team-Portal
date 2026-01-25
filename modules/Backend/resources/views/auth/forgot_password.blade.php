@extends('cms::layouts.auth')

@section('content')
<div class="page page-center">
    @if (get_config('auth_layout') == 'with_illustration')
    <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg">
                <div class="container-tight">
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                            @include('cms::auth.partials.auth_logo')
                        </a>
                    </div>
                    <div class="card card-md">
                        <div id="jquery-message"></div>
                        <div class="card-body">
                            <h2 class="h2 text-center mb-4">{{ trans('cms::app.forgot_password') }}</h2>
                            <form action="{{ route('admin.forgot_password') }}" method="post" class="form-ajax">
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                                    <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                                        <i class="fa fa-refresh me-2"></i> {{ trans('cms::app.forgot_password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-secondary mt-3">
                        {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ trans('cms::app.login') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg d-none d-lg-block">
                <img src="{{ upload_url(get_config('cover')) }}" height="300" class="d-block mx-auto" alt="">
            </div>
        </div>
    </div>

    @elseif (get_config('auth_layout') == 'with_cover')
    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px-lg-5">
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                        @include('cms::auth.partials.auth_logo')    
                    </a>
                </div>
                <h2 class="h3 text-center mb-3">{{ trans('cms::app.forgot_password') }}</h2>
                <form action="{{ route('admin.forgot_password') }}" method="post" class="form-ajax">
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                            <i class="fa fa-refresh me-2"></i> {{ trans('cms::app.forgot_password') }}
                        </button>
                    </div>
                </form>
                <div class="text-center text-secondary mt-3">
                    {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ trans('cms::app.login') }}</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <div class="bg-cover h-100 min-vh-100" style="background-image: url({{ upload_url(get_config('cover')) }})"></div>
        </div>
    </div>

    @else
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark">
                @include('cms::auth.partials.auth_logo')
            </a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">{{ trans('cms::app.forgot_password') }}</h2>
                <form action="{{ route('admin.forgot_password') }}" method="post" class="form-ajax">
                    <div class="mb-3">
                        <label class="form-label">{{ trans('cms::app.email_address') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ trans('cms::app.email_address') }}" autocomplete="off" required />
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100" data-loading-text="{{ trans('cms::app.please_wait') }}">
                            <i class="fa fa-refresh me-2"></i> {{ trans('cms::app.forgot_password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-secondary mt-3">
            {{ __('Already have an account?') }} <a href="{{ route('admin.login') }}" class="text-decoration-none">{{ trans('cms::app.login') }}</a>
        </div>
    </div>
    @endif
</div>
@endsection
