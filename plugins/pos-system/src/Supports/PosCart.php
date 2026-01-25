<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Supports;

use Illuminate\Support\Collection;
use Mojahid\PosSystem\Contracts\PosCartContract;
use Mojahid\PosSystem\Models\PosCart as PosCartModel;
use MojarCMS\Backend\Models\Post;

final class PosCart implements PosCartContract
{
    protected PosCartModel $cart;
    protected array $items = [];
    protected array $discounts = [];

    public function __construct()
    {
        $this->loadOrCreateCart();
    }

    public function make(string|PosCartModel $cart): static
    {
        if (is_string($cart)) {
            $this->cart = PosCartModel::byToken($cart)->firstOrFail();
        } else {
            $this->cart = $cart;
        }

        $this->items = $this->cart->items ?? [];
        $this->discounts = $this->cart->discounts ?? [];

        return $this;
    }

    public function add(int $postId, int $quantity, array $options = []): bool
    {
        $post = Post::find($postId);
        if (!$post) {
            return false;
        }

        $itemKey = $this->generateItemKey($postId, $options);
        
        if (isset($this->items[$itemKey])) {
            $this->items[$itemKey]['quantity'] += $quantity;
        } else {
            $this->items[$itemKey] = [
                'post_id' => $postId,
                'name' => $post->title,
                'price' => (float) ($post->getMeta('price', 0)),
                'quantity' => $quantity,
                'options' => $options,
                'subtotal' => 0,
                'total' => 0,
                'thumbnail' => upload_url($post->thumbnail),
            ];
        }

        $this->calculateItemTotals($itemKey);
        $this->calculateTotals();
        $this->saveCart();

        return true;
    }

    public function update(int $postId, int $quantity): bool
    {
        $itemKey = $this->findItemKey($postId);
        
        if (!$itemKey) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->removeItem($postId);
        }

        $this->items[$itemKey]['quantity'] = $quantity;
        $this->calculateItemTotals($itemKey);
        $this->calculateTotals();
        $this->saveCart();

        return true;
    }

    public function addOrUpdate(int $postId, int $quantity, array $options = []): bool
    {
        $itemKey = $this->findItemKey($postId);
        
        if ($itemKey) {
            return $this->update($postId, $quantity);
        }

        return $this->add($postId, $quantity, $options);
    }

    public function bulkUpdate(array $items): bool
    {
        foreach ($items as $item) {
            if (isset($item['post_id'], $item['quantity'])) {
                $this->update($item['post_id'], $item['quantity']);
            }
        }

        return true;
    }

    public function removeItem(int $postId): bool
    {
        $itemKey = $this->findItemKey($postId);
        
        if (!$itemKey) {
            return false;
        }

        unset($this->items[$itemKey]);
        $this->calculateTotals();
        $this->saveCart();

        return true;
    }

    public function remove(): bool
    {
        $this->items = [];
        $this->discounts = [];
        $this->calculateTotals();
        $this->saveCart();

        return true;
    }

    public function getItems(): array
    {
        return array_values($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function totalItems(): int
    {
        return count($this->items);
    }

    public function totalQuantity(): int
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function getSubtotal(): float
    {
        return (float) $this->cart->subtotal;
    }

    public function getTaxAmount(): float
    {
        return (float) $this->cart->tax_amount;
    }

    public function getDiscountAmount(): float
    {
        return (float) $this->cart->discount_amount;
    }

    public function getTotalAmount(): float
    {
        return (float) $this->cart->total_amount;
    }

    public function getCollectionItems(): Collection
    {
        return collect($this->getItems());
    }

    public function getToken(): string
    {
        return $this->cart->cart_token;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->getToken(),
            'items' => $this->getItems(),
            'discounts' => $this->getDiscountCodes(),
            'subtotal' => $this->getSubtotal(),
            'tax_amount' => $this->getTaxAmount(),
            'discount_amount' => $this->getDiscountAmount(),
            'total_amount' => $this->getTotalAmount(),
            'total_quantity' => $this->totalQuantity(),
            'total_items' => $this->totalItems(),
            'customer' => $this->getCustomer(),
        ];
    }

    public function getItemMetadata(array $item): array
    {
        return $item['options'] ?? [];
    }

    public function applyDiscount(string $code): array
    {
        // Simple discount logic - extend as needed
        if (in_array($code, $this->discounts)) {
            return ['success' => false, 'message' => 'Discount already applied'];
        }

        $this->discounts[] = $code;
        $this->calculateTotals();
        $this->saveCart();

        return ['success' => true, 'message' => 'Discount applied successfully'];
    }

    public function removeDiscount(string $code): array
    {
        $key = array_search($code, $this->discounts);
        if ($key === false) {
            return ['success' => false, 'message' => 'Discount not found'];
        }

        unset($this->discounts[$key]);
        $this->discounts = array_values($this->discounts);
        $this->calculateTotals();
        $this->saveCart();

        return ['success' => true, 'message' => 'Discount removed successfully'];
    }

    public function clearDiscounts(): void
    {
        $this->discounts = [];
        $this->calculateTotals();
        $this->saveCart();
    }

    public function getDiscountCodes(): array
    {
        return $this->discounts;
    }

    public function setCustomer(string $name, ?string $phone = null, ?string $email = null): bool
    {
        $this->cart->customer_name = $name;
        $this->cart->customer_phone = $phone;
        $this->cart->customer_email = $email;
        $this->cart->save();

        return true;
    }

    public function getCustomer(): array
    {
        return [
            'name' => $this->cart->customer_name,
            'phone' => $this->cart->customer_phone,
            'email' => $this->cart->customer_email,
        ];
    }

    public function calculateTotals(): void
    {
        $subtotal = 0;
        
        foreach ($this->items as $item) {
            $subtotal += $item['total'];
        }

        $taxRate = config('pos-system.settings.tax_rate', 0);
        $taxAmount = $subtotal * ($taxRate / 100);
        
        $discountAmount = $this->calculateDiscountAmount($subtotal);
        
        $totalAmount = $subtotal + $taxAmount - $discountAmount;

        $this->cart->subtotal = $subtotal;
        $this->cart->tax_amount = $taxAmount;
        $this->cart->discount_amount = $discountAmount;
        $this->cart->total_amount = max(0, $totalAmount);
    }

    protected function loadOrCreateCart(): void
    {
        $cartToken = session('pos_cart_token');
        
        if ($cartToken) {
            $cart = PosCartModel::byToken($cartToken)->active()->first();
            if ($cart) {
                $this->cart = $cart;
                $this->items = $cart->items ?? [];
                $this->discounts = $cart->discounts ?? [];
                return;
            }
        }

        // Create new cart
        $this->cart = PosCartModel::create([
            'user_id' => auth()->id(),
            'pos_session_id' => $this->getCurrentSessionId(),
            'customer_name' => pos_get_default_customer(),
        ]);

        session(['pos_cart_token' => $this->cart->cart_token]);
    }

    protected function saveCart(): void
    {
        $this->cart->items = $this->items;
        $this->cart->discounts = $this->discounts;
        $this->cart->save();
    }

    protected function generateItemKey(int $postId, array $options = []): string
    {
        return $postId . '_' . md5(serialize($options));
    }

    protected function findItemKey(int $postId): ?string
    {
        foreach ($this->items as $key => $item) {
            if ($item['post_id'] == $postId) {
                return $key;
            }
        }
        return null;
    }

    protected function calculateItemTotals(string $itemKey): void
    {
        $item = &$this->items[$itemKey];
        $item['subtotal'] = $item['price'] * $item['quantity'];
        $item['total'] = $item['subtotal']; // Can add item-level discounts here
    }

    protected function calculateDiscountAmount(float $subtotal): float
    {
        $discountAmount = 0;
        
        // Simple discount calculation - extend as needed
        foreach ($this->discounts as $code) {
            // You can implement more complex discount logic here
            // For now, just a simple percentage or fixed amount
            if ($code === 'DISCOUNT10') {
                $discountAmount += $subtotal * 0.1;
            } elseif ($code === 'SAVE5') {
                $discountAmount += 5;
            }
        }
        
        return min($discountAmount, $subtotal);
    }

    protected function getCurrentSessionId(): ?int
    {
        $session = pos_get_current_session();
        return $session?->id;
    }
} 