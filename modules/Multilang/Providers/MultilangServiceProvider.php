<?php

namespace MojarCMS\Multilang\Providers;

use Illuminate\Routing\Router;
use MojarCMS\Multilang\Http\Middleware\Multilang;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\Multilang\MultilangAction;

class MultilangServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('theme', Multilang::class);

        $this->registerHookActions([MultilangAction::class]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mlla');
    }
}
