<?php

namespace Mojahid\Ecommerce\Addons\PosAddon;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use Mojahid\Ecommerce\Addons\PosAddon\Actions\PosAction;

class PosAddonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // typical hooking points
        ActionRegister::register([
            PosAction::class,
        ]);
    }
}
