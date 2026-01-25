<?php

use Illuminate\Support\Facades\Route;
use Mojahid\PosSystem\Http\Controllers\Backend\PosSessionController;
use Mojahid\PosSystem\Http\Controllers\Backend\PosOrderController;

/*
|--------------------------------------------------------------------------
| POS System Admin Routes
|--------------------------------------------------------------------------
*/

// POS Terminal Routes
Route::get('pos-system', [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'index'])
    ->name('admin.pos-system.terminal');

Route::get('pos-system/terminal', [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'terminal'])
    ->name('admin.pos-system.terminal.view');

// POS Order Items Routes
Route::prefix('pos-system/order-items')->name('admin.pos-system.order-items.')->group(function () {
    Route::get('/', [\Mojahid\PosSystem\Http\Controllers\Backend\PosOrderItemController::class, 'index'])
        ->name('index');
    
    Route::get('/datatable', [\Mojahid\PosSystem\Http\Controllers\Backend\PosOrderItemController::class, 'datatable'])
        ->name('datatable');
    
    Route::get('/{id}', [\Mojahid\PosSystem\Http\Controllers\Backend\PosOrderItemController::class, 'show'])
        ->name('show');
});

Route::mcResource('pos-system/sessions', PosSessionController::class, ['name' => 'sessions']);
// show and close route
Route::get('pos-system/sessions/{id}/show', [PosSessionController::class, 'show'])
->name('admin.pos-system.sessions.show');
Route::get('pos-system/sessions/{id}/close', [PosSessionController::class, 'close'])
->name('admin.pos-system.sessions.close');

// orders
Route::mcResource('pos-system/orders', PosOrderController::class, ['name' => 'orders']);
Route::get('pos-system/orders/{id}/show', [PosOrderController::class, 'show'])
->name('admin.pos-system.orders.show');

Route::get('pos-system/orders/{id}/print', [PosOrderController::class, 'printReceipt'])
->name('admin.pos-system.orders.print');
Route::post('pos-system/orders/{id}/refund', [PosOrderController::class, 'refund'])
->name('admin.pos-system.orders.refund');


// POS Reports Routes
Route::prefix('pos-system/reports')->name('admin.pos-system.reports.')->group(function () {
    Route::get('/', [\Mojahid\PosSystem\Http\Controllers\Backend\PosReportController::class, 'index'])
        ->name('index');
    
    Route::get('/sales', [\Mojahid\PosSystem\Http\Controllers\Backend\PosReportController::class, 'sales'])
        ->name('sales');
    
    Route::get('/sessions', [\Mojahid\PosSystem\Http\Controllers\Backend\PosReportController::class, 'sessions'])
        ->name('sessions');
    
    Route::get('/products', [\Mojahid\PosSystem\Http\Controllers\Backend\PosReportController::class, 'products'])
        ->name('products');
}); 