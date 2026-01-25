<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\API\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use MojarCMS\API\Actions\APIAction;
use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\CMS\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register(
            [
                APIAction::class,
            ]
        );
    }

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'api');

        $this->app->register(RouteServiceProvider::class);
    }
}
