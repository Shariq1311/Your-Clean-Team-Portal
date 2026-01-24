<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\CMS\Support\Route\Auth;
use MojarCMS\Backend\Http\Controllers\Installer\AdminController;
use MojarCMS\Backend\Http\Controllers\Installer\DatabaseController;
use MojarCMS\Backend\Http\Controllers\Installer\EnvironmentController;
use MojarCMS\Backend\Http\Controllers\Installer\FinalController;
use MojarCMS\Backend\Http\Controllers\Installer\PermissionsController;
use MojarCMS\Backend\Http\Controllers\Installer\RequirementsController;
use MojarCMS\Backend\Http\Controllers\Installer\WelcomeController;
use Illuminate\Support\Facades\Route;
Route::group(
    [
        'prefix' => 'install',
        'middleware' => \MojarCMS\Backend\Http\Middleware\CanInstall::class,
    ],
    function () {
        Route::get('/', [WelcomeController::class, 'welcome'])->name('installer.welcome');
        Route::get('environment', [EnvironmentController::class, 'environment'])->name('installer.environment');

        Route::post('environment', [EnvironmentController::class, 'save'])->name('installer.environment.save');

        Route::get('requirements', [RequirementsController::class, 'requirements'])->name('installer.requirements');

        Route::get('permissions', [PermissionsController::class, 'permissions'])->name('installer.permissions');

        Route::get('database', [DatabaseController::class, 'database'])->name('installer.database');

        Route::get('admin', [AdminController::class, 'index'])->name('installer.admin');

        Route::post('admin', [AdminController::class, 'save'])->name('installer.admin.save');

        Route::get('final', [FinalController::class, 'finish'])->name('installer.finish');
    }
);

Route::group(
    [
        'middleware' => 'guest',
        'as' => 'admin.',
        'prefix' => config('mojar.admin_prefix', 'app'),
        'namespace' => 'MojarCMS\CMS\Http\Controllers',
    ],
    function () {
        Auth::routes();

        // Redirect the admin prefix root (e.g. /app) to the admin login page
        Route::get('/', fn() => redirect()->route('admin.login'));
    }
);
