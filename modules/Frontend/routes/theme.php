<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\CMS\Support\Route\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

if (config('Mojar.frontend.enable')) {
    require __DIR__ . '/components/profile.route.php';

    require __DIR__ . '/components/sitemap.route.php';

    require __DIR__ . '/components/feed.route.php';

    require __DIR__ . '/components/page.route.php';
} else {
    Route::get('/', fn() => redirect(config('mojar.admin_prefix', 'app')));
}
