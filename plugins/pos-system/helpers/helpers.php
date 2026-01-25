<?php

use Illuminate\Support\Collection;
use Mojahid\PosSystem\Contracts\PosCartContract;
use Mojahid\PosSystem\Models\PosOrder;
use Mojahid\PosSystem\Models\PosSession;

if (!function_exists('pos_get_current_session')) {
    /**
     * Get current POS session for the authenticated user
     * 
     * @return \Mojahid\PosSystem\Models\PosSession|null
     */
    function pos_get_current_session(): ?PosSession
    {
        if (!auth()->check()) {
            return null;
        }
        
        return PosSession::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();
    }
}

if (!function_exists('pos_get_cart')) {
    /**
     * Get current POS cart
     * 
     * @return array
     */
    function pos_get_cart(): array
    {
        $cart = app(PosCartContract::class);
        return $cart->toArray();
    }
}

if (!function_exists('pos_get_cart_items')) {
    /**
     * Get POS cart items
     * 
     * @param PosCartContract|null $cart
     * @return array
     */
    function pos_get_cart_items(PosCartContract $cart = null): array
    {
        if (!$cart) {
            $cart = app(PosCartContract::class);
        }
        
        return $cart->getItems();
    }
}

if (!function_exists('pos_format_price')) {
    /**
     * Format price for POS display
     * 
     * @param float|string|int|null $price
     * @param string|null $currencyCode
     * @return string
     */
    function pos_format_price($price, ?string $currencyCode = null): string
    {
        // Handle null, empty string, or non-numeric values
        if ($price === null || $price === '' || !is_numeric($price)) {
            $price = 0.0;
        } else {
            // Convert to float to ensure proper type
            $price = (float) $price;
        }
        
        if (function_exists('ecom_format_price')) {
            return ecom_format_price($price, $currencyCode);
        }
        
        $symbol = '$';
        return $symbol . number_format($price, 2);
    }
}

if (!function_exists('pos_calculate_tax')) {
    /**
     * Calculate tax amount
     * 
     * @param float $amount
     * @param float|null $taxRate
     * @return float
     */
    function pos_calculate_tax(float $amount, ?float $taxRate = null): float
    {
        if ($taxRate === null) {
            $taxRate = config('pos-system.settings.tax_rate', 0);
        }
        
        return $amount * ($taxRate / 100);
    }
}

if (!function_exists('pos_get_order_status_options')) {
    /**
     * Get POS order status options
     * 
     * @return array
     */
    function pos_get_order_status_options(): array
    {
        return config('pos-system.order_status', []);
    }
}

if (!function_exists('pos_get_payment_method_options')) {
    /**
     * Get POS payment method options
     * 
     * @return array
     */
    function pos_get_payment_method_options(): array
    {
        return config('pos-system.payment_methods', []);
    }
}

if (!function_exists('pos_generate_order_number')) {
    /**
     * Generate unique POS order number
     * 
     * @return string
     */
    function pos_generate_order_number(): string
    {
        $prefix = 'POS';
        $timestamp = now()->format('YmdHis');
        $random = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        
        return $prefix . '-' . $timestamp . '-' . $random;
    }
}

if (!function_exists('pos_get_hold_orders')) {
    /**
     * Get held orders for current user
     * 
     * @return Collection
     */
    function pos_get_hold_orders(): Collection
    {
        if (!auth()->check()) {
            return collect([]);
        }
        
        return PosOrder::where('user_id', auth()->id())
            ->where('status', 'hold')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

if (!function_exists('pos_can_hold_order')) {
    /**
     * Check if user can hold more orders
     * 
     * @return bool
     */
    function pos_can_hold_order(): bool
    {
        $limit = config('pos-system.settings.hold_order_limit', 50);
        $currentHoldOrders = pos_get_hold_orders()->count();
        
        return $currentHoldOrders < $limit;
    }
}

if (!function_exists('pos_get_default_customer')) {
    /**
     * Get default customer name
     * 
     * @return string
     */
    function pos_get_default_customer(): string
    {
        return config('pos-system.settings.default_customer_name', 'Walk-in Customer');
    }
} 