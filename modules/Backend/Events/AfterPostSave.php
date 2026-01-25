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

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MojarCMS\Backend\Models\Post;

class AfterPostSave
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Post $post;

    public array $data;

    public function __construct(Post $post, array $data)
    {
        $this->post = $post;
        $this->data = $data;
    }
}
