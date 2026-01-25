<?php

use Illuminate\Support\Facades\Route;
 
Route::group(['middleware' => ['auth:admin']], function () {
    // Cookie settings routes if needed in the future
    // Currently settings are handled through the main settings page
}); 