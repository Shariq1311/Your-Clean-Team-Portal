<?php

namespace MojarCMS\CMS\Traits\Criterias;

use MojarCMS\CMS\Repositories\Criterias\SearchCriteria;

/**
 * @property array $searchableFields
 */
trait UseSearchCriteria
{
    public function withSearchs(?string $keyword): static
    {
        $this->pushCriteria(new SearchCriteria(['keyword' => $keyword]));

        return $this;
    }

    public function getFieldSearchable(): array
    {
        return $this->searchableFields;
    }
}
