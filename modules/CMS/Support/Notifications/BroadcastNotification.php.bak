<?php

namespace MojarCMS\CMS\Support\Notifications;

use MojarCMS\CMS\Events\PusherEvent;

class BroadcastNotification extends NotificationAbstract
{
    public function handle()
    {
        event(new PusherEvent($user, $notification));
    }
}
