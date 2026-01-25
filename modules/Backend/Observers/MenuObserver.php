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

use MojarCMS\Backend\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    public function saved(Menu $menu): void
    {
        Cache::store('file')->pull(cache_prefix("menu_items_menu_{$menu->id}_"));
    }

    public function deleted(Menu $menu): void
    {
        Cache::store('file')->pull(cache_prefix("menu_items_menu_{$menu->id}"));
    }
}
