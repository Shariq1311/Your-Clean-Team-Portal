<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Supports\Manager;

use Mojahid\PosSystem\Contracts\PosCartContract;
use Mojahid\PosSystem\Contracts\PosCartManagerContract;
use Mojahid\PosSystem\Models\PosCart as PosCartModel;
use Mojahid\PosSystem\Supports\PosCart;

final class PosCartManager implements PosCartManagerContract
{
    public function __construct()
    {
        //
    }

    public function find(string|PosCartModel $cart = null): PosCartContract
    {
        if ($cart === null) {
            return $this->createCart();
        }

        return $this->loadCart($cart);
    }

    public function getCurrentCartToken(): string
    {
        $token = session('pos_cart_token');
        
        if (!$token) {
            $cart = $this->createCart();
            return $cart->getToken();
        }
        
        return $token;
    }

    public function createCart(): PosCartContract
    {
        return new PosCart();
    }

    public function clearCurrentCart(): bool
    {
        $token = session('pos_cart_token');
        
        if ($token) {
            $cart = PosCartModel::byToken($token)->first();
            if ($cart) {
                $cart->delete();
            }
            
            session()->forget('pos_cart_token');
        }
        
        return true;
    }

    protected function loadCart(string|PosCartModel $cart): PosCartContract
    {
        $posCart = new PosCart();
        return $posCart->make($cart);
    }
} 