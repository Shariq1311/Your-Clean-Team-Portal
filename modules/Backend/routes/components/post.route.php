<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

use MojarCMS\Backend\Http\Controllers\Backend\CommentController;
use MojarCMS\Backend\Http\Controllers\Backend\TaxonomyController;
use MojarCMS\Backend\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::mcResource(
    'post-type/{type}/comments',
    CommentController::class,
    [
        'name' => 'comments'
    ]
);

Route::mcResource(
    'taxonomy/{type}/{taxonomy}',
    TaxonomyController::class,
    [
        'name' => 'taxonomies'
    ]
);

Route::get(
    'taxonomy/{type}/{taxonomy}/component-item',
    [TaxonomyController::class, 'getTagComponent']
);

Route::mcResource(
    'post-type/{type}',
    PostController::class,
    [
        'name' => 'posts'
    ]
);
