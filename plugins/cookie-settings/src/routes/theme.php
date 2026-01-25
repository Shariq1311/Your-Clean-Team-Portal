<?php

use Illuminate\Support\Facades\Route;
 
Route::group(['middleware' => ['theme']], function () {
    // Frontend cookie routes if needed
    // Cookie functionality is handled through JavaScript injection
}); 