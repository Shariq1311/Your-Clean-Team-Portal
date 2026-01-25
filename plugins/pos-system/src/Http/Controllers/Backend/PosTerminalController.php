<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;
use Mojahid\PosSystem\Contracts\PosCartManagerContract;
use Mojahid\PosSystem\Models\PosOrder;
use Mojahid\PosSystem\Models\PosSession;

final class PosTerminalController extends BackendController
{
    protected PosCartManagerContract $cartManager;

    public function __construct(PosCartManagerContract $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function index(): View
    {
        $this->addBreadcrumb([
            'title' => trans('POS Terminal'),
            'url' => route('admin.pos-system.terminal'),
        ]);

        // Check if user has an active session
        $currentSession = pos_get_current_session();
        $cart = $this->cartManager->find();
        $holdOrders = pos_get_hold_orders();

        $title = trans('POS Terminal');

        return $this->view('pos::backend.terminal.index', compact(
            'title',
            'currentSession',
            'cart',
            'holdOrders'
        ));
    }

    public function terminal(): View
    {
        return $this->index();
    }

    public function addToCart(Request $request): JsonResponse
    {
        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cartManager->find();
        $success = $cart->add((int) $request->post_id, (int) $request->quantity);

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
            'cart' => $cart->toArray(),
        ]);
    }

    public function removeItem(Request $request): JsonResponse
    {
        $request->validate([
            'post_id' => 'required|integer',
        ]);

        $cart = $this->cartManager->find();
        $success = $cart->removeItem((int) $request->post_id);

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully',
            'cart' => $cart->toArray(),
        ]);
    }

    public function updateQuantity(Request $request): JsonResponse
    {
        $request->validate([
            'post_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $this->cartManager->find();
        $success = $cart->update((int) $request->post_id, (int) $request->quantity);

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update item quantity',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'cart' => $cart->toArray(),
        ]);
    }

    public function applyDiscount(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $cart = $this->cartManager->find();
        $result = $cart->applyDiscount($request->code);

        return response()->json($result);
    }

    public function removeDiscount(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $cart = $this->cartManager->find();
        $result = $cart->removeDiscount($request->code);

        return response()->json($result);
    }

    public function holdOrder(Request $request): JsonResponse
    {
        if (!pos_can_hold_order()) {
            return response()->json([
                'success' => false,
                'message' => 'Hold order limit reached',
            ], 400);
        }

        $cartItems = $request->input('cart', []);

        if (empty($cartItems)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot hold empty cart',
            ], 400);
        }

        // Calculate totals from cart items
        $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $taxRate = config('pos-system.tax_rate', 0) / 100;
        $taxAmount = $subtotal * $taxRate;
        $discountAmount = 0; // TODO: Get from request if discount applied
        $totalAmount = $subtotal + $taxAmount - $discountAmount;

        // Get current session
        $currentSession = pos_get_current_session();

        // Create held order
        $order = PosOrder::create([
            'order_number' => pos_generate_order_number(),
            'user_id' => auth()->id(),
            'pos_session_id' => $currentSession?->id,
            'customer_name' => $request->input('customer_name', 'Walk-in Customer'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_email' => $request->input('customer_email'),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'status' => PosOrder::STATUS_HOLD,
            'order_data' => [
                'items' => $cartItems,
                'discounts' => [],
                'held_at' => now(),
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order held successfully',
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ]);
    }

    public function loadHoldOrder(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required|integer|exists:pos_orders,id',
        ]);

        $order = PosOrder::where('id', $request->order_id)
            ->where('status', PosOrder::STATUS_HOLD)
            ->where('user_id', auth()->id())
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Hold order not found',
            ], 404);
        }

        // Load order data into cart
        $cart = $this->cartManager->find();
        $cart->remove(); // Clear current cart

        $orderData = $order->order_data;
        if (isset($orderData['items'])) {
            foreach ($orderData['items'] as $item) {
                $cart->add($item['post_id'], $item['quantity'], $item['options'] ?? []);
            }
        }

        if (isset($orderData['discounts'])) {
            foreach ($orderData['discounts'] as $code) {
                $cart->applyDiscount($code);
            }
        }

        // Set customer info
        $cart->setCustomer(
            $order->customer_name,
            $order->customer_phone,
            $order->customer_email
        );

        // Delete the hold order
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hold order loaded successfully',
            'cart' => $cart->toArray(),
        ]);
    }

    public function completeOrder(Request $request): JsonResponse
    {
        $request->validate([
            'payment_method' => 'required|string|in:cash,card,digital',
            'paid_amount' => 'required|numeric|min:0',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'customer_email' => 'nullable|email',
        ]);

        $cart = $this->cartManager->find();

        if ($cart->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot complete empty cart',
            ], 400);
        }

        $totalAmount = $cart->getTotalAmount();
        $paidAmount = $request->paid_amount;
        $changeAmount = max(0, $paidAmount - $totalAmount);

        // Create completed order
        $order = PosOrder::create([
            'order_number' => pos_generate_order_number(),
            'user_id' => auth()->id(),
            'pos_session_id' => pos_get_current_session()?->id,
            'customer_name' => $request->customer_name ?: pos_get_default_customer(),
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'subtotal' => $cart->getSubtotal(),
            'tax_amount' => $cart->getTaxAmount(),
            'discount_amount' => $cart->getDiscountAmount(),
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'change_amount' => $changeAmount,
            'payment_method' => $request->payment_method,
            'status' => PosOrder::STATUS_COMPLETED,
            'completed_at' => now(),
        ]);

        // Create order items
        foreach ($cart->getItems() as $item) {
            $order->orderItems()->create([
                'post_id' => $item['post_id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
                'total_amount' => $item['total'],
                'product_data' => $item,
            ]);
        }

        // Update session totals
        $this->updateSessionTotals($request->payment_method, $totalAmount);

        // Clear cart
        $cart->remove();

        return response()->json([
            'success' => true,
            'message' => 'Order completed successfully',
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'change_amount' => $changeAmount,
            'print_url' => route('admin.pos-system.orders.print', $order->id),
        ]);
    }

    public function printReceipt(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required|integer|exists:pos_orders,id',
        ]);

        $order = PosOrder::with('orderItems', 'user')->find($request->order_id);

        return response()->json([
            'success' => true,
            'receipt_data' => [
                'order' => $order->toArray(),
                'items' => $order->orderItems->toArray(),
                'cashier' => $order->user->name,
                'printed_at' => now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function searchProducts(Request $request): JsonResponse
    {
        $search = $request->get('search', '');
        $category = $request->get('category', '');
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 12);

        // Use the same query builder pattern as your working frontend code
        $query = Post::selectFrontendBuilder()
            ->where('type', 'products')
            ->where('status', 'publish');

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', MC_SQL_LIKE, "%{$search}%")
                ->orWhere('slug', MC_SQL_LIKE, "%{$search}%")
                ->orWhereHas('metas', function ($metaQuery) use ($search) {
                    $metaQuery->where('meta_key', 'sku')
                            ->where('meta_value', MC_SQL_LIKE, "%{$search}%");
                });
            });
        }

        // Apply category filter using the same pattern as your working code
        if ($category) {
            // Based on your system structure, filter by taxonomy ID
            $query->whereHas('taxonomies', function ($q) use ($category) {
                $q->where('id', $category)
                ->where('taxonomy', 'categories'); // Assuming 'categories' is your taxonomy type
            });
        }

        // Get products with metas relationship
        $products = $query->with(['metas'])
                        ->paginate($limit, ['*'], 'page', $page);

        $items = collect($products->items())->map(function ($product) {
            $price = (float) $product->getMeta('price', 0);
            
            // Handle thumbnail - try different approaches based on your system
            $thumbnailUrl = null;
            if (isset($product->thumbnail) && $product->thumbnail) {
                $thumbnailUrl = $product->thumbnail;
            } else {
                $thumbnailUrl = $product->getMeta('thumbnail', null);
            }
            
            // Ensure we have a valid thumbnail URL
            if ($thumbnailUrl && !filter_var($thumbnailUrl, FILTER_VALIDATE_URL)) {
                $thumbnailUrl = upload_url($thumbnailUrl);
            }
            
            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $price,
                'price_formatted' => pos_format_price($price),
                'sku' => $product->getMeta('sku', ''),
                'thumbnail' => $thumbnailUrl,
                'stock' => (int) $product->getMeta('stock', 0),
                'in_stock' => $product->getMeta('stock', 0) > 0,
            ];
        });

        return response()->json([
            'success' => true,
            'products' => $items,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'has_more' => $products->hasMorePages(),
            ],
        ]);
    }

    protected function updateSessionTotals(string $paymentMethod, float $amount): void
    {
        $session = pos_get_current_session();
        if (!$session) {
            return;
        }

        $session->increment('total_transactions');

        switch ($paymentMethod) {
            case 'cash':
                $session->increment('total_cash_sales', $amount);
                break;
            case 'card':
                $session->increment('total_card_sales', $amount);
                break;
            case 'digital':
                $session->increment('total_digital_sales', $amount);
                break;
        }

        $session->save();
    }



    public function updateCartItem(Request $request): JsonResponse
    {
        try {
            $postId = (int) $request->input('post_id');
            $quantity = (int) $request->input('quantity');

            $cart = $this->cartManager->find();
            $success = $cart->update($postId, $quantity);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart item updated successfully',
                    'cart_total' => pos_format_price($cart->getTotalAmount()),
                    'cart_count' => $cart->totalItems()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart item'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeCartItem(Request $request): JsonResponse
    {
        try {
            $postId = (int) $request->input('post_id');

            $cart = $this->cartManager->find();
            $success = $cart->removeItem($postId);

            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart successfully',
                    'cart_total' => pos_format_price($cart->getTotalAmount()),
                    'cart_count' => $cart->totalItems()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to remove item from cart'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove from cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCart(Request $request): JsonResponse
    {
        try {
            $cart = $this->cartManager->find();
            
            return response()->json([
                'success' => true,
                'cart' => [
                    'items' => $cart->getItems(),
                    'subtotal' => $cart->getSubtotal(),
                    'tax_amount' => $cart->getTaxAmount(),
                    'discount_amount' => $cart->getDiscountAmount(),
                    'total_amount' => $cart->getTotalAmount(),
                    'total_items' => $cart->totalItems(),
                    'total_quantity' => $cart->totalQuantity(),
                    'is_empty' => $cart->isEmpty()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clearCart(Request $request): JsonResponse
    {
        try {
            $cart = $this->cartManager->find();
            $cart->remove();

            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCategories(Request $request): JsonResponse
    {
        try {
            $categories = \MojarCMS\Backend\Models\Taxonomy::where('post_type', 'products')
                ->where('taxonomy', 'categories')
                ->select('id', 'name', 'slug', 'description')
                ->limit(100)
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'categories' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load categories: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getHoldOrders(Request $request): JsonResponse
    {
        try {
            $holdOrders = PosOrder::where('status', PosOrder::STATUS_HOLD)
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(['id', 'order_number', 'customer_name', 'total_amount', 'created_at']);

            return response()->json([
                'success' => true,
                'orders' => $holdOrders->map(function ($order) {
                    return [
                        'id' => $order->id,
                        'order_number' => $order->order_number,
                        'customer_name' => $order->customer_name,
                        'total_amount' => pos_format_price($order->total_amount),
                        'created_at' => $order->created_at->format('M d, H:i'),
                        'items_count' => count($order->order_data['items'] ?? [])
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load hold orders: ' . $e->getMessage()
            ], 500);
        }
    }

    public function loadHoldOrderToCart(Request $request): JsonResponse
    {
        try {
            $orderId = $request->input('order_id');
            $order = PosOrder::where('id', $orderId)
                ->where('status', PosOrder::STATUS_HOLD)
                ->where('user_id', auth()->id())
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hold order not found'
                ], 404);
            }

            // Delete the hold order since we're loading it back to cart
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hold order loaded successfully',
                'cart_data' => [
                    'items' => $order->order_data['items'] ?? [],
                    'customer' => [
                        'name' => $order->customer_name,
                        'phone' => $order->customer_phone,
                        'email' => $order->customer_email,
                    ],
                    'discount_amount' => $order->discount_amount,
                    'applied_discount' => $order->order_data['discounts'] ?? []
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load hold order: ' . $e->getMessage()
            ], 500);
        }
    }
} 