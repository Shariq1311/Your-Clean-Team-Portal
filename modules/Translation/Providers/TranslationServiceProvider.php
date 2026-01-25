<?php

namespace MojarCMS\Translation\Providers;

use MojarCMS\CMS\Facades\ActionRegister;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\Translation\Contracts\TranslationContract;
use MojarCMS\Translation\Support\Locale;
use MojarCMS\Translation\TranslationAction;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'translation');

        ActionRegister::register(TranslationAction::class);
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(
            TranslationContract::class,
            function () {
                return new Locale();
            }
        );
    }
}
