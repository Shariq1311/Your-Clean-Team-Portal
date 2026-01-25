<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\Api\Http\Controllers\UserController;

Route::group(
    [
        'prefix' => 'profile',
        'middleware' => 'auth:api',
    ],
    function () {
        Route::get('/', [UserController::class, 'profile']);
    }
);
