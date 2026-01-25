<?php

/**
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

use MojarCMS\Backend\Http\Controllers\Backend\Profile\ProfileController;
use MojarCMS\Backend\Http\Controllers\Backend\RoleController;
use MojarCMS\Backend\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::mcResource('users', UserController::class);

Route::mcResource('roles', RoleController::class);

Route::group(
    ['prefix' => 'profile'],
    function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('change-password', [ProfileController::class, 'changePassword'])
            ->name('admin.profile.change-password');
        Route::get('notification-datatable', [ProfileController::class, 'notificationDatatable']);

        Route::get('notification/{id}', [ProfileController::class, 'notification'])->name('admin.profile.notification');
    }
);
