<?php

namespace MojarCMS\CMS\Providers;

use MojarCMS\CMS\Console\Commands\SendNotifyCommand;
use MojarCMS\CMS\Support\Notification;
use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Support\Notifications\DatabaseNotification;
use MojarCMS\CMS\Support\Notifications\EmailNotification;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Notification::register('database', DatabaseNotification::class);
        Notification::register('mail', EmailNotification::class);
    }

    public function register()
    {
        $this->commands(
            [
                SendNotifyCommand::class,
            ]
        );
    }
}
