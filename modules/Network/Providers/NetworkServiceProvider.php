<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Providers;

use Illuminate\Contracts\Console\Kernel;
use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\Network\Commands\ArtisanCommand;
use MojarCMS\Network\Commands\MakeSiteCommand;
use MojarCMS\Network\Contracts\NetworkRegistionContract;
use MojarCMS\Network\Contracts\SiteCreaterContract;
use MojarCMS\Network\Contracts\SiteManagerContract;
use MojarCMS\Network\Contracts\SiteSetupContract;
use MojarCMS\Network\Facades\Network;
use MojarCMS\Network\Models\Site;
use MojarCMS\Network\NetworkAction;
use MojarCMS\Network\Observers\SiteModelObserver;
use MojarCMS\Network\Support\NetworkRegistion;
use MojarCMS\Network\Support\SiteCreater;
use MojarCMS\Network\Support\SiteManager;
use MojarCMS\Network\Support\SiteSetup;

class NetworkServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Network::init();

        $this->commands([MakeSiteCommand::class, ArtisanCommand::class]);

        Site::observe([SiteModelObserver::class]);

        ActionRegister::register(NetworkAction::class);
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'network');

        $this->app->singleton(
            SiteSetupContract::class,
            function ($app) {
                return new SiteSetup(
                    $app['config'],
                    $app['db']
                );
            }
        );

        $this->app->singleton(
            SiteCreaterContract::class,
            function ($app) {
                return new SiteCreater(
                    $app['db'],
                    $app['config'],
                    $app[SiteSetupContract::class]
                );
            }
        );

        $this->app->singleton(
            NetworkRegistionContract::class,
            function ($app) {
                return new NetworkRegistion(
                    $app,
                    $app['config'],
                    $app['request'],
                    $app['cache'],
                    $app['db'],
                    $app[SiteSetupContract::class],
                    $app[Kernel::class]
                );
            }
        );

        $this->app->singleton(
            SiteManagerContract::class,
            function ($app) {
                return new SiteManager(
                    $app['db'],
                    $app[SiteCreaterContract::class]
                );
            }
        );
    }
}
