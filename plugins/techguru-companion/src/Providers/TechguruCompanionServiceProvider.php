<?php

namespace Mojahid\MojarCompanion\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use Mojahid\MojarCompanion\Actions\MojarCompanionAction;
use TwigBridge\Facade\Twig;
use Mojahid\MojarCompanion\Extensions\TwigExtension;

class MojarCompanionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Twig::addExtension(new TwigExtension());

        ActionRegister::register([
            MojarCompanionAction::class,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
