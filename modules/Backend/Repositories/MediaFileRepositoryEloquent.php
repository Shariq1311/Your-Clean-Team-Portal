<?php

namespace MojarCMS\Backend\Repositories;

use MojarCMS\Backend\Models\MediaFile;
use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;
use MojarCMS\CMS\Traits\Criterias\UseFilterCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSearchCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;

/**
 * Class MediaFileRepositoryEloquent.
 *
 * @package namespace MojarCMS\Backend\Repositories;
 */
class MediaFileRepositoryEloquent extends BaseRepositoryEloquent implements MediaFileRepository
{
    use UseSortableCriteria, UseFilterCriteria, UseSearchCriteria;

    protected array $searchableFields = ['name'];
    protected array $filterableFields = ['folder_id', 'type'];
    protected array $sortableFields = ['id', 'size'];
    protected array $sortableDefaults = ['id' => 'DESC'];

    public function model(): string
    {
        return MediaFile::class;
    }
}
