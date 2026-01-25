<?php

namespace Mojahid\Newsletters\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

class MenuAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        // $this->addAction(Action::INIT_ACTION, [$this, 'registerResources']);
        // $this->addAction('resource.newsletters-subscribers.form_left', [$this, 'formNewslettersForm']);
        $this->addAction(Action::BACKEND_INIT, [$this, 'registerMenus']);
        // $this->addAction(Action::INIT_ACTION, [$this, 'registerPostTypes']);
    }

    public function registerPostTypes(): void
    {
        //
    }

    public function formNewslettersForm(): void
    {
        echo e(view('newsletters::backend.newsletters-subscribers.form'));
    }

    public function registerResources(): void
    {

        HookAction::registerResource(
            'newsletters-subscribers',
            null,
            [
                'label' => __('Newsletters Form'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail-opened"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 9l9 6l9 -6l-9 -6l-9 6" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><path d="M3 19l6 -6" /><path d="M15 13l6 6" /></svg>',
                    'parent' => 'newsletters-subscribers',
                ],
                'fields' => [
                    'name' => [
                        'type' => 'text',
                        'label' => __('Name'),
                        'rules' => 'required',
                        'value' => 'name',
                        'default' => 'name',
                        'help' => __('This is the name of the form'),
                        'order' => 1,
                        'data' => [
                            'placeholder' => __('Enter your name'),
                        ],
                    ],
                    'display_order' => [
                        'type' => 'text', 
                        'label' => __('Display Order'),
                        'rules' => 'required|integer|min:1',
                        'data' => [
                            'type' => 'number',
                            'min' => 1,
                            'step' => 1,
                        ],
                    ],
                ],
                'metas' => [],
            ],
        );
    }

    public function registerMenus(): void
    {
        HookAction::registerAdminPage(  
            'newsletters-subscribers',
            [
                'title' => __('Newsletters Subscribers'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mailbox"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg>',
                    'position' => 60,
                ],
            ]
        );
    }
}