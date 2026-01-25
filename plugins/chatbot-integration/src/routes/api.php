<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for webhook handling.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

Route::group(['prefix' => 'chatbots'], function () {
    // Webhook endpoints
    Route::post('webhook/{provider}', function (Request $request, string $provider) {
        try {
            $chatbotManager = app(\Mojahid\ChatbotIntegration\Supports\ChatbotManager::class);
            $providerInstance = $chatbotManager->driver($provider);
            
            $result = $providerInstance->handleWebhook($request->all());
            
            // Log webhook if debug mode is enabled
            if (config('app.debug')) {
                logger()->info("Chatbot webhook received", [
                    'provider' => $provider,
                    'data' => $request->all(),
                    'result' => $result
                ]);
            }

            return response()->json($result);
        } catch (\Exception $e) {
            logger()->error("Chatbot webhook error: " . $e->getMessage(), [
                'provider' => $provider,
                'request' => $request->all()
            ]);

            return response()->json(['error' => 'Webhook processing failed'], 500);
        }
    })->name('chatbots.webhook');
}); 