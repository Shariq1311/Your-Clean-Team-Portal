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

use MojarCMS\API\Http\Resources\MenuResource;
use MojarCMS\Backend\Repositories\MenuRepository;
use MojarCMS\CMS\Http\Controllers\ApiController;

class MenuController extends ApiController
{
    public function __construct(protected MenuRepository $menuRepository) {}

    public function show(string $location): MenuResource
    {
        $menu = $this->menuRepository->getFrontendDetailByLocation($location);

        abort_if($menu === null, 404);

        return MenuResource::make($menu);
    }
}
