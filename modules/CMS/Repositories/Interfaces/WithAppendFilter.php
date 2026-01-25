<?php

namespace MojarCMS\CMS\Repositories\Interfaces;

interface WithAppendFilter
{
    public function appendCustomFilter($builder, $input);
}
