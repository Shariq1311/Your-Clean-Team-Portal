<?php

use MojarCMS\Multilang\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'languages'],
    function () {
        Route::get('/', [LanguageController::class, 'index']);
        Route::post('/', [LanguageController::class, 'addLanguage']);
        Route::post('toggle-default', [LanguageController::class, 'toggleDefault'])
            ->name('admin.language.toggle-default');
    }
);
