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

use Mojahid\SupportTicket\Http\Controllers\Backend\{
    TicketSupportController,
    TicketSupportTypeController,
    SettingController
};

use Illuminate\Support\Facades\Route;

// Ticket Support Routes
Route::mcResource('ticket-supports/tickets', TicketSupportController::class, [
    'name' => 'ticket-supports'
]);

// Additional ticket routes
Route::post('ticket-supports/tickets/{id}/comment', [TicketSupportController::class, 'comment'])
    ->name('admin.ticket-supports.comment');
Route::post('ticket-supports/comment/delete', [TicketSupportController::class, 'deleteComment'])
    ->name('admin.ticket-supports.comment.delete');
Route::post('ticket-supports/tickets/{id}/close', [TicketSupportController::class, 'closeTicket'])
    ->name('admin.ticket-supports.close');

// Ticket Types Routes
Route::mcResource('ticket-supports/types', TicketSupportTypeController::class, [
    'name' => 'ticket-support-types'
]);

// Settings routes
Route::get('support-ticket/settings', [SettingController::class, 'index'])->name('admin.support-ticket.setting');
Route::post('support-ticket/settings', [SettingController::class, 'save'])->name('admin.support-ticket.setting.save');
