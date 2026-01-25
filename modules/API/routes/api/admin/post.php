<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\API\Http\Controllers\Admin\PostController;

Route::group(
    [
        'prefix' => 'post-type',
    ],
    function () {
        Route::apiResource(
            '{type}',
            PostController::class,
            [
                'parameters' => [
                    '{type}' => 'id',
                ],
                'names' => 'post_type',
            ]
        );
    }
);
