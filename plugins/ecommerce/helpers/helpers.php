<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mojahid\Ecommerce\Http\Resources\PaymentMethodCollectionResource;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\WishlistContract;
use Mojahid\Ecommerce\Contracts\WishlistManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartItemCollectionResource;
use Mojahid\Ecommerce\Models\Currency;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Controllers\Frontend\ReviewController;

if (!function_exists('ecom_get_cart')) {
    function ecom_get_cart(): array
    {
        /**
         * @var CartContract $cart
         */
        $cart = app(CartManagerContract::class)->find();

        return [
            'code' => $cart->getCode(),
            'items' => ecom_get_cart_items($cart),
        ];
    }
}

if (!function_exists('ecom_get_cart_items')) {
    function ecom_get_cart_items(CartContract $cart = null): array
    {
        $cart = $cart ?: app(CartContract::class);

        $items = $cart->getCollectionItems();

        return (new CartItemCollectionResource($items))
            ->toArray(request());
    }
}

if (!function_exists('ecom_get_payment_methods')) {
    function ecom_get_payment_methods(): array
    {
        $methods = PaymentMethod::active()->get();

        return (new PaymentMethodCollectionResource($methods))
            ->toArray(request());
    }
}

if (!function_exists('ecom_price_with_unit')) {
    function ecom_price_with_unit(?float $price): ?string
    {
        if (is_null($price)) {
            return null;
        }

        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->convertAndFormatPrice($price);
    }
}

if (!function_exists('ecom_price_with_currency')) {
    function ecom_price_with_currency(?float $price, ?string $currencyCode = null): ?string
    {
        if (is_null($price)) {
            return null;
        }

        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->convertAndFormatPrice($price, $currencyCode);
    }
}

if (!function_exists('ecom_convert_price')) {
    function ecom_convert_price(float $price, ?string $toCurrency = null): float
    {
        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->convertPrice($price, $toCurrency);
    }
}

if (!function_exists('ecom_format_price')) {
    function ecom_format_price(float $price, ?string $currencyCode = null): string
    {
        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->formatPrice($price, $currencyCode);
    }
}

if (!function_exists('ecom_get_current_currency')) {
    function ecom_get_current_currency(): ?\Mojahid\Ecommerce\Models\Currency
    {
        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->getCurrentCurrency();
    }
}

if (!function_exists('ecom_get_current_currency_code')) {
    function ecom_get_current_currency_code(): string
    {
        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->getCurrentCurrencyCode();
    }
}

if (!function_exists('ecom_get_available_currencies')) {
    function ecom_get_available_currencies(): array
    {
        $manager = app(\Mojahid\Ecommerce\Supports\Manager\CurrencyManager::class);
        return $manager->getAvailableCurrencies();
    }
}

if (!function_exists('ecom_currency_symbol')) {
    function ecom_currency_symbol(?string $currencyCode = null): string
    {
        if (!$currencyCode) {
            $currency = ecom_get_current_currency();
            return $currency ? $currency->symbol : '$';
        }
        
        $currency = \Mojahid\Ecommerce\Models\Currency::where('code', $currencyCode)->first();
        return $currency ? $currency->symbol : '$';
    }
}

if (!function_exists('ecom_get_default_currency')) {
    function ecom_get_default_currency(): ?\Mojahid\Ecommerce\Models\Currency
    {
        return \Mojahid\Ecommerce\Models\Currency::default()->first();
    }
}

if (!function_exists('getAvailableCurrencyCodes')) {
    /**
     * Get list of available currency codes from database
     *
     * @return array
     */
    function getAvailableCurrencyCodes(): array
    {
        try {
            return \Mojahid\Ecommerce\Models\Currency::active()
                ->pluck('full_display_name', 'code')
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error fetching currency codes: ' . $e->getMessage());
            return ['USD' => 'US Dollar (USD)']; // Fallback to USD if error
        }
    }
}
if (!function_exists('ecom_get_reviews')) {
    /**
     * Get list of available currency codes from database
     *
     * @return array
     */
function ecom_get_reviews($post, $perPage = 10)
{
    $reviewController = app(ReviewController::class);
    return $reviewController->getReviews($post, $perPage);
}
}


if (!function_exists('ecom_get_average_rating')) {
    function ecom_get_average_rating($post)
{
    $reviewController = app(ReviewController::class);
    return $reviewController->getAverageRating($post);
    }
}

    
if (!function_exists('ecom_get_review_stats')) {
    function ecom_get_review_stats($post)
    {
        $reviewController = app(ReviewController::class);
        return $reviewController->getReviewStats($post);
    }
}

if (!function_exists('ecom_get_wishlist')) {
    function ecom_get_wishlist(): array
    {
        /**
         * @var WishlistContract $wishlist
         */
        $wishlist = app(WishlistManagerContract::class)->find();

        return [
            'code' => $wishlist->getCode(),
            'total_items' => $wishlist->totalItems(),
            'items' => ecom_get_wishlist_items($wishlist),
        ];
    }
}

if (!function_exists('ecom_get_wishlist_items')) {
    function ecom_get_wishlist_items(WishlistContract $wishlist = null): array
    {
        if (!$wishlist) {
            $wishlist = app(WishlistManagerContract::class)->find();
        }

        $items = $wishlist->getCollectionItems();

        return $items->map(function($item) {
            return [
                'key' => $item['type'] . '_' . $item['post_id'],
                'post_id' => $item['post_id'],
                'type' => $item['type'],
                'title' => (string) $item['title'],
                'thumbnail' => upload_url($item['thumbnail']),
                'price' => (float) $item['price'],
                'price_formatted' => ecom_price_with_unit($item['price']),
                'compare_price' => (float) ($item['compare_price'] ?? 0),
                'compare_price_formatted' => ecom_price_with_unit($item['compare_price'] ?? 0),
                'added_at' => $item['added_at'] ?? null,
                'metadata' => $item['metadata'] ?? [],
            ];
        })->toArray();
    }
}

if (!function_exists('ecom_wishlist_has_item')) {
    function ecom_wishlist_has_item(int $postId, string $type = 'products'): bool
    {
        $wishlist = app(WishlistManagerContract::class)->find();
        return $wishlist->hasItem($postId, $type);
    }
}

if (!function_exists('ecom_validate_coupon')) {
    function ecom_validate_coupon(string $code): array
    {
        $discount = \Mojahid\Ecommerce\Models\Discount::findByCode($code);
        
        if (!$discount) {
            return [
                'valid' => false,
                'message' => 'Invalid coupon code'
            ];
        }
        
        return [
            'valid' => true,
            'discount' => $discount,
            'message' => 'Coupon is valid'
        ];
    }
}

if (!function_exists('ecom_products_price_bounds')) {
    /**
     * Get min and max price across published products from posts.json_metas
     */
    function ecom_products_price_bounds(): array
    {
        try {
            $row = DB::table('posts as p')
                ->where('p.status', 'publish')
                ->where('p.type', 'products')
                ->selectRaw("MIN(CAST(JSON_UNQUOTE(JSON_EXTRACT(p.json_metas, '$.price')) AS DECIMAL(15,2))) as min_price, MAX(CAST(JSON_UNQUOTE(JSON_EXTRACT(p.json_metas, '$.price')) AS DECIMAL(15,2))) as max_price")
                ->first();

            $min = isset($row->min_price) ? (float) $row->min_price : 0.0;
            $max = isset($row->max_price) ? (float) $row->max_price : 0.0;

            if ($max <= 0) {
                $max = 1000.0;
            }

            return [
                'min' => max(0.0, $min),
                'max' => max(0.0, $max),
            ];
        } catch (\Throwable $e) {
            Log::error('ecom_products_price_bounds error: ' . $e->getMessage());
            return ['min' => 0.0, 'max' => 1000.0];
        }
    }
}

if (!function_exists('buildFilterUrl')) {
    function buildFilterUrl($newParams = []) {
        $currentParams = request()->all();
        $params = array_merge($currentParams, $newParams);
        
        // Remove empty parameters
        $params = array_filter($params, function($value) {
            return $value !== '' && $value !== null;
        });
        
        $baseUrl = request()->url();
        return $baseUrl . (empty($params) ? '' : '?' . http_build_query($params));
    }
}

// {% set cart = ecom_get_cart() %}
// {{ ecom_price_with_unit(120) }}

// Cart Page
// {% for item in cart.items %}
//   <tr>
//     <td>{{ item.title }}</td>
//     <td>{{ ecom_price_with_unit(item.price_without_unit) }}</td>
//     ...
//   </tr>
// {% endfor %}

// Example: If your "CartItemResource" returns "line_price_without_unit," you can do
// {{ ecom_price_with_unit(item.line_price_without_unit) }}

// Checkout Page
// <p>Total: {{ ecom_price_with_unit(cart.total_price) }}</p>
