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

use Illuminate\Support\Facades\Route;
use Mojahid\Newsletters\Http\Controllers\Backend\NewslettersController;

Route::mcResource('newsletters-subscribers', NewslettersController::class);
