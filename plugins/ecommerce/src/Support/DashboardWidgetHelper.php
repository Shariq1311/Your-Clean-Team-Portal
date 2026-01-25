<?php

namespace Mojahid\Ecommerce\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use MojarCMS\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;
use Mojahid\Ecommerce\Models\VendorBalance;
use Mojahid\Ecommerce\Models\VendorEarning;
use Mojahid\Ecommerce\Models\VendorWithdrawal;

class DashboardWidgetHelper
{
    /**
     * Check if current user is admin
     * 
     * @return bool
     */
    public static function isAdmin(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        
        $user = Auth::user();
        return $user->is_admin || $user->is_super_admin;
    }
    
    /**
     * Check if current user is vendor
     * 
     * @return bool
     */
    public static function isVendor(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        
        $userId = Auth::id();
        return DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $userId)
            ->where('roles.name', 'vendor')
            ->exists();
    }
    
    /**
     * Check if current user is customer
     * 
     * @return bool
     */
    public static function isCustomer(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        
        $userId = Auth::id();
        return DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $userId)
            ->where('roles.name', 'customer')
            ->exists();
    }
    
    /**
     * Get current user ID
     * 
     * @return int|null
     */
    public static function getCurrentUserId(): ?int
    {
        if (!Auth::check()) {
            return null;
        }
        
        return Auth::user()->id;
    }
    
    /**
     * Get vendor dashboard summary data
     * 
     * @return array
     */
    public static function getVendorDashboardSummary(): array
    {
        $vendorId = self::getCurrentUserId();
        
        if (!$vendorId) {
            return [];
        }
        
        // Get vendor balance
        $balance = VendorBalance::findOrCreateForVendor($vendorId);
        
        // Get recent orders
        $recentOrders = self::getVendorRecentOrders($vendorId, 5);
        
        // Get earnings data for chart
        $earningsData = self::getVendorEarningsData($vendorId);
        
        // Get pending withdrawals
        $pendingWithdrawals = VendorWithdrawal::where('vendor_id', $vendorId)
            ->where('status', VendorWithdrawal::STATUS_PENDING)
            ->count();
            
        // Get total products
        $totalProducts = DB::table('posts')
            ->where('type', 'products')
            ->where(function($query) use ($vendorId) {
                $query->where('posts.created_by', $vendorId);
             })
            ->count();
            
        return [
            'balance' => [
                'available' => $balance->balance,
                'pending' => $balance->pending_balance,
                'total_earnings' => $balance->total_earnings,
                'total_withdrawals' => $balance->total_withdrawals,
                'currency' => $balance->currency_code
            ],
            'orders' => [
                'total' => self::getVendorOrdersCount($vendorId),
                'completed' => self::getVendorOrdersCount($vendorId, Order::STATUS_COMPLETED),
                'pending' => self::getVendorOrdersCount($vendorId, Order::STATUS_PENDING),
                'processing' => self::getVendorOrdersCount($vendorId, Order::STATUS_PROCESSING)
            ],
            'recent_orders' => $recentOrders,
            'earnings_data' => $earningsData,
            'pending_withdrawals' => $pendingWithdrawals,
            'total_products' => $totalProducts
        ];
    }
    
    /**
     * Get vendor earnings data for chart
     * 
     * @param int $vendorId
     * @param int $days
     * @return array
     */
    public static function getVendorEarningsData(int $vendorId, int $days = 30): array
    {
        $data = VendorEarning::select(
            DB::raw("DATE(created_at) as date"),
            DB::raw("SUM(vendor_amount) as amount")
        )
            ->where('vendor_id', $vendorId)
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->where('status', '!=', VendorEarning::STATUS_CANCELLED)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $dates = [];
        $amounts = [];
        
        // Fill in missing dates with zero values
        $period = \Carbon\CarbonPeriod::create(Carbon::now()->subDays($days), Carbon::now());
        $existingDates = $data->pluck('date')->toArray();
        
        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dates[] = $date->format('M d');
            
            if (in_array($formattedDate, $existingDates)) {
                $amounts[] = (float) $data->firstWhere('date', $formattedDate)->amount;
            } else {
                $amounts[] = 0;
            }
        }
        
        return [
            'dates' => $dates,
            'amounts' => $amounts
        ];
    }
    
    /**
     * Get vendor orders count
     * 
     * @param int $vendorId
     * @param string|null $status
     * @return int
     */
    public static function getVendorOrdersCount(int $vendorId, ?string $status = null): int
    {
        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('posts', 'order_items.post_id', '=', 'posts.id')
            ->where(function($query) use ($vendorId) {
                $query->where('posts.created_by', $vendorId);
            })
            ->distinct('orders.id');
            
        if ($status) {
            $query->where('orders.status', $status);
        }
        
        return $query->count('orders.id');
    }
    
    /**
     * Get vendor recent order items
     * 
     * @param int $vendorId
     * @param int $limit
     * @return array
     */
    public static function getVendorRecentOrders(int $vendorId, int $limit = 5): array
    {
        $results = [];
        
        $orderItems = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('posts', 'order_items.post_id', '=', 'posts.id')
            ->where(function($query) use ($vendorId) {
                $query->where('posts.created_by', $vendorId);
            })
            ->select(
                'order_items.order_id',
                'order_items.post_id', 
                'order_items.quantity',
                'order_items.price',
                'order_items.line_price',
                'order_items.created_at',
                'orders.code', 
                'orders.name', 
                'orders.status',
                'posts.title as product_title'
            )
            ->orderBy('order_items.created_at', 'desc')
            ->limit($limit)
            ->get();
            
        foreach ($orderItems as $item) {
            $results[] = [
                'order_id' => $item->order_id,
                'order_code' => $item->code,
                'customer_name' => $item->name,
                'product_title' => $item->product_title,
                'quantity' => $item->quantity,
                'unit_price' => $item->price,
                'line_price' => $item->line_price,
                'status' => $item->status,
                'created_at' => date('M d, Y', strtotime($item->created_at)),
                'view_url' => route('admin.order_items.show', [$item->order_id]),
            ];
        }
        
        return $results;
    }
    
    /**
     * Get customer dashboard summary data
     * 
     * @return array
     */
    public static function getCustomerDashboardSummary(): array
    {
        $userId = self::getCurrentUserId();
        
        if (!$userId) {
            return [];
        }
        
        // Get recent orders
        $recentOrders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'code' => $order->code,
                    'total' => $order->total,
                    'status' => $order->status,
                    'status_text' => match ($order->status) {
                        Order::STATUS_COMPLETED => trans('ecomm::content.completed'),
                        Order::STATUS_PROCESSING => trans('ecomm::content.processing'),
                        Order::STATUS_CANCELLED => trans('ecomm::content.cancelled'),
                        default => trans('ecomm::content.pending'),
                    },
                    'payment_status' => $order->payment_status,
                    'payment_status_text' => $order->payment_status_text,
                    'created_at' => date('M d, Y', strtotime($order->created_at)),
                    'view_url' => route('admin.ecommerce.my-orders.show', [$order->id]),  
                ];
            })
            ->toArray();
        
        // Get wishlist count
        $wishlistCount = DB::table('ecomm_wishlists')
        ->where('user_id', $userId)
        ->value('items');
        
        $decodedWishlist = $wishlistCount ? json_decode($wishlistCount, true) : null;
        $wishlistCount = (is_array($decodedWishlist)) ? count($decodedWishlist) : 0;
                
        // Get cart items count
        $cartItems = DB::table('ecomm_carts')
                ->where('user_id', $userId)
                ->value('items');
                
        $decodedCartItems = $cartItems ? json_decode($cartItems, true) : null;
        $cartItemsCount = (is_array($decodedCartItems)) ? count($decodedCartItems) : 0;
        
        // Get downloadable items
        $downloadableItems = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('posts', 'order_items.post_id', '=', 'posts.id')
            ->join('post_metas', function($join) {
                $join->on('posts.id', '=', 'post_metas.post_id')
                     ->where('post_metas.meta_key', 'downloadable')
                     ->where('post_metas.meta_value', '1');
            })
            ->where('orders.user_id', $userId)
            ->where('orders.status', Order::STATUS_COMPLETED)
            ->count();
        
        return [
            'orders' => [
                'total' => Order::where('user_id', $userId)->count(),
                'completed' => Order::where('user_id', $userId)->where('status', Order::STATUS_COMPLETED)->count(),
                'pending' => Order::where('user_id', $userId)->where('status', Order::STATUS_PENDING)->count(),
                'processing' => Order::where('user_id', $userId)->where('status', Order::STATUS_PROCESSING)->count(),
            ],
            'recent_orders' => $recentOrders,
            'wishlist_count' => $wishlistCount,
            'cart_items_count' => $cartItemsCount,
            'downloadable_items' => $downloadableItems,
        ];
    }
    
    /**
     * Format money amount
     * 
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public static function formatMoney(float $amount, string $currency = 'USD'): string
    {
        $symbol = match($currency) {
            'EUR' => '€',
            'GBP' => '£',
            default => '$'
        };
        
        return $symbol . number_format($amount, 2);
    }
}
