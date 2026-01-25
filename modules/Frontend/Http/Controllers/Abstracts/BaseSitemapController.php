<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\Frontend\Http\Controllers\Abstracts;

use Illuminate\Support\Facades\Cache;
use MojarCMS\Backend\Models\Post;
use MojarCMS\Backend\Models\Taxonomy;
use MojarCMS\CMS\Http\Controllers\Controller;

abstract class BaseSitemapController extends Controller
{
    protected int $perPage = 500;
    protected int $limitTaxonomyPage = 10;
    protected int $limitPostPage = 200;

    public function __construct()
    {
        // if (!get_config('mc_enable_sitemap', true)) {
        //     abort(404);
        // }
    }

    protected function totalPost(string $type): int
    {
        return Cache::store('file')->remember(
            cache_prefix("sitemap_post_total_{$type}"),
            3600,
            fn() => Post::wherePublish()
                ->where('type', '=', $type)
                ->count(['id'])
        );
    }

    protected function totalTaxonomy(string $taxonomy): int
    {
        return Cache::store('file')->remember(
            cache_prefix("sitemap_taxonomy_total_{$taxonomy}"),
            3600,
            fn() => Taxonomy::where('taxonomy', '=', $taxonomy)
                ->where('total_post', '>', 0)
                ->count(['id'])
        );
    }
}
