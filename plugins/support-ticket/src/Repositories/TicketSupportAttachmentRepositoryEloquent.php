<?php

namespace Mojahid\SupportTicket\Repositories;

use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;
use MojarCMS\CMS\Repositories\Criterias\SortCriteria;
use MojarCMS\CMS\Traits\Criterias\UseFilterCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSortableCriteria;
use Mojahid\SupportTicket\Models\TicketSupportAttachment;

/**
 * Class TicketSupportCommentRepository.
 *
 * @package namespace Mojahid\SupportTicket\Http\Repositorys;
 */
class TicketSupportAttachmentRepositoryEloquent extends BaseRepositoryEloquent implements TicketSupportAttachmentRepository
{
    use UseSortableCriteria, UseFilterCriteria;

    protected array $filterableFields = ['ticket_support_id'];
    protected array $sortableFields = ['id'];
    protected array $sortableDefaults = ['id' => 'ASC'];

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
        return TicketSupportAttachment::class;
    }
}
