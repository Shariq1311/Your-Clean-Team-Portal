<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\API\Http\Controllers\Admin\UserController;

Route::group(
    [],
    function () {
        Route::apiResource('users', UserController::class)->names('admin.user');
    }
);
