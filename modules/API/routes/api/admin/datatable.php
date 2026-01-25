<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

use MojarCMS\API\Http\Controllers\Admin\DataTableController;

Route::group(
    [
        'prefix' => 'datatable',
    ],
    function () {
        Route::get('/{id}', [DataTableController::class, 'show']);
        //Route::get('/{id}/data', [DataTableController::class, 'getData']);
    }
);
