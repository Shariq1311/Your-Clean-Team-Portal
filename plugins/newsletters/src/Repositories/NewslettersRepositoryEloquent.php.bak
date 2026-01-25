<?php

namespace Mojahid\Newsletters\Repositories;

use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use MojarCMS\CMS\Repositories\Interfaces\SortableInterface;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;
use Mojahid\Newsletters\Models\NewslettersSubscriber;
use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;

class NewslettersRepositoryEloquent extends BaseRepositoryEloquent implements NewslettersRepository, SortableInterface
{
    use UseSortableCriteria;

    protected array $sortableDefaults = [
        'created_at' => 'desc',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return NewslettersSubscriber::class;
    }

    public function boot(): void
    {
        $this->pushCriteria(SortCriteria::class);
    }
}
