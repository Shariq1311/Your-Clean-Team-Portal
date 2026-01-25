<?php

namespace MojarCMS\CMS\Repositories\Interfaces;

interface FilterableInterface
{
    public function withFilters(array $filters): static;

    public function getFieldFilterable(): array;
}
