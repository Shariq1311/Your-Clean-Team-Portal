<?php

namespace Mojahid\SupportTicket\Actions;

use MojarCMS\CMS\Abstracts\Action;
use Mojahid\SupportTicket\Http\Controllers\Frontend\TicketSupportController;

class AjaxAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'addFrontendAjax']);
    }

    /**
     * @throws \Exception
     */
    public function addFrontendAjax(): void
    {
        $this->hookAction->registerFrontendAjax(
            'ticket-support.download-attachments',
            [
                'auth' => true,
                'method' => 'get',
                'callback' => [TicketSupportController::class, 'downloadAttachment'],
            ]
        );
    }
}
