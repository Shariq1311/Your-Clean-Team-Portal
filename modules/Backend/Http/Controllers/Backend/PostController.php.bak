<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\Backend\Models\Post;
use MojarCMS\CMS\Traits\PostTypeController;

class PostController extends BackendController
{
    use PostTypeController;

    protected string $viewPrefix = 'cms::backend.post';

    protected function getModel(...$params): string
    {
        return Post::class;
    }
}
