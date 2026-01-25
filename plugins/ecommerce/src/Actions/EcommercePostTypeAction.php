<?php

namespace Mojahid\Ecommerce\Actions;

use Illuminate\Support\Arr;
use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\DownloadLink;
use Mojahid\Ecommerce\Models\Product;
use Mojahid\Ecommerce\Models\ProductVariant;
use MojarCMS\Backend\Models\Post;
use Mojahid\Ecommerce\Http\Resources\ProductVariantResource;
use MojarCMS\Backend\Models\Taxonomy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EcommercePostTypeAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );

        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        $this->addAction(
            'post_type.products.form.left',
            [$this, 'addFormProduct']
        );

        $this->addFilter(
            'post_type.products.parseDataForSave',
            [$this, 'parseDataForSave']
        );
        
        $this->addAction(
            "post_type.products.after_save",
            [$this, 'saveDataProduct'],
            20,
            2
        );

        $this->addFilter('post.withFrontendDetailBuilder', [$this, 'addWithVariantsProductDetail']);

        $this->addFilter('jw.resource.post.products', [$this, 'addVariantsProductDetail'], 20, 2);
        
        // Add filter for product queries
        $this->addFilter(
            'post.createFrontendBuilder',
            [$this, 'filterProductsByVendor'],
            30,
            1
        );
        
        $this->addFilter(
            'post.selectFrontendBuilder',
            [$this, 'filterProductsByVendor'],
            30,
            1
        );
        


        // Add shop page filter
        $this->addFilter(
            'theme.get_view_page',
            [$this, 'addShopPage'],
            20,
            2
        );

        $this->addFilter(
            'theme.get_params_page',
            [$this, 'addShopParams'],
            20,
            2
        );
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            '_shop_page',
            '_shop_params',
        ]);
    }
    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $productInvisibleMetas = [
            'price',
            'sku_code',
            'barcode',
            'quantity',
            'inventory_management',
            'disable_out_of_stock',
            'badge',
            'additional_information',
            'short_description',
            'images',   
            'vendor_id',
        ];

        HookAction::registerPostType(
            'products',
            [
                'label' => trans('ecomm::content.products'),
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag',
                    'comment'
                ],
                'metas' => collect($productInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )
                    ->toArray(),
            ]
        );
    }

    public function addFormProduct($model): void
    {
        $variant = ProductVariant::findByProduct($model->id);
        if ($variant === null) {
            $variant = new ProductVariant();
        }

        echo e(
            view(
                'ecomm::backend.product.form',
                compact(
                    'variant',
                    'model'
                )
            )
        );
    }

    public function parseDataForSave($data)
    {
        $metas = (array) $data['meta'];
        if ($metas['price']) {
            $metas['price'] = parse_price_format($metas['price']);
        }

        if ($metas['compare_price']) {
            $metas['compare_price'] = parse_price_format($metas['compare_price']);
        }

        $metas['inventory_management'] = $metas['inventory_management'] ?? 0;
        $metas['disable_out_of_stock'] = $metas['disable_out_of_stock'] ?? 0;
        $metas['downloadable'] = $metas['downloadable'] ?? 0;
        $metas['badge'] = $metas['badge'] ?? '';
        $metas['additional_information'] = $metas['additional_information'] ?? '';
        $metas['short_description'] = $metas['short_description'] ?? '';
        $metas['images'] = $metas['images'] ?? [];
        
        // Store vendor ID if user is vendor
        if (Auth::check()) {
            $user = Auth::user();
            $userIsVendor = false;
            if ($user) {
                try {
                    if (method_exists($user, 'roles')) {
                        $roleNames = $user->roles ? $user->roles->pluck('name')->toArray() : [];
                        $userIsVendor = in_array('vendor', $roleNames, true);
                    }
                    // Fallback to user_type meta via attribute access if available
                    if (!$userIsVendor && isset($user->json_metas) && is_array($user->json_metas)) {
                        $userIsVendor = (($user->json_metas['user_type'] ?? null) === 'vendor');
                    }
                } catch (\Throwable $e) {
                    $userIsVendor = false;
                }
            }
            if ($userIsVendor) {
                $metas['vendor_id'] = (int) $user->id;
            }
        }

        if ($metas['quantity']) {
            $metas['quantity'] = (int) $metas['quantity'];
            $metas['quantity'] = max($metas['quantity'], 0);
        }

        $data['meta'] = $metas;
        return $data;
    }

    public function saveDataProduct($model, $data): void
    {
        if (Arr::has($data, 'meta')) {
            $variant = ProductVariant::findByProduct($model->id);
            $variantData = $data['meta'];
            $variantData['thumbnail'] = $data['thumbnail'];
            $variantData['description'] = seo_string(strip_tags($data['content']), 320);
            
            if ($variant) {
                $variant->update($variantData);
            } else {
                $variantData['title'] = 'Default';
                $variantData['names'] = ['Default'];
                $variantData['post_id'] = $model->id;

                $variant = ProductVariant::updateOrCreate(
                    ['id' => $variant->id ?? 0],
                    $variantData
                );
            }

            if ($downloadLinks = Arr::get($data, 'download_links')) {
                foreach ($downloadLinks as $link) {
                    $link['product_id'] = $model->id;
                    $ids[] = DownloadLink::updateOrCreate(
                        [
                            'id' => $link['id'],
                            'product_id' => $model->id,
                            'variant_id' => $variant->id,
                        ],
                        $link
                    )->id;
                }

                DownloadLink::whereNotIn('id', $ids)
                    ->where(['product_id' => $model->id, 'variant_id' => $variant->id])
                    ->delete();
            }
        }
    }

    /**
     * Filter products by vendor if user is vendor
     *
     * @param mixed $builder
     * @return mixed
     */
    public function filterProductsByVendorOld($builder)
    {
        // Guard: ensure valid builder
        if (!$builder || $builder->getModel()->getTable() !== 'posts') {
            return $builder;
        }
        
        // Keyword search
        $keyword = request('keyword');
        if (!empty($keyword)) {
            $builder->where('title', 'LIKE', '%' . $keyword . '%');
        }
        
        // Category filter
        $categoryId = request('category');
        if (!empty($categoryId)) {
            $builder->whereHas('taxonomies', function ($q) use ($categoryId) {
                $q->where('taxonomy', 'categories')
                  ->where($q->getModel()->getTable() . '.id', (int) $categoryId);
            });
        }
        
        // Tag filter
        $tagId = request('tag');
        if (!empty($tagId)) {
            $builder->whereHas('taxonomies', function ($q) use ($tagId) {
                $q->where('taxonomy', 'tags')
                  ->where($q->getModel()->getTable() . '.id', (int) $tagId);
            });
        }
        
        // Price range filter from JSON metas (no dependency on post_metas table)
        $minPrice = request('min_price');
        $maxPrice = request('max_price');
        $minVal = is_numeric($minPrice) ? (float) $minPrice : null;
        $maxVal = is_numeric($maxPrice) ? (float) $maxPrice : null;
        if ($minVal !== null && $maxVal !== null && $minVal > $maxVal) {
            // Swap if accidentally reversed
            [$minVal, $maxVal] = [$maxVal, $minVal];
        }
        if ($minVal !== null || $maxVal !== null) {
            $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
            if ($minVal !== null) {
                $builder->whereRaw($priceExpr . ' >= ?', [$minVal]);
            }
            if ($maxVal !== null) {
                $builder->whereRaw($priceExpr . ' <= ?', [$maxVal]);
            }
        }
        
        // Rating filter (column/meta/comments avg)
        $rating = request('rating');
        if ($rating !== null && $rating !== '') {
            $ratingVal = (float) $rating;
            
            // Get product IDs that match the rating criteria
            $productIds = collect();
            
            try {
                $commentRatedProducts = \MojarCMS\Backend\Models\Comment::select('object_id')
                                              ->where('object_type', 'products')
                                              ->where('status', 'approved')
                                              ->whereNotNull('json_metas->rating')
                                              ->groupBy('object_id')
                                              ->havingRaw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, "$.rating")) AS DECIMAL(10,2))) >= ?', [$ratingVal])
                                              ->pluck('object_id');
                $productIds = $productIds->merge($commentRatedProducts);
            } catch (\Exception $e) {
                // If comment rating fails, continue with what we have
            }
            
            // Apply the filter
            if ($productIds->isNotEmpty()) {
                $builder->whereIn('id', $productIds->unique()->values());
            } else {
                // No products match the rating criteria - return empty result
                $builder->where('id', '<', 0);
            }
        }

        
        // Sorting
        $sort = request('sort');
        switch ($sort) {
            case 'oldest':
                $builder->orderBy('created_at', 'asc');
                break;
            case 'a-z':
                $builder->orderBy('title', 'asc');
                break;
            case 'z-a':
                $builder->orderBy('title', 'desc');
                break;
            case 'popular':
                $builder->orderBy('views', 'desc');
                break;
            case 'price_low':
                $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
                $builder->orderByRaw($priceExpr . ' ASC');
                break;
            case 'price_high':
                $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
                $builder->orderByRaw($priceExpr . ' DESC');
                break;
            default:
                // latest
                $builder->orderBy('created_at', 'desc');
                break;
        }
        
        // Vendor scoping
        if (Auth::check()) {
            $user = Auth::user();
            $vendorScope = false;
            try {
                if ($user && method_exists($user, 'roles')) {
                    $roleNames = $user->roles ? $user->roles->pluck('name')->toArray() : [];
                    $vendorScope = in_array('vendor', $roleNames, true);
                }
            } catch (\Throwable $e) {
                $vendorScope = false;
            }
            if ($vendorScope) {
                $builder->where('created_by', '=', (int) $user->id);
            }
        }
        
        return $builder;
    }

    public function filterProductsByVendor($builder)
    {
        // Guard: ensure valid builder
        if (!$builder || $builder->getModel()->getTable() !== 'posts') {
            return $builder;
        }
        
        // Keyword search
        $keyword = request('keyword');
        if (!empty($keyword)) {
            // Sanitize input to prevent SQL injection in LIKE queries
            $keyword = str_replace(['%', '_'], ['\%', '\_'], $keyword);
            $builder->where('title', 'LIKE', '%' . $keyword . '%');
        }
        
        // Category filter
        $categoryId = request('category');
        if (!empty($categoryId) && is_numeric($categoryId)) {
            $builder->whereHas('taxonomies', function ($q) use ($categoryId) {
                $q->where('taxonomy', 'categories')
                ->where($q->getModel()->getTable() . '.id', (int) $categoryId);
            });
        }
        
        // Tag filter
        $tagId = request('tag');
        if (!empty($tagId) && is_numeric($tagId)) {
            $builder->whereHas('taxonomies', function ($q) use ($tagId) {
                $q->where('taxonomy', 'tags')
                ->where($q->getModel()->getTable() . '.id', (int) $tagId);
            });
        }
        
        // Price range filter from JSON metas
        $this->applyPriceFilter($builder);
        
        // Rating filter
        $this->applyRatingFilter($builder);
        
        // Sorting
        $this->applySorting($builder);
        
        // Vendor scoping
        $this->applyVendorScoping($builder);
        
        return $builder;
    }

    /**
     * Apply price range filter
     */
    private function applyPriceFilter($builder)
    {
        $minPrice = request('min_price');
        $maxPrice = request('max_price');
        
        $minVal = is_numeric($minPrice) ? (float) $minPrice : null;
        $maxVal = is_numeric($maxPrice) ? (float) $maxPrice : null;
        
        // Validation: ensure min is not greater than max
        if ($minVal !== null && $maxVal !== null && $minVal > $maxVal) {
            [$minVal, $maxVal] = [$maxVal, $minVal];
        }
        
        if ($minVal !== null || $maxVal !== null) {
            $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
            
            if ($minVal !== null) {
                $builder->whereRaw($priceExpr . ' >= ?', [$minVal]);
            }
            if ($maxVal !== null) {
                $builder->whereRaw($priceExpr . ' <= ?', [$maxVal]);
            }
        }
    }

    /**
     * Apply rating filter
     */
    private function applyRatingFilter($builder)
    {
        $rating = request('rating');
        if ($rating === null || $rating === '') {
            return;
        }
        
        $ratingVal = (float) $rating;
        
        // Validate rating range (assuming 1-5 stars)
        if ($ratingVal < 1 || $ratingVal > 5) {
            return;
        }
        
        try {
            // Get products with comment-based average rating
            $commentRatedProducts = \MojarCMS\Backend\Models\Comment::select('object_id')
                                        ->where('object_type', 'products')
                                        ->where('status', 'approved')
                                        ->whereNotNull('json_metas->rating')
                                        ->groupBy('object_id')
                                        ->havingRaw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, "$.rating")) AS DECIMAL(10,2))) >= ?', [$ratingVal])
                                        ->pluck('object_id');
            
            if ($commentRatedProducts->isNotEmpty()) {
                $builder->whereIn('id', $commentRatedProducts);
            } else {
                // No products match the rating criteria
                $builder->where('id', '<', 0);
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::warning('Rating filter failed', [
                'rating' => $ratingVal,
                'error' => $e->getMessage()
            ]);
            
            // Don't apply any rating filter if there's an error
            return;
        }
    }

    /**
     * Apply sorting
     */
    private function applySorting($builder)
    {
        $sort = request('sort', 'latest'); // Default to 'latest'
        
        switch ($sort) {
            case 'oldest':
                $builder->orderBy('created_at', 'asc');
                break;
            case 'a-z':
                $builder->orderBy('title', 'asc');
                break;
            case 'z-a':
                $builder->orderBy('title', 'desc');
                break;
            case 'popular':
                $builder->orderBy('views', 'desc');
                break;
            case 'price_low':
                $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
                $builder->orderByRaw($priceExpr . ' ASC');
                break;
            case 'price_high':
                $priceExpr = "CAST(JSON_UNQUOTE(JSON_EXTRACT(json_metas, '$.price')) AS DECIMAL(15,2))";
                $builder->orderByRaw($priceExpr . ' DESC');
                break;
            default:
                // latest
                $builder->orderBy('created_at', 'desc');
                break;
        }
    }

    /**
     * Apply vendor scoping
     */
    private function applyVendorScoping($builder)
    {
        if (!Auth::check()) {
            return;
        }
        
        $user = Auth::user();
        
        try {
            if ($user && method_exists($user, 'roles')) {
                $roleNames = $user->roles ? $user->roles->pluck('name')->toArray() : [];
                
                if (in_array('vendor', $roleNames, true)) {
                    $builder->where('created_by', '=', $user->id);
                }
            }
        } catch (\Throwable $e) {
            // Log error but continue without vendor scoping
            \Log::warning('Vendor scoping failed', [
                'user_id' => $user->id ?? null,
                'error' => $e->getMessage()
            ]);
        }
    }
    
    public function addWithVariantsProductDetail(array $with): array
    {
        $with['variants'] = fn ($q) => $q->cacheFor(
            config('Mojarcms.performance.query_cache.lifetime')
        );

        return $with;
    }

    public function addVariantsProductDetail(array $data, Post $resource): array
    {
        $data['variants'] = ProductVariantResource::collection($resource->variants)
            ->response()
            ->getData(true)['data'];
        return $data;
    }

    
    // Add new method for shop page view
    public function addShopPage($view, $page): string
    {
        $shopPage = get_config('_shop_page');

        if ($shopPage == $page->id) {
            return 'ecomm::frontend.shop.index';
        }

        return $view;
    }

    // Add new method for shop page parameters
    public function addShopParams($params, $page)
    {
        $shopPage = get_config('_shop_page');

        if ($shopPage == $page->id) {
            return array_merge($params, [
                'products' => $this->getShopProducts(),
                'categories' => $this->getProductCategories(),
                'filters' => $this->getProductFilters(),
                'sort_options' => $this->getSortOptions()
            ]);
        }

        return $params;
    }

    protected function getShopProducts()
    {
        $query = Post::wherePostType('products')
            ->wherePublish()
            ->with(['taxonomies', 'metas']);

        // Apply filters from request
        if ($category = request('category')) {
            $query->whereTaxonomy('categories', $category);
        }

        if ($search = request('search')) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // Apply sorting
        $sort = request('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderByMeta('price', 'asc');
                break;
            case 'price_high':
                $query->orderByMeta('price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(12);
    }

    protected function getProductCategories()
    {
        return Taxonomy::where('taxonomy', 'categories')
            ->where('post_type', 'products')
            ->whereHas('posts', function($q) {
                $q->wherePublish();
            })
            ->get();
    }

    protected function getProductFilters()
    {
        return [
            'price_range' => [
                'min' => Post::wherePostType('products')->min('price') ?? 0,
                'max' => Post::wherePostType('products')->max('price') ?? 1000
            ],
            // Add more filters as needed
        ];
    }

    protected function getSortOptions()
    {
        return [
            'latest' => trans('ecomm::content.latest'),
            'price_low' => trans('ecomm::content.price_low_to_high'),
            'price_high' => trans('ecomm::content.price_high_to_low'),
            'popularity' => trans('ecomm::content.most_popular')
        ];
    }

}