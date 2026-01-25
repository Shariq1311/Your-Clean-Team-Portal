<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Observers;

use Illuminate\Support\Facades\Cache;
use MojarCMS\Backend\Models\Taxonomy;

class TaxonomyObserver
{
    public function deleting(Taxonomy $taxonomy): void
    {
        $menuItems = $taxonomy->menuItems()->get(['menu_id']);
        $menus = $menuItems->map(
            function ($item) {
                return $item->menu_id;
            }
        )->toArray();

        foreach ($menus as $menu) {
            Cache::store('file')->pull(cache_prefix("menu_items_menu_{$menu}"));
        }

        foreach ($menuItems as $item) {
            $item->delete();
        }
    }

    public function updating(Taxonomy $taxonomy): void
    {
        $menuItems = $taxonomy->menuItems()->get(['menu_id']);
        $menus = $menuItems->map(
            function ($item) {
                return $item->menu_id;
            }
        )->toArray();

        foreach ($menus as $menu) {
            Cache::store('file')->pull(cache_prefix("menu_items_menu_{$menu}"));
        }
    }
}
