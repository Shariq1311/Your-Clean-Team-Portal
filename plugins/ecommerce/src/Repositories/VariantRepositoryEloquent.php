<?php

namespace Mojahid\Ecommerce\Repositories;

use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;
use MojarCMS\CMS\Traits\Criterias\UseFilterCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSearchCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;
use MojarCMS\CMS\Traits\ResourceRepositoryEloquent;
use Mojahid\Ecommerce\Models\ProductVariant;

class VariantRepositoryEloquent extends BaseRepositoryEloquent implements VariantRepository
{
    use ResourceRepositoryEloquent, UseSearchCriteria, UseFilterCriteria, UseSortableCriteria;

    protected array $searchableFields = ['title'];
    protected array $filterableFields = ['post_id'];

    public function model(): string
    {
        return ProductVariant::class;
    }
}
