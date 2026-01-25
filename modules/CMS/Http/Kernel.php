<?php

namespace MojarCMS\CMS\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use MojarCMS\Frontend\Http\Middleware\HandleInertiaRequests;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \MojarCMS\CMS\Http\Middleware\TrustHosts::class,
        \MojarCMS\CMS\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \MojarCMS\CMS\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \MojarCMS\CMS\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \MojarCMS\CMS\Http\Middleware\GlobalMiddleware::class,
            \MojarCMS\CMS\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \MojarCMS\CMS\Http\Middleware\VerifyCsrfToken::class,
            \MojarCMS\CMS\Http\Middleware\FilterXss::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \MojarCMS\CMS\Http\Middleware\XFrameHeadersMiddleware::class,
            //\MojarCMS\CMS\Http\Middleware\HandleInertiaRequests::class,
            \MojarCMS\Backend\Http\Middleware\Installed::class,
        ],

        'api' => [
            \MojarCMS\CMS\Http\Middleware\GlobalMiddleware::class,
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'admin' => [
            'web',
            \MojarCMS\CMS\Http\Middleware\Admin::class,
            \MojarCMS\Backend\Http\Middleware\HandleInertiaRequests::class,
        ],

        'theme' => [
            'web',
            HandleInertiaRequests::class,
            \MojarCMS\CMS\Http\Middleware\Theme::class,
        ],

        'master_admin' => [
            'web',
            \MojarCMS\Network\Http\Middleware\MasterAdmin::class
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \MojarCMS\CMS\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \MojarCMS\CMS\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'install' => \MojarCMS\Backend\Http\Middleware\CanInstall::class,
        'check.admin' => \MojarCMS\Backend\Http\Middleware\CheckAdmin::class,
        'employee.access' => \MojarCMS\Backend\Http\Middleware\EmployeeDataAccess::class,
    ];
}
