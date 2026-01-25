<?php

declare(strict_types=1);

namespace Mojahid\CookieSettings\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use Mojahid\CookieSettings\Actions\CookieAction;
use Mojahid\CookieSettings\Actions\SettingAction;

final class CookieServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        ActionRegister::register([
            CookieAction::class,
            SettingAction::class,
        ]);
    }

    public function register(): void
    {   
       //
    }
} 