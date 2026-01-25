<?php

namespace Mojahid\Ecommerce\Contracts;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Wishlist;

interface WishlistContract
{
    public function make(string|Wishlist $wishlist): static;
    public function add(int $postId, string $type): bool;
    public function removeItem(int $postId, string $type): bool;
    public function remove(): bool;
    public function getItems(): array;
    public function isEmpty(): bool;
    public function isNotEmpty(): bool;
    public function totalItems(): int;
    public function getCollectionItems(): Collection;
    public function getCode(): string;
    public function toArray(): array;
    public function hasItem(int $postId, string $type): bool;
    public function moveToCart(int $postId, string $type, int $quantity = 1): bool;
    public function moveAllToCart(): bool;
    public function getItemMetadata(array $item): array;
} 