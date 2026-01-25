<?php

namespace MojarCMS\CMS\Repositories;

use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Repositories\Contracts\RepositoryCriteriaInterface;
use MojarCMS\CMS\Repositories\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository.
 *
 * @method Builder query()
 * @package namespace MojarCMS\Backend\Repositories;
 */
interface BaseRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @return Builder
     */
    public function getQuery(): Builder;

    public function resetModel();
}
