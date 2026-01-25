<?php

namespace Mojahid\SupportTicket\Repositories;

use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use MojarCMS\CMS\Traits\Criterias\UseFilterCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSearchCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;
use Mojahid\SupportTicket\Models\TicketSupport;

class TicketSupportRepositoryEloquent extends BaseRepositoryEloquent implements TicketSupportRepository
{
    use UseSearchCriteria, UseFilterCriteria, UseSortableCriteria;

    protected array $searchableFields = ['title'];
    protected array $filterableFields = ['support_type_id', 'created_by', 'status'];
    protected array $sortableFields = ['id', 'title', 'status'];
    protected array $sortableDefaults = ['created_at' => 'DESC'];

    public function boot(): void
    {
        $this->pushCriteria(SortCriteria::make([]));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return TicketSupport::class;
    }
}
