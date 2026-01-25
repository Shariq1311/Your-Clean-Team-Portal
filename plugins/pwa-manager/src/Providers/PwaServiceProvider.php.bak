<?php

declare(strict_types=1);

namespace Mojahid\PwaManager\Providers;

use EragLaravelPwa\EragLaravelPwaServiceProvider;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use Mojahid\PwaManager\Actions\PwaAction;
use Mojahid\PwaManager\Actions\SettingAction;

final class PwaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Register plugin actions
        ActionRegister::register([
            PwaAction::class,
            SettingAction::class,
        ]);

        // Load views
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'pwa-manager'
        );

        // Load translations
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'pwa'
        );

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');

        // Publish assets if needed
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/pwa-manager'),
            ], 'pwa-manager-views');

            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/pwa'),
            ], 'pwa-manager-lang');
        }
    }

    public function register(): void
    {
        $this->app->register(EragLaravelPwaServiceProvider::class);
        // Register any services needed by the plugin
        $this->app->singleton(PwaAction::class);
        $this->app->singleton(SettingAction::class);
    }
}