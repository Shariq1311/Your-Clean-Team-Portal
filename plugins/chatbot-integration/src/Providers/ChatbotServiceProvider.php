<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Providers;

use MojarCMS\CMS\Support\ServiceProvider;
use MojarCMS\CMS\Facades\ActionRegister;
use Mojahid\ChatbotIntegration\Actions\ChatbotAction;
use Mojahid\ChatbotIntegration\Actions\SettingAction;

final class ChatbotServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        ActionRegister::register([
            ChatbotAction::class,
            SettingAction::class,
        ]);
    }

    public function register(): void
    {   
        //
    }
} 