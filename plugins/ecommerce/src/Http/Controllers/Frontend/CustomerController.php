<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use MojarCMS\CMS\Http\Controllers\Controller;
use MojarCMS\Backend\Models\Post;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Support\DashboardWidgetHelper;

class CustomerController extends Controller
{
    /**
     * Display customer dashboard
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(): View
    {
        $customerDashboard = DashboardWidgetHelper::getCustomerDashboardSummary();
        
        return view('ecomm::frontend.customer.dashboard', [
            'customerDashboard' => $customerDashboard
        ]);
    }
    
    /**
     * Display customer wishlist
     *
     * @return \Illuminate\View\View
     */
    public function wishlist(): View
    {
        $userId = auth()->id();
        $wishlistData = DB::table('ecomm_wishlists')->where('user_id', $userId)->first();
        $wishlistItems = [];
        
        if ($wishlistData && !empty($wishlistData->items)) {
            $items = json_decode($wishlistData->items, true);
            
            if (!empty($items)) {
                $productIds = array_keys($items);
                $products = Post::whereIn('id', $productIds)->get();
                
                foreach ($products as $product) {
                    $wishlistItems[] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'thumbnail' => $product->thumbnail ? upload_url($product->thumbnail) : null,
                        'url' => route('product.show', [$product->slug]),
                        'price' => $product->getMeta('price'),
                        'sale_price' => $product->getMeta('sale_price'),
                    ];
                }
            }
        }
        
        return view('ecomm::frontend.customer.wishlist', [
            'wishlistItems' => $wishlistItems
        ]);
    }
    
    /**
     * Display customer downloadable items
     *
     * @return \Illuminate\View\View
     */
    public function downloads(): View
    {
        $userId = auth()->id();
        $downloads = [];
        
        // Get completed orders
        $orderIds = Order::where('user_id', $userId)
            ->where('status', Order::STATUS_COMPLETED)
            ->pluck('id');
            
        // Get downloadable products from these orders
        $orderItems = DB::table('order_items')
            ->whereIn('order_id', $orderIds)
            ->join('posts', 'order_items.post_id', '=', 'posts.id')
            ->where(DB::raw("JSON_EXTRACT(posts.json_metas, '$.downloadable')"), 1)
            ->select('order_items.*', 'posts.title', 'posts.slug')
            ->get();
            
        foreach ($orderItems as $item) {
            $post = Post::find($item->post_id);
            
            if ($post) {
                $downloads[] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'thumbnail' => $post->thumbnail ? upload_url($post->thumbnail) : null,
                    'download_url' => route('customer.download.file', ['id' => $post->id]),
                    'order_id' => $item->order_id,
                    'order_code' => Order::find($item->order_id)->code ?? 'N/A',
                    'file_name' => $post->getMeta('download_file_name'),
                    'file_size' => $post->getMeta('download_file_size'),
                    'download_count' => $post->getMeta('download_count_' . $userId) ?? 0,
                    'download_limit' => $post->getMeta('download_limit') ?? 0,
                ];
            }
        }
        
        return view('ecomm::frontend.customer.downloads', [
            'downloads' => $downloads
        ]);
    }
}
