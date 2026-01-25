<?php

namespace Mojahid\ContactForm\Repositories;

use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use MojarCMS\CMS\Repositories\Interfaces\SortableInterface;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;
use Mojahid\ContactForm\Models\Contact;
use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;

class ContactRepositoryEloquent extends BaseRepositoryEloquent implements ContactRepository, SortableInterface
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
        return Contact::class;
    }

    public function boot(): void
    {
        $this->pushCriteria(SortCriteria::class);
    }
}
