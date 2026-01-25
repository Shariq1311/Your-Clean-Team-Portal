<?php

use Mojahid\SupportTicket\Http\Controllers\Frontend\TicketSupportController;

Route::group(
    ['prefix' => 'ajax/ticket-support'],
    function () {
        Route::post('/submit', [TicketSupportController::class, 'submit'])->name('sticket.ticket-support.submit');
        Route::post('/{id}/comment', [TicketSupportController::class, 'comment'])->name('sticket.ticket-support.comment');
    }
);
