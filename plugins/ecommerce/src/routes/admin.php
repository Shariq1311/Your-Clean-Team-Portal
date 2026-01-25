<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Mojahid\Ecommerce\Http\Controllers\Backend\{
    OrderController,
    CustomerController,
    VendorController,
    UnverifiedVendorController,
    InvoiceController,
    SettingController,
    PaymentMethodController,
    DiscountController,
    DashboardController,
    VendorBalanceController,
    VendorEarningController,
    VendorWithdrawalController,
    OrderItemController,
    MyOrderController,
    MyCartController,
    MyWishlistController,
    MyReviewController
};

use Illuminate\Support\Facades\Route;

Route::mcResource(
    'ecommerce/orders',
    OrderController::class,
    [
        'name' => 'orders'
    ]
);

// Add show route for order details
Route::get('ecommerce/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::mcResource(
    'ecommerce/customers',
    CustomerController::class,
    [
        'name' => 'customers'
    ]
);

Route::mcResource(
    'ecommerce/vendors',
    VendorController::class,
    [
        'name' => 'vendors'
    ]
);

Route::mcResource(
    'ecommerce/unverified-vendors',
    UnverifiedVendorController::class,
    [
        'name' => 'unverified-vendors'
    ]
);

Route::get('ecommerce/settings', [SettingController::class, 'index'])->name('admin.ecommerce.setting');
Route::post('ecommerce/settings', [SettingController::class, 'save'])->name('admin.ecommerce.setting.save');


Route::mcResource('ecommerce/payment-methods', PaymentMethodController::class,[ 'name' => 'payment_methods']);

Route::mcResource('ecommerce/discounts', DiscountController::class, ['name' => 'discounts']);

// Additional discount routes
Route::group(['prefix' => 'ecommerce/discounts', 'as' => 'admin.discounts.'], function () {
    Route::post('{id}/toggle-status', [DiscountController::class, 'toggleStatus'])->name('toggle-status');
    Route::post('{id}/duplicate', [DiscountController::class, 'duplicate'])->name('duplicate');
    Route::post('{id}/reset-usage', [DiscountController::class, 'resetUsage'])->name('reset-usage');
    Route::post('validate-code', [DiscountController::class, 'validateCode'])->name('validate-code');
    Route::get('test', [DiscountController::class, 'test'])->name('test');
});

Route::group(['prefix' => 'ecommerce', 'as' => 'admin.ecommerce.'], function () {
    Route::get('dashboard/revenue-chart',[DashboardController::class, 'revenueChart'])->name('dashboard.revenue_chart');
    Route::get('dashboard/charts-data', [DashboardController::class, 'chartsData'])->name('dashboard.charts_data');
});

// Vendor Management Routes
Route::mcResource('ecommerce/vendor-balances', VendorBalanceController::class, ['name' => 'vendor_balances']);
Route::mcResource('ecommerce/vendor-earnings', VendorEarningController::class, ['name' => 'vendor_earnings']);
Route::mcResource('ecommerce/vendor-withdrawals', VendorWithdrawalController::class, ['name' => 'vendor_withdrawals']);

// Order Items Route
Route::mcResource('ecommerce/order-items', OrderItemController::class, ['name' => 'order_items']);

// Add show route for order item details
Route::get('ecommerce/order-items/{id}', [OrderItemController::class, 'show'])->name('admin.order_items.show');

// Additional vendor withdrawal routes
Route::group(['prefix' => 'ecommerce/vendor-withdrawals', 'as' => 'admin.vendor_withdrawals.'], function () {
    Route::get('{id}/approve', [VendorWithdrawalController::class, 'approve'])->name('approve');
    Route::get('{id}/reject', [VendorWithdrawalController::class, 'reject'])->name('reject');
    Route::get('{id}/complete', [VendorWithdrawalController::class, 'complete'])->name('complete');
});

// Vendor Earning routes
Route::group(['prefix' => 'ecommerce/vendor-earnings', 'as' => 'admin.vendor_earnings.'], function () {
    Route::get('{id}/mark-completed', [VendorEarningController::class, 'markCompleted'])->name('mark_completed');
});

Route::group(['prefix' => 'ecommerce/my-orders'], function () {
    Route::get('/', [MyOrderController::class, 'index'])->name('admin.ecommerce.my-orders.index');
    Route::get('/{id}', [MyOrderController::class, 'show'])->name('admin.ecommerce.my-orders.show');
    Route::post('/datatable', [MyOrderController::class, 'datatable'])->name('admin.ecommerce.my-orders.datatable');
});

// My Cart Routes
Route::group(['prefix' => 'ecommerce/my-cart'], function () {
    Route::get('/', [MyCartController::class, 'index'])->name('admin.ecommerce.my-cart.index');
    Route::post('/datatable', [MyCartController::class, 'datatable'])->name('admin.ecommerce.my-cart.datatable');
    Route::post('/remove-item', [MyCartController::class, 'removeItem'])->name('admin.ecommerce.my-cart.remove-item');
    Route::post('/update-quantity', [MyCartController::class, 'updateQuantity'])->name('admin.ecommerce.my-cart.update-quantity');
    Route::post('/clear', [MyCartController::class, 'clearCart'])->name('admin.ecommerce.my-cart.clear');
});

// My Wishlist Routes
Route::group(['prefix' => 'ecommerce/my-wishlist'], function () {
    Route::get('/', [MyWishlistController::class, 'index'])->name('admin.ecommerce.my-wishlist.index');
    Route::post('/datatable', [MyWishlistController::class, 'datatable'])->name('admin.ecommerce.my-wishlist.datatable');
    Route::post('/remove-item', [MyWishlistController::class, 'removeItem'])->name('admin.ecommerce.my-wishlist.remove-item');
    Route::post('/move-to-cart', [MyWishlistController::class, 'moveToCart'])->name('admin.ecommerce.my-wishlist.move-to-cart');
    Route::post('/move-all-to-cart', [MyWishlistController::class, 'moveAllToCart'])->name('admin.ecommerce.my-wishlist.move-all-to-cart');
    Route::post('/clear', [MyWishlistController::class, 'clearWishlist'])->name('admin.ecommerce.my-wishlist.clear');
});

// My Reviews Routes
Route::group(['prefix' => 'ecommerce/my-reviews'], function () {
    Route::get('/', [MyReviewController::class, 'index'])->name('admin.ecommerce.my-reviews.index');
    Route::post('/datatable', [MyReviewController::class, 'datatable'])->name('admin.ecommerce.my-reviews.datatable');
    Route::get('/create', [MyReviewController::class, 'create'])->name('admin.ecommerce.my-reviews.create');
    Route::post('/', [MyReviewController::class, 'store'])->name('admin.ecommerce.my-reviews.store');
    Route::get('/{id}/edit', [MyReviewController::class, 'edit'])->name('admin.ecommerce.my-reviews.edit');
    Route::put('/{id}', [MyReviewController::class, 'update'])->name('admin.ecommerce.my-reviews.update');
    Route::delete('/{id}', [MyReviewController::class, 'destroy'])->name('admin.ecommerce.my-reviews.destroy');
});