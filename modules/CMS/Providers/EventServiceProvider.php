<?php

namespace MojarCMS\CMS\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use MojarCMS\Backend\Events\AfterPostSave;
use MojarCMS\Backend\Events\DumpAutoloadPlugin;
use MojarCMS\Backend\Listeners\ResizeThumbnailPostListener;
use MojarCMS\Backend\Listeners\SaveSeoMetaPost;
use MojarCMS\CMS\Events\EmailHook;
use MojarCMS\Backend\Events\PostViewed;
use MojarCMS\Backend\Listeners\CountViewPost;
use MojarCMS\CMS\Listeners\SendEmailHook;
use MojarCMS\Backend\Listeners\SendMailRegisterSuccessful;
use MojarCMS\Backend\Events\RegisterSuccessful;
use MojarCMS\Backend\Listeners\DumpAutoloadPluginListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmailHook::class => [
            SendEmailHook::class,
        ],
        RegisterSuccessful::class => [
            SendMailRegisterSuccessful::class,
        ],
        PostViewed::class => [
            CountViewPost::class
        ],
        DumpAutoloadPlugin::class => [
            DumpAutoloadPluginListener::class,
        ],
        AfterPostSave::class => [
            SaveSeoMetaPost::class,
            ResizeThumbnailPostListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
