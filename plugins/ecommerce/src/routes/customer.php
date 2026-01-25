<?php

use Illuminate\Support\Facades\Route;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CustomerController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\OrderController;
use Mojahid\Ecommerce\Http\Middleware\CustomerAuth;

Route::middleware(['web', 'auth', CustomerAuth::class])->group(function () {
    // Customer Dashboard
    Route::get('account/dashboard', [CustomerController::class, 'dashboard'])
        ->name('customer.dashboard');
    
    // Orders
    Route::get('account/orders', [OrderController::class, 'index'])
        ->name('customer.orders.index');
        
    Route::get('account/orders/{id}', [OrderController::class, 'show'])
        ->name('customer.orders.show');
        
    // Wishlist
    Route::get('account/wishlist', [CustomerController::class, 'wishlist'])
        ->name('customer.wishlist');
    
    // Downloads
    Route::get('account/downloads', [CustomerController::class, 'downloads'])
        ->name('customer.downloads');
});
