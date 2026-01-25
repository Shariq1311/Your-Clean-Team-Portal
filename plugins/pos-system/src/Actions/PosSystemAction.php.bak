<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class PosSystemAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerConfigs']);
        $this->addAction(Action::BACKEND_CALL_ACTION, [$this, 'registerAdminAjax']);
        $this->addFilter('pos.can_access', [$this, 'filterCanAccess']);
    }

    public function registerConfigs(): void
    {
        // Register POS configurations if needed
    }

    public function registerAdminAjax(): void
    {
        // POS Terminal Ajax Routes
        HookAction::registerAdminAjax('pos-add-to-cart', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'addToCart'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-remove-item', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'removeItem'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-update-quantity', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'updateQuantity'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-apply-discount', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'applyDiscount'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-remove-discount', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'removeDiscount'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-hold-order', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'holdOrder'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-complete-order', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'completeOrder'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-print-receipt', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'printReceipt'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-search-products', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'searchProducts'],
            'method' => 'get',
        ]);

        HookAction::registerAdminAjax('pos-update-cart-item', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'updateCartItem'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-remove-cart-item', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'removeCartItem'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-get-cart', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'getCart'],
            'method' => 'get',
        ]);

        HookAction::registerAdminAjax('pos-clear-cart', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'clearCart'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-get-categories', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'getCategories'],
            'method' => 'get',
        ]);

        HookAction::registerAdminAjax('pos-get-hold-orders', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'getHoldOrders'],
            'method' => 'get',
        ]);

        HookAction::registerAdminAjax('pos-load-hold-order', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosTerminalController::class, 'loadHoldOrderToCart'],
            'method' => 'post',
        ]);

        // Session Ajax Routes
        HookAction::registerAdminAjax('pos-start-session', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosSessionController::class, 'startSession'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-end-session', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosSessionController::class, 'endSession'],
            'method' => 'post',
        ]);

        HookAction::registerAdminAjax('pos-get-session-info', [
            'callback' => [\Mojahid\PosSystem\Http\Controllers\Backend\PosSessionController::class, 'getSessionInfo'],
            'method' => 'get',
        ]);
    }

    public function filterCanAccess(bool $canAccess): bool
    {
        // Only allow admin users to access POS system
        return auth()->check() && auth()->user()->is_admin;
    }
} 