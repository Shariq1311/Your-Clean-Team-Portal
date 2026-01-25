<?php

namespace MojarCMS\Backend\Repositories;

use MojarCMS\Backend\Models\Menu;
use MojarCMS\CMS\Repositories\BaseRepository;

/**
 * Interface CommentRepository.
 *
 * @package namespace MojarCMS\Backend\Repositories;
 */
interface MenuRepository extends BaseRepository
{
    public function getFrontendDetail(int $menu): Menu;

    public function getFrontendDetailByLocation(string $location): ?Menu;
}
