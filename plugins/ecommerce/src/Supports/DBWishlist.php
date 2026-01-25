<?php

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Contracts\WishlistContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;
use Mojahid\Ecommerce\Repositories\WishlistRepository;
use MojarCMS\Backend\Models\Post;
use Illuminate\Support\Facades\Log;

class DBWishlist implements WishlistContract
{
    protected WishlistRepository $wishlistRepository;
    protected CartManagerContract $cartManager;
    protected Wishlist $wishlist;

    public function __construct(
        WishlistRepository $wishlistRepository,
        CartManagerContract $cartManager
    ) {
        $this->wishlistRepository = $wishlistRepository;
        $this->cartManager = $cartManager;
    }

    public function make(string|Wishlist $wishlist): static
    {
        global $mc_user;

        if ($wishlist instanceof Wishlist) {
            $this->wishlist = $wishlist;
        } else {
            $this->wishlist = $this->wishlistRepository->firstOrNew(['code' => $wishlist]);
        }

        if ($mc_user) {
            $this->wishlist->user_id = $mc_user->id;
        }

        return $this;
    }

    public function add(int $postId, string $type = 'products'): bool
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

            // Check if item already exists
            if ($this->hasItem($postId, $type)) {
                return true; // Already in wishlist
            }

            // Get current items and decode if it's a JSON string
            $items = is_string($this->wishlist->items)
                ? json_decode($this->wishlist->items, true)
                : (is_array($this->wishlist->items) ? $this->wishlist->items : []);

            $key = "{$type}_{$postId}";

            $price = (float) ($post->getMeta('price') ?? 0);
            $comparePrice = (float) ($post->getMeta('compare_price') ?? 0);
            $skuCode = (string) ($post->getMeta('sku_code') ?? '');
            $barcode = (string) ($post->getMeta('barcode') ?? '');

            $items[$key] = [
                'post_id' => $post->id,
                'type' => $type,
                'price' => $price,
                'title' => (string) $post->title,
                'thumbnail' => (string) $post->thumbnail,
                'sku_code' => $skuCode,
                'barcode' => $barcode,
                'compare_price' => $comparePrice,
                'added_at' => now()->toDateTimeString(),
            ];

            // Encode items as JSON before saving
            $this->wishlist->items = json_encode($items);
            $this->wishlist->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error in wishlist add:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function removeItem(int $postId, string $type): bool
    {
        $items = $this->getItems();
        $key = "{$type}_{$postId}";

        if (isset($items[$key])) {
            unset($items[$key]);
            $this->wishlist->items = json_encode($items);
            $this->wishlist->save();
        }

        return true;
    }

    public function remove(): bool
    {
        Cookie::queue(Cookie::forget('mc_wishlist'));
        $this->wishlist->delete();
        return true;
    }

    public function getItems(): array
    {
        if (empty($this->wishlist->items)) {
            return [];
        }

        $items = $this->wishlist->items;

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
            $item['metadata'] = $this->getItemMetadata($item);
            $item['type'] = $item['type'] ?? 'products';
            return $item;
        });
    }

    public function getCode(): string
    {
        return $this->wishlist->code;
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

    public function hasItem(int $postId, string $type): bool
    {
        $items = $this->getItems();
        $key = "{$type}_{$postId}";
        return isset($items[$key]);
    }

    public function moveToCart(int $postId, string $type, int $quantity = 1): bool
    {
        try {
            $items = $this->getItems();
            $key = "{$type}_{$postId}";
            
            if (!isset($items[$key])) {
                return false; // Item not in wishlist
            }

            $cart = $this->cartManager->find();
            $success = $cart->addOrUpdate($postId, $type, $quantity);
            
            if ($success) {
                $this->removeItem($postId, $type);
            }
            
            return $success;
        } catch (\Exception $e) {
            Log::error('Error moving wishlist item to cart:', [
                'message' => $e->getMessage(),
                'post_id' => $postId,
                'type' => $type
            ]);
            return false;
        }
    }

    public function moveAllToCart(): bool
    {
        try {
            $items = $this->getItems();
            $cart = $this->cartManager->find();
            $success = true;
            
            foreach ($items as $item) {
                $itemSuccess = $cart->addOrUpdate($item['post_id'], $item['type'], 1);
                if (!$itemSuccess) {
                    $success = false;
                }
            }
            
            if ($success) {
                $this->remove();
            }
            
            return $success;
        } catch (\Exception $e) {
            Log::error('Error moving all wishlist items to cart:', [
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function getItemMetadata(array $item): array
    {
        return [
            'sku_code' => $item['sku_code'],
            'barcode' => $item['barcode'],
            'added_at' => $item['added_at'] ?? null,
        ];
    }
} 