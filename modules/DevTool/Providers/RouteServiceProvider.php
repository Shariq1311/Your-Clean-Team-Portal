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

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix(config('Mojar.admin_prefix'))
            ->middleware('admin')
            ->group(__DIR__ . '/../routes/admin.php');
    }
}
