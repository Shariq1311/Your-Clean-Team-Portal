<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Http\Resources\CartItemCollectionResource;
use Illuminate\Support\Facades\Auth;
use Mojahid\Ecommerce\Http\Datatables\MyCartDatatable;

class MyCartController extends BackendController
{
    protected CartManagerContract $cartManager;

    public function __construct(CartManagerContract $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function index(): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $cart = $this->cartManager->find();
        $dataTable = new MyCartDatatable();

        return view('ecomm::backend.my-cart.index', [
            'cart' => $cart,
            'dataTable' => $dataTable,
            'total_items' => $cart->totalItems(),
            'total_price' => ecom_price_with_unit($cart->totalPrice()),
            'title' => trans('ecomm::content.my_cart'),
        ]);
    }

    public function datatable(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $dataTable = new MyCartDatatable();
        return $dataTable->ajax($request);
    }

    public function removeItem(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $postId = $request->input('post_id');
        $type = $request->input('type', 'products');

        $cart = $this->cartManager->find();
        $success = $cart->removeItem($postId, $type);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.item_removed_from_cart'),
                'total_items' => $cart->totalItems(),
                'total_price' => ecom_price_with_unit($cart->totalPrice()),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_remove_item'),
        ], 400);
    }

    public function updateQuantity(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $postId = $request->input('post_id');
        $type = $request->input('type', 'products');
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity <= 0) {
            return response()->json([
                'success' => false,
                'message' => trans('ecomm::content.quantity_must_be_greater_than_zero'),
            ], 400);
        }

        $cart = $this->cartManager->find();
        $success = $cart->addOrUpdate($postId, $type, $quantity);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.cart_updated'),
                'total_items' => $cart->totalItems(),
                'total_price' => ecom_price_with_unit($cart->totalPrice()),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_update_cart'),
        ], 400);
    }

    public function clearCart(): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $cart = $this->cartManager->find();
        $success = $cart->remove();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.cart_cleared'),
                'total_items' => 0,
                'total_price' => ecom_price_with_unit(0),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_clear_cart'),
        ], 400);
    }

    private function getThumbnailHtml($thumbnail): string
    {
        if (empty($thumbnail)) {
            return '<div class="avatar bg-secondary">-</div>';
        }

        return '<img src="' . asset($thumbnail) . '" class="avatar" alt="Product" />';
    }

    private function getActions($item): string
    {
        $actions = '<div class="btn-list">';
        
        // Add quantity control
        $actions .= '<div class="input-group mb-2" style="width: 120px;">';
        $actions .= '<span class="input-group-text btn btn-sm btn-secondary decrease-quantity" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">-</span>';
        $actions .= '<input type="number" class="form-control quantity-input" value="' . ($item['quantity'] ?? 1) . '" min="1" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">';
        $actions .= '<span class="input-group-text btn btn-sm btn-secondary increase-quantity" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">+</span>';
        $actions .= '</div>';
        
        // Add remove button
        $actions .= '<button type="button" class="btn btn-sm btn-danger remove-item" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">';
        $actions .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
        $actions .= ' Remove</button>';
        $actions .= '</div>';

        return $actions;
    }
} 