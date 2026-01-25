<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\CMS\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MojarCMS\CMS\Repositories\Exceptions\RepositoryException;

trait ResourceRepositoryEloquent
{
    /**
     * @throws RepositoryException
     */
    public function adminPaginate(int $limit, ?int $page = null, array $columns = ['*']): LengthAwarePaginator
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->paginate($limit, $columns, 'page', $page);
        $results->appends(app('request')->query());

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }
}
