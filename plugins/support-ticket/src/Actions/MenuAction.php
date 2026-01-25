<?php

namespace Mojahid\SupportTicket\Actions;

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
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
        $this->addAction(Action::INIT_ACTION, [$this, 'addMailHooks']);
    }

    public function addAdminMenus(): void
    {
        $this->hookAction->addAdminMenu(
            __('Ticket Support'),
            'ticket-supports',
            [
                'icon' => 'fa fa-ticket',
                'position' => 30,
            ]
        );

        $this->hookAction->registerAdminPage(
            'ticket-supports.tickets',
            [
                'title' => __('Tickets'),
                'menu' => [
                    'icon' => 'fa fa-ticket',
                    'parent' => 'ticket-supports',
                    'position' => 1,
                    'permissions' => [
                        'ticket-supports.index',
                        'ticket-supports.create',
                        'ticket-supports.edit',
                        'ticket-supports.delete',
                    ]
                ],
            ]
        );

        $this->hookAction->registerAdminPage(
            'ticket-supports.types',
            [
                'title' => __('Types'),
                'menu' => [
                    'icon' => 'fa fa-list',
                    'parent' => 'ticket-supports',
                    'position' => 30,
                    'permissions' => [
                        'ticket-supports-types.index',
                        'ticket-supports-types.create',
                        'ticket-supports-types.edit',
                        'ticket-supports-types.delete',
                    ]
                ],
            ]
        );

        HookAction::registerAdminPage(
            'support-ticket.settings',
            [
                'title' => trans('sticket::content.settings'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path></svg>',
                    'position' => 50,
                    'parent' => 'ticket-supports'
                ]
            ]
        );
    }

    public function addMailHooks(): void
    {
        $this->hookAction->registerEmailHook(
            'ticket_support_submited',
            [
                'label' => 'Ticket Support submited',
                'params' => [
                    'name' => 'Author name submit ticket',
                    'email' => 'Author email submit ticket',
                    'ticket' => 'Title Ticket',
                ],
            ]
        );

        $this->hookAction->registerEmailHook(
            'ticket_support_comment',
            [
                'label' => 'Ticket Support comment',
                'params' => [
                    'name' => 'Author name comment ticket',
                    'email' => 'Author email comment ticket',
                    'ticket' => 'Title Ticket',
                ],
            ]
        );
    }
}
