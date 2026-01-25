<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapMasterAdminRoutes();
    }

    protected function mapMasterAdminRoutes()
    {
        Route::middleware('master_admin')
            ->prefix(config('Mojar.admin_prefix') . '/network')
            ->group(__DIR__ . '/../routes/master_admin.php');
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');
    }
}
