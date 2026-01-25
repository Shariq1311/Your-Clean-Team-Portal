<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MojarCMS\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;

class CurrencyController extends FrontendController
{
    public function switchCurrency(Request $request): JsonResponse
    {
        $currencyCode = $request->input('currency');
        
        if (!$currencyCode) {
            return response()->json([
                'success' => false,
                'message' => 'Currency code is required'
            ], 400);
        }

        $currencyManager = app(CurrencyManager::class);
        
        try {
            $currencyManager->setCurrentCurrencyCode($currencyCode);
            
            return response()->json([
                'success' => true,
                'message' => 'Currency switched successfully',
                'currency' => $currencyCode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to switch currency: ' . $e->getMessage()
            ], 500);
        }
    }
} 