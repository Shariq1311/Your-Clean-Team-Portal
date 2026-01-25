<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MojarCMS\Backend\Http\Resources\PostResourceCollection;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Repositories\PostRepository;
use MojarCMS\CMS\Http\Controllers\FrontendController;

class SearchController extends FrontendController
{
    public function __construct(protected PostRepository $postRepository)
    {
    }

    public function index(Request $request): string
    {
        $keyword = $request->input('q');
        $title = $keyword ? trans(
            'cms::app.result_for_keyword',
            [
                'name' => $keyword,
            ]
        ) : trans('cms::app.search_results');

        // Build the enhanced query with product-specific filters
        $query = $this->buildProductSearchQuery($request);
        
        $posts = $query->paginate(12);
        $posts->appends($request->query());

        $page = PostResourceCollection::make($posts)->response()->getData(true);
        $template = 'search';

        $viewName = apply_filters('search.get_view_name', "theme::templates.products");
        if (!view()->exists(theme_viewname($viewName))) {
            $viewName = 'theme::index';
        }

        return $this->view(
            $viewName,
            compact(
                'page',
                'title',
                'keyword',
                'template'
            )
        );
    }

    public function ajaxSearch(Request $request): JsonResponse
    {
        $limit = $request->input('limit', 5);
        if ($limit > 100) {
            $limit = 100;
        }

        // Use the enhanced query builder for AJAX search as well
        $paginate = $this->buildProductSearchQuery($request)->paginate($limit);
        $results = $paginate->items();
        
        foreach ($results as $key => $item) {
            if (empty($item)) {
                unset($results[$key]);
                continue;
            }

            $item->thumbnail = $item->getThumbnail();
            $item->url = $item->getLink();
            $item->link = $item->url;
            $item->title = $item->getTitle();
            $item->description = $item->getDescription();
            $item->views = $item->getViews();
            $item->created_date = mc_date_format($item->created_at);
            
            // Add product-specific data
            $item->price = $item->getMeta('price');
            $item->rating = $item->getMeta('rating');
        }

        $data['results'] = $results;
        $data['pagination'] = ['more' => (bool) $paginate->nextPageUrl()];

        return response()->json($data);
    }

    /**
     * Build enhanced product search query with all filters
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildProductSearchQuery(Request $request)
    {
        // Start with the base frontend builder
        $query = Post::selectFrontendBuilder();

        // Apply the base search (keyword search)
        $query = $query->whereSearch($request->all());

        // Force product post type
        $query = $query->where('type', 'products');

        // Apply price filter
        $this->applyPriceFilter($query, $request);

        // Apply rating filter
        $this->applyRatingFilter($query, $request);

        // Apply category filter (taxonomy)
        $this->applyCategoryFilter($query, $request);

        // Apply tag filter (taxonomy)
        $this->applyTagFilter($query, $request);

        // Apply sorting
        $this->applySorting($query, $request);

        return $query;
    }

    /**
     * Apply price range filter
     */
    protected function applyPriceFilter($query, Request $request)
    {
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if ($minPrice !== null || $maxPrice !== null) {
            $query->whereHas('metas', function ($q) use ($minPrice, $maxPrice) {
                $q->where('meta_key', 'price');
                
                if ($minPrice !== null) {
                    $q->where('meta_value', '>=', $minPrice);
                }
                
                if ($maxPrice !== null) {
                    $q->where('meta_value', '<=', $maxPrice);
                }
            });
        }
    }

    /**
     * Apply rating filter
     */
    protected function applyRatingFilter($query, Request $request)
    {
        $rating = $request->input('rating');
        
        if ($rating) {
            $query->whereHas('metas', function ($q) use ($rating) {
                $q->where('meta_key', 'rating')
                  ->where('meta_value', '>=', $rating);
            });
        }
    }

    /**
     * Apply category filter (taxonomy)
     */
    protected function applyCategoryFilter($query, Request $request)
    {
        $category = $request->input('category');
        
        if ($category) {
            $query->whereTaxonomy($category);
        }
    }

    /**
     * Apply tag filter (taxonomy)
     */
    protected function applyTagFilter($query, Request $request)
    {
        $tag = $request->input('tag');
        
        if ($tag) {
            $query->whereTaxonomy($tag);
        }
    }

    /**
     * Apply sorting based on the sort parameter
     */
    protected function applySorting($query, Request $request)
    {
        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'latest':
                $query->orderBy('created_at', 'DESC');
                break;
                
            case 'oldest':
                $query->orderBy('created_at', 'ASC');
                break;
                
            case 'a-z':
                $query->orderBy('title', 'ASC');
                break;
                
            case 'z-a':
                $query->orderBy('title', 'DESC');
                break;
                
            case 'popular':
                $query->orderBy('views', 'DESC');
                break;
                
            case 'price_low_high':
                $query->leftJoin('post_metas as pm_price', function ($join) {
                    $join->on('posts.id', '=', 'pm_price.post_id')
                         ->where('pm_price.meta_key', '=', 'price');
                })->orderBy('pm_price.meta_value', 'ASC');
                break;
                
            case 'price_high_low':
                $query->leftJoin('post_metas as pm_price', function ($join) {
                    $join->on('posts.id', '=', 'pm_price.post_id')
                         ->where('pm_price.meta_key', '=', 'price');
                })->orderBy('pm_price.meta_value', 'DESC');
                break;
                
            case 'rating':
                $query->leftJoin('post_metas as pm_rating', function ($join) {
                    $join->on('posts.id', '=', 'pm_rating.post_id')
                         ->where('pm_rating.meta_key', '=', 'rating');
                })->orderBy('pm_rating.meta_value', 'DESC');
                break;
                
            default:
                $query->orderBy('created_at', 'DESC');
        }
    }
}