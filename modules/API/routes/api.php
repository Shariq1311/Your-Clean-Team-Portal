<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\API\Http\Controllers\SettingController;
use MojarCMS\API\Http\Controllers\SidebarController;
use MojarCMS\API\Http\Middleware\Admin;

Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth:api', Admin::class],
    ],
    function () {
        require __DIR__ . '/api/admin/api.php';
    }
);

if (config('Mojar.api.frontend.enable')) {
    require __DIR__ . '/api/auth.php';
    require __DIR__ . '/api/post.php';
    require __DIR__ . '/api/taxonomy.php';
    require __DIR__ . '/api/user.php';
    require __DIR__ . '/api/menu.php';
    // api for external service
    // if (config('Mojar.api.external-service')) {
    //     require __DIR__ . '/api/external-service.php';
    // }

    Route::get('setting', [SettingController::class, 'index']);
    Route::get('sidebar/{sidebar}', [SidebarController::class, 'show']);
}
