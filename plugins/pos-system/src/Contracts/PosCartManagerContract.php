<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Contracts;

use Mojahid\PosSystem\Models\PosCart;

interface PosCartManagerContract
{
    public function find(string|PosCart $cart = null): PosCartContract;

    public function getCurrentCartToken(): string;

    public function createCart(): PosCartContract;

    public function clearCurrentCart(): bool;
} 