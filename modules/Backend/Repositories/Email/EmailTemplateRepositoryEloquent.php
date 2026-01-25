<?php

namespace MojarCMS\Backend\Repositories\Email;

use MojarCMS\Backend\Models\EmailTemplate;
use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;
use MojarCMS\CMS\Traits\Criterias\UseFilterCriteria;
use MojarCMS\CMS\Traits\Criterias\UseSearchCriteria;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace MojarCMS\Backend\Repositories;
 */
class EmailTemplateRepositoryEloquent extends BaseRepositoryEloquent implements EmailTemplateRepository
{
    use UseSearchCriteria, UseFilterCriteria;

    protected array $searchableFields = ['code', 'subject'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return EmailTemplate::class;
    }
}
