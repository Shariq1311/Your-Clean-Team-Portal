<?php

namespace Mojahid\Newsletters\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use Mojahid\Newsletters\Actions;
use Mojahid\Newsletters\Repositories;

class NewslettersServiceProvider extends ServiceProvider
{
    public array $bindings = [
        Repositories\NewslettersRepository::class => Repositories\NewslettersRepositoryEloquent::class,
    ];

    public function boot(): void
    {
        $this->registerHookActions([Actions\MenuAction::class, Actions\AjaxAction::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
