<?php

declare(strict_types=1);

namespace Mojahid\PosSystem\Providers;

use Illuminate\Support\ServiceProvider;
use Mojahid\PosSystem\Actions\ConfigAction;
use Mojahid\PosSystem\Actions\MenuAction;
use Mojahid\PosSystem\Actions\PosSystemAction;
use Mojahid\PosSystem\Contracts\PosCartContract;
use Mojahid\PosSystem\Contracts\PosCartManagerContract;
use Mojahid\PosSystem\Supports\Manager\PosCartManager;
use Mojahid\PosSystem\Supports\PosCart;
use MojarCMS\CMS\Facades\ActionRegister;

class PosSystemServiceProvider extends ServiceProvider
{
    protected array $actions = [
        ConfigAction::class,
        MenuAction::class,
        PosSystemAction::class,
    ];

    public function boot(): void
    {
        $this->bootActions();
        $this->bootViews();
    }

    public function register(): void
    {
        $this->registerBindings();
        $this->registerConfig();
    }

    protected function bootActions(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        foreach ($this->actions as $action) {
            ActionRegister::register($action);
        }
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pos');
    }

    protected function registerBindings(): void
    {
        $this->app->bind(PosCartContract::class, PosCart::class);   
        $this->app->bind(PosCartManagerContract::class, PosCartManager::class);
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/pos-system.php', 'pos-system');
    }

    public function provides(): array
    {
        return [
            PosCartContract::class,
            PosCartManagerContract::class,
        ];
    }
} 