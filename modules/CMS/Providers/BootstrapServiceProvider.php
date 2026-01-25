<?php

namespace MojarCMS\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use MojarCMS\CMS\Contracts\LocalPluginRepositoryContract;
use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\Frontend\Providers\RouteServiceProvider;

class BootstrapServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->boot();

        $this->booted(
            function () {
                ActionRegister::init();

                do_action('Mojar.init');
            }
        );
    }

    /**
     * Register the provider.
     */
    public function register(): void
    {
        $this->app[LocalPluginRepositoryContract::class]->register();

        // Register frontend routes after load plugins
        $this->app->register(RouteServiceProvider::class);
    }
}
