<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Http\Controllers;

use MojarCMS\CMS\Http\Controllers\ApiController;

class SidebarController extends ApiController
{
    public function show(string $sidebar): \Illuminate\Http\JsonResponse
    {
        $config = get_theme_config("sidebar_{$sidebar}", []);

        return $this->restSuccess(array_values($config));
    }
}
