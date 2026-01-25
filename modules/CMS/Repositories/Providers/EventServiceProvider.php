<?php

namespace MojarCMS\CMS\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @package Prettus\Repository\Providers
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'MojarCMS\CMS\Repositories\Events\RepositoryEntityCreated' => [
            'MojarCMS\CMS\Repositories\Listeners\CleanCacheRepository',
        ],
        'MojarCMS\CMS\Repositories\Events\RepositoryEntityUpdated' => [
            'MojarCMS\CMS\Repositories\Listeners\CleanCacheRepository',
        ],
        'MojarCMS\CMS\Repositories\Events\RepositoryEntityDeleted' => [
            'MojarCMS\CMS\Repositories\Listeners\CleanCacheRepository',
        ],
    ];

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $events = app('events');

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}
