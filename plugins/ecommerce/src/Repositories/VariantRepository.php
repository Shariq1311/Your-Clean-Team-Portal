<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MojarCMS\CMS\Repositories\BaseRepository;

interface VariantRepository extends BaseRepository
{
    public function adminPaginate(int $limit, ?int $page = null, array $columns = ['*']): LengthAwarePaginator;
}
