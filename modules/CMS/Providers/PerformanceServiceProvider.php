<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Providers;

use Illuminate\Support\ServiceProvider;
use MojarCMS\CMS\Support\BladeMinifyCompiler;

class PerformanceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        if (config('Mojar.performance.minify_views')) {
            $this->registerBladeCompiler();
        }
    }

    protected function registerBladeCompiler()
    {
        $this->app->singleton(
            'blade.compiler',
            function ($app) {
                return new BladeMinifyCompiler($app['files'], $app['config']['view.compiled']);
            }
        );
    }
}
