<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\Backend\Http\Controllers\Backend\ResourceController;
use MojarCMS\Backend\Http\Controllers\Backend\ChildResourceController;
use MojarCMS\Backend\Http\Controllers\Backend\PostResourceController;
use Illuminate\Support\Facades\Route;

Route::mcResource(
    'resources/{type}/{post}',
    PostResourceController::class,
    [
        'name' => 'post_resource',
        'where' => ['post' => '[0-9]+'],
    ]
);

Route::mcResource(
    'resources/{type}/{post}/parent/{parent}',
    ChildResourceController::class,
    [
        'name' => 'child_resource',
        'where' => ['post' => '[0-9]+', 'parent' => '[0-9]+'],
    ]
);

Route::mcResource(
    'resources/{type}',
    ResourceController::class,
    [
        'name' => 'resource',
    ]
);
