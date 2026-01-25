<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

use MojarCMS\API\Http\Controllers\Admin\SettingController;

Route::group(
    [
        'prefix' => 'setting',
    ],
    function () {
        Route::get('configs', [SettingController::class, 'configs']);
    }
);
