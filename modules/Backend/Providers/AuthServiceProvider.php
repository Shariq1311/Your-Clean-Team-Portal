<?php

namespace MojarCMS\Backend\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;
use MojarCMS\CMS\Models\User;
use MojarCMS\Backend\Policies\PostPolicy;
use MojarCMS\Backend\Policies\TaxonomyPolicy;
use MojarCMS\Backend\Policies\UserPolicy;
use MojarCMS\Backend\Policies\IsAdminPolicy;
use MojarCMS\Backend\Policies\EmployeeDataPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Taxonomy::class => TaxonomyPolicy::class,
        User::class => UserPolicy::class,
        'IsAdmin' => IsAdminPolicy::class,
        'EmployeeData' => EmployeeDataPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Admin gate: bypass all authorization for admins
        Gate::before(
            function ($user, $ability) {
                if ($user->isAdmin()) {
                    return true;
                }

                return null;
            }
        );

        // Gate for admin access
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        // Gate for managing employees
        Gate::define('manage-employees', function (User $user) {
            return $user->isAdmin();
        });

        // Gate for managing payroll
        Gate::define('manage-payroll', function (User $user) {
            return $user->isAdmin();
        });

        // Gate for viewing time tracking
        Gate::define('view-time-tracking', function (User $user) {
            return $user->isAdmin();
        });

        // Gate for generating reports
        Gate::define('generate-reports', function (User $user) {
            return $user->isAdmin();
        });

        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return config('app.frontend_url')
                    . "/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
            }
        );
    }
}
