<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailHook
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public string $hook;
    public array $args = [];

    public function __construct($hook, $args = [])
    {
        $this->hook = $hook;
        $this->args = $args;
    }
}
