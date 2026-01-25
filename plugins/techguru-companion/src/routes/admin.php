<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Mojahid\MojarCompanion\Http\Controllers\Backend\DashboardController;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'Mojar', 'as' => 'admin.Mojar.'], function () {
    Route::get('dashboard/analytics-data',[DashboardController::class, 'analyticsData'])->name('dashboard.analytics_data');
    Route::get('dashboard/content-calendar',[DashboardController::class, 'getContentCalendar'])->name('dashboard.content_calendar');
});