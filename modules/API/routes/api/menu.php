<?php

Route::group(
    ['prefix' => 'menus'],
    function () {
        Route::get('{location}', [\MojarCMS\API\Http\Controllers\MenuController::class, 'show']);
    }
);
