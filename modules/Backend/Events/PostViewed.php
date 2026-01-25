<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Events;

use MojarCMS\Backend\Models\Post;

class PostViewed
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
