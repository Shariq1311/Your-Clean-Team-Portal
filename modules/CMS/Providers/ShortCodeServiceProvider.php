<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Providers;

use MojarCMS\CMS\Facades\ShortCode;
use MojarCMS\CMS\Support\ServiceProvider;

class ShortCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //ShortCode::register('b', BoldShortcode::class);
    }
}
