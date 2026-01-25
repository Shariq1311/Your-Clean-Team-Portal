<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\Frontend\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'profile'
    ],
    function () {
        Route::get('notification', [ProfileController::class, 'notification'])
            ->name('profile.notification');
        Route::get('change-password', [ProfileController::class, 'changePassword'])
            ->name('profile.change_password');
        Route::post('change-password', [ProfileController::class, 'doChangePassword']);
        Route::put('/', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::get('/{slug?}', [ProfileController::class, 'index'])
            ->name('profile');
    }
);
