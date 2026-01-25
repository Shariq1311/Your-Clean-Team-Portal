<?php

use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\OrderController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\ReviewController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;
use Mojahid\Ecommerce\Http\Controllers\Frontend\SearchController;

Route::middleware('web')->name('ecomm.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/update', [CheckoutController::class, 'update'])->name('checkout.update');
    Route::post('/checkout/apply-discount', [CheckoutController::class, 'applyDiscount'])->name('checkout.apply-discount');
    Route::post('/checkout/remove-discount', [CheckoutController::class, 'removeDiscount'])->name('checkout.remove-discount');

    Route::get('order/{token}/details', [
        OrderController::class, 
        'details'
    ])->name('order.details');

    Route::post('products/{slug}/review', [ReviewController::class, 'review']) 
    ->middleware('auth')
    ->name('products.review');
});

Route::match(['get', 'post'], 'products/search', [SearchController::class, 'index'])->name('products.search');

Route::post('/switch-currency', [\Mojahid\Ecommerce\Http\Controllers\Frontend\CurrencyController::class, 'switchCurrency'])
    ->name('ecomm.switch-currency');

Route::post('/checkout/getshipping/{token}', [CheckoutController::class, 'getShipping'])->name('checkout.getshipping');