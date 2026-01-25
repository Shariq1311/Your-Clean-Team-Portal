<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class SettingAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'addSettingForm']);
    }

    public function addSettingForm(): void
    {
        HookAction::registerConfig([
            'chatbot_enabled' => [
                'type' => 'boolean',
                'label' => trans('chatbot::content.enable_chatbots'),
                'default' => true,
            ],
            'chatbot_providers' => [
                'type' => 'array',
                'label' => trans('chatbot::content.chatbot_providers'),
                'default' => [],
            ],
            'chatbot_logging_enabled' => [
                'type' => 'boolean',
                'label' => trans('chatbot::content.enable_logging'),
                'default' => false,
            ],
        ]);

        // Add setting form like social login
        HookAction::addSettingForm(
            'chatbot',
            [
                'name' => trans('chatbot::content.chatbot_settings'),
                'view' => view(
                    'chatbot::backend.setting.form'
                ),
                'priority' => 30,
            ]
        );
    }
} 