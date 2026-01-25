<?php

namespace MojarCMS\Backend\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use MojarCMS\Backend\Models\Taxonomy;
use MojarCMS\CMS\Repositories\BaseRepository;
use MojarCMS\CMS\Repositories\Exceptions\RepositoryException;

interface TaxonomyRepository extends BaseRepository
{
    public function findBySlug(string $slug): null|Taxonomy;

    /**
     * @param  int  $limit
     * @return LengthAwarePaginator
     * @throws RepositoryException
     */
    public function frontendListPaginate(int $limit): LengthAwarePaginator;

    public function frontendDetail(string $slug): ?Taxonomy;
}
