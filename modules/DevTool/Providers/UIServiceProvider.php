<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\DevTool\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\DevTool\Actions\MenuAction;

class UIServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerHookActions([MenuAction::class]);
    }
}
