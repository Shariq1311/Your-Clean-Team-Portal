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

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->as('api.')
            ->group(__DIR__ . '/../routes/api.php');
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix(config('Mojar.admin_prefix'))
            ->middleware('admin')
            ->group(__DIR__ . '/../routes/admin.php');
    }
}
