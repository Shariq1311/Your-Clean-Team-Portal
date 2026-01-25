<?php

use MojarCMS\Frontend\Http\Controllers\FeedController;
use Illuminate\Support\Facades\Route;

Route::get('feed', [FeedController::class, 'index'])->name('feed');
Route::get('taxonomy/{taxonomy}/feed', [FeedController::class, 'taxonomy'])->name('feed.taxonomy');
