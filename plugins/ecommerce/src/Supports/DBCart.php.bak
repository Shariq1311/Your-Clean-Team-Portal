<?php

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Models\Cart;
use Mojahid\Ecommerce\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use Mojahid\Ecommerce\Repositories\CartRepository;
use MojarCMS\Backend\Models\Post;
use Illuminate\Support\Facades\Log;

class DBCart implements CartContract
{
    protected CartRepository $cartRepository;

    protected Cart $cart;

    protected float $totalPrice = 0;

    public function __construct(
        CartRepository $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function make(string|Cart $cart): static
    {
        global $mc_user;

        if ($cart instanceof Cart) {
            $this->cart = $cart;
        } else {
            $this->cart = $this->cartRepository->firstOrNew(['code' => $cart]);
        }

        if ($mc_user) {
            $this->cart->user_id = $mc_user->id;
        }

        return $this;
    }

    public function add(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function update(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function addOrUpdate(int $postId, string $type = 'products', int $quantity): bool
    {
        try {
            $post = Post::where('id', $postId)
                ->where('type', $type)
                ->where('status', 'publish')
                ->first();

            if (!$post) {
                Log::error('Item not found:', [
                    'post_id' => $postId,
                    'type' => $type
                ]);
                throw new \Exception('Item not found');
            }

            // Get current items and decode if it's a JSON string
            $items = is_string($this->cart->items)
                ? json_decode($this->cart->items, true)
                : (is_array($this->cart->items) ? $this->cart->items : []);

            $key = "{$type}_{$postId}";

            $price = (float) ($post->getMeta('price') ?? 0);
            $comparePrice = (float) ($post->getMeta('compare_price') ?? 0);
            $skuCode = (string) ($post->getMeta('sku_code') ?? '');
            $barcode = (string) ($post->getMeta('barcode') ?? '');

            $items[$key] = [
                'post_id' => $post->id,
                'type' => $type,
                'quantity' => (int) $quantity,
                'price' => $price,
                'title' => (string) $post->title,
                'thumbnail' => (string) $post->thumbnail,
                'sku_code' => $skuCode,
                'barcode' => $barcode,
                'compare_price' => $comparePrice,
                'line_price' => $price * $quantity, 
            ];

            // Encode items as JSON before saving
            $this->cart->items = json_encode($items);
            $this->cart->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error in addOrUpdate:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function bulkUpdate(array $items): bool
    {
        $newItems = [];
        foreach ($items as $item) {
            $post = Post::where('id', $item['post_id'])
                ->where('type', $item['type'])
                ->first();

            if (!$post) {
                continue;
            }

            $key = "{$item['type']}_{$item['post_id']}";
            $newItems[$key] = [
                'post_id' => $post->id,
                'type' => $post->type,
                'quantity' => $item['quantity'],
                'price' => (float) $post->getMeta('price', 0),
                'title' => $post->title,
                'thumbnail' => $post->thumbnail,
                'sku_code' => $post->getMeta('sku_code'),
                'barcode' => $post->getMeta('barcode'),
                'compare_price' => (float) $post->getMeta('compare_price'),
                'line_price' => (float) $post->getMeta('price', 0) * $item['quantity'],
            ];
        }

        $this->cart->items = json_encode($newItems);
        $this->cart->save();
        return true;
    }

    public function removeItem(int $postId, string $type): bool
    {
        $items = $this->getItems();
        $key = "{$type}_{$postId}";

        if (isset($items[$key])) {
            unset($items[$key]);
            $this->cart->items = json_encode($items);
            $this->cart->save();
        }

        return true;
    }

    public function remove(): bool
    {
        Cookie::queue(Cookie::forget('mc_cart'));
        $this->cart->delete();
        return true;
    }

    public function getItems(): array
    {
        if (empty($this->cart->items)) {
            return [];
        }

        $items = $this->cart->items;

        // If it's already an array, return it
        if (is_array($items)) {
            return $items;
        }

        // Clean up the string by removing extra quotes and newlines
        if (is_string($items)) {
            $items = trim($items); // Remove whitespace
            $items = trim($items, '"'); // Remove surrounding quotes
            $items = str_replace('\\"', '"', $items); // Fix escaped quotes
            $items = str_replace("\\n", "", $items); // Remove newlines
            $items = str_replace("\\", "", $items); // Remove remaining backslashes
        }

        // Decode JSON
        $decoded = json_decode($items, true);

        // Return empty array if decode fails
        if (json_last_error() !== JSON_ERROR_NONE) {
            // JSON decode failed, return empty array
            return [];
        }

        return $decoded ?? [];
    }

    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function getCollectionItems(): Collection
    {
        $items = $this->getItems();

        return collect($items)->map(function($item) {
            $item['line_price'] = $item['price'] * $item['quantity'];
            $item['metadata'] = $this->getItemMetadata($item);
            $item['type'] = $item['type'] ?? 'products';
            $item['quantity'] = $item['quantity'] ?? 1;
            return $item;
        });
    }

    public function getCode(): string
    {
        return $this->cart->code;
    }

    public function totalPrice(): float
    {
        return $this->getCollectionItems()->sum('line_price');
    }

    public function totalItems(): int
    {
        $items = $this->getItems();
        return count($items);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'items' => $this->getItems(),
        ];
    }

    public function getDiscount(): float
    {
        return (float) ($this->cart->discount ?? 0);
    }

    public function getDiscountCodes(): array
    {
        if (empty($this->cart->discount_codes)) {
            return [];
        }

        return is_string($this->cart->discount_codes)
            ? json_decode($this->cart->discount_codes, true)
            : (is_array($this->cart->discount_codes) ? $this->cart->discount_codes : []);
    }

    public function getItemMetadata(array $item): array
    {
        return [
            'sku_code' => $item['sku_code'],
            'barcode' => $item['barcode'],
        ];
    }

    public function applyDiscount(string $code): array
    {
        global $mc_user;
        
        // Find the discount
        $discount = \Mojahid\Ecommerce\Models\Discount::findByCode($code);
        
        if (!$discount) {
            return [
                'success' => false,
                'message' => 'Invalid coupon code'
            ];
        }

        $cartTotal = $this->totalPrice();
        $cartItems = $this->getItems();
        $userId = $mc_user ? $mc_user->id : null;

        // Validate the discount
        if (!$discount->isValid($cartTotal, $cartItems, $userId)) {
            $reasons = $this->getDiscountInvalidReasons($discount, $cartTotal, $cartItems, $userId);
            return [
                'success' => false,
                'message' => $reasons[0] ?? 'This coupon is not valid for your cart'
            ];
        }

        // Check if already applied
        $currentCodes = $this->getDiscountCodes();
        if (in_array($code, $currentCodes)) {
            return [
                'success' => false,
                'message' => 'This coupon is already applied'
            ];
        }

        // Calculate discount amount
        $discountAmount = $discount->calculateDiscount($cartTotal, $cartItems);

        // Apply the discount
        $currentCodes[] = $code;
        $currentDiscount = $this->getDiscount();
        $newDiscount = $currentDiscount + $discountAmount;

        $this->cart->discount = $newDiscount;
        $this->cart->discount_codes = json_encode($currentCodes);
        $this->cart->save();

        return [
            'success' => true,
            'message' => "Coupon '{$code}' applied successfully!",
            'discount_amount' => $discountAmount,
            'total_discount' => $newDiscount,
            'cart_total' => $cartTotal - $newDiscount
        ];
    }

    public function removeDiscount(string $code): array
    {
        $currentCodes = $this->getDiscountCodes();
        
        if (!in_array($code, $currentCodes)) {
            return [
                'success' => false,
                'message' => 'Coupon not found in cart'
            ];
        }

        // Find the discount to calculate its amount
        $discount = \Mojahid\Ecommerce\Models\Discount::findByCode($code);
        if (!$discount) {
            return [
                'success' => false,
                'message' => 'Invalid coupon'
            ];
        }

        // Calculate discount amount to remove
        $cartTotal = $this->totalPrice() + $this->getDiscount(); // Total before any discounts
        $cartItems = $this->getItems();
        $discountAmount = $discount->calculateDiscount($cartTotal, $cartItems);

        // Remove the code
        $currentCodes = array_diff($currentCodes, [$code]);
        $currentDiscount = $this->getDiscount();
        $newDiscount = max(0, $currentDiscount - $discountAmount);

        $this->cart->discount = $newDiscount;
        $this->cart->discount_codes = json_encode(array_values($currentCodes));
        $this->cart->save();

        return [
            'success' => true,
            'message' => "Coupon '{$code}' removed successfully!",
            'total_discount' => $newDiscount,
            'cart_total' => $cartTotal - $newDiscount
        ];
    }

    public function clearDiscounts(): void
    {
        $this->cart->discount = 0;
        $this->cart->discount_codes = json_encode([]);
        $this->cart->save();
    }

    protected function getDiscountInvalidReasons($discount, float $cartTotal, array $cartItems, ?int $userId): array
    {
        $reasons = [];

        if (!$discount->is_active) {
            $reasons[] = 'This coupon is not active';
        }

        $now = \Carbon\Carbon::now();
        if ($discount->start_date && $now->lt($discount->start_date)) {
            $reasons[] = 'This coupon is not yet active';
        }
        if ($discount->end_date && $now->gt($discount->end_date)) {
            $reasons[] = 'This coupon has expired';
        }

        if ($discount->minimum_amount > 0 && $cartTotal < $discount->minimum_amount) {
            $minAmount = ecom_price_with_unit($discount->minimum_amount);
            $reasons[] = "Minimum order amount of {$minAmount} required";
        }

        if ($discount->usage_limit > 0 && $discount->used_count >= $discount->usage_limit) {
            $reasons[] = 'This coupon has reached its usage limit';
        }

        if (!$discount->isApplicableToCart($cartItems)) {
            $reasons[] = 'This coupon is not applicable to the items in your cart';
        }

        return $reasons;
    }
}
