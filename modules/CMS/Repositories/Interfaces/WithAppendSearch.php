<?php

namespace MojarCMS\CMS\Repositories\Interfaces;

interface WithAppendSearch
{
    public function appendCustomSearch($builder, $keyword, $input);
}
