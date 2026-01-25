<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Translation\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('admin')
            ->prefix(config('Mojar.admin_prefix'))
            ->group(__DIR__ . '/../routes/admin.php');
    }
}
