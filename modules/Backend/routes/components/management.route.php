<?php

use Illuminate\Support\Facades\Route;
use MojarCMS\Backend\Http\Controllers\Backend\ManagementController;

Route::get('managements', [ManagementController::class, 'index']);