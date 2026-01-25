<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use Mojahid\Ecommerce\Contracts\WishlistManagerContract;
use Mojahid\Ecommerce\Contracts\WishlistContract;
use Mojahid\Ecommerce\Http\Resources\WishlistResource;
use Illuminate\Support\Facades\Auth;
use Mojahid\Ecommerce\Http\Datatables\MyWishlistDatatable;

class MyWishlistController extends BackendController
{
    protected WishlistManagerContract $wishlistManager;

    public function __construct(WishlistManagerContract $wishlistManager)
    {
        $this->wishlistManager = $wishlistManager;
    }

    public function index(): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $wishlist = $this->wishlistManager->find();
        $dataTable = new MyWishlistDatatable();

        return view('ecomm::backend.my-wishlist.index', [
            'wishlist' => $wishlist,
            'dataTable' => $dataTable,
            'total_items' => $wishlist->totalItems(),
            'title' => trans('ecomm::content.my_wishlist'),
        ]);
    }

    public function datatable(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $dataTable = new MyWishlistDatatable();
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

        $wishlist = $this->wishlistManager->find();
        $success = $wishlist->removeItem($postId, $type);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.item_removed_from_wishlist'),
                'total_items' => $wishlist->totalItems(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_remove_item'),
        ], 400);
    }

    public function moveToCart(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $postId = $request->input('post_id');
        $type = $request->input('type', 'products');
        $quantity = (int) $request->input('quantity', 1);

        $wishlist = $this->wishlistManager->find();
        $success = $wishlist->moveToCart($postId, $type, $quantity);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.item_moved_to_cart'),
                'total_items' => $wishlist->totalItems(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_move_to_cart'),
        ], 400);
    }

    public function moveAllToCart(): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $wishlist = $this->wishlistManager->find();
        $success = $wishlist->moveAllToCart();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.all_items_moved_to_cart'),
                'total_items' => 0,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_move_all_to_cart'),
        ], 400);
    }

    public function clearWishlist(): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $wishlist = $this->wishlistManager->find();
        $success = $wishlist->remove();

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => trans('ecomm::content.wishlist_cleared'),
                'total_items' => 0,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => trans('ecomm::content.failed_to_clear_wishlist'),
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
        
        // Move to cart button
        $actions .= '<button type="button" class="btn btn-sm btn-primary move-to-cart" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">';
        $actions .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><circle cx="9" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M5 6h2l.34 2m0 0l1.66 8h8l1.66-8H7.34z" /></svg>';
        $actions .= ' Add to Cart</button>';
        
        // Remove button
        $actions .= '<button type="button" class="btn btn-sm btn-danger remove-item" data-post-id="' . ($item['post_id'] ?? '') . '" data-type="' . ($item['type'] ?? 'products') . '">';
        $actions .= '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
        $actions .= ' Remove</button>';
        
        $actions .= '</div>';

        return $actions;
    }
} 