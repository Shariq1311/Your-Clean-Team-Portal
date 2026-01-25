<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Contracts;

use Illuminate\Support\Collection;
use Mojahid\PosSystem\Models\PosCart;

interface PosCartContract
{
    public function make(string|PosCart $cart): static;
    
    public function add(int $postId, int $quantity, array $options = []): bool;
    
    public function update(int $postId, int $quantity): bool;
    
    public function addOrUpdate(int $postId, int $quantity, array $options = []): bool;
    
    public function bulkUpdate(array $items): bool;
    
    public function removeItem(int $postId): bool;
    
    public function remove(): bool;
    
    public function getItems(): array;
    
    public function isEmpty(): bool;
    
    public function isNotEmpty(): bool;
    
    public function totalItems(): int;
    
    public function totalQuantity(): int;
    
    public function getSubtotal(): float;
    
    public function getTaxAmount(): float;
    
    public function getDiscountAmount(): float;
    
    public function getTotalAmount(): float;
    
    public function getCollectionItems(): Collection;
    
    public function getToken(): string;
    
    public function toArray(): array;
    
    public function getItemMetadata(array $item): array;
    
    public function applyDiscount(string $code): array;
    
    public function removeDiscount(string $code): array;
    
    public function clearDiscounts(): void;
    
    public function getDiscountCodes(): array;
    
    public function setCustomer(string $name, ?string $phone = null, ?string $email = null): bool;
    
    public function getCustomer(): array;
    
    public function calculateTotals(): void;
} 