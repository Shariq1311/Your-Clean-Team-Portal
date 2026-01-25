<?php

namespace Mojahid\ContactForm\Actions;

use MojarCMS\CMS\Abstracts\Action;
use Mojahid\ContactForm\Http\Controllers\Frontend\ContactController;
use MojarCMS\CMS\Facades\HookAction;
class AjaxAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerPostContact']);
    }

    public function registerPostContact(): void
    {
        HookAction::registerFrontendAjax(
            'contact',
            [
                'method' => 'POST',
                'callback' => [ContactController::class, 'store'],
            ]
        );
    }
}
