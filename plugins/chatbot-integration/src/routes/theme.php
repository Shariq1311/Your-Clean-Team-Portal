<?php

use Illuminate\Support\Facades\Route;

// Public chatbot routes (if needed)
Route::group(['prefix' => 'chatbot'], function () {
    // Could add public webhook routes here if needed
    // Route::post('/webhook/{provider}', 'Frontend\WebhookController@handle')->name('chatbot.webhook');
}); 