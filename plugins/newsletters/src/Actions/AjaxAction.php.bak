<?php

namespace Mojahid\Newsletters\Actions;

use MojarCMS\CMS\Abstracts\Action;
use Mojahid\Newsletters\Http\Controllers\Frontend\NewslettersController;
use MojarCMS\CMS\Facades\HookAction;
class AjaxAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_INIT, [$this, 'registerPostNewsletters']);
    }

    public function registerPostNewsletters(): void
    {
        HookAction::registerFrontendAjax(
            'newsletters-subscribers',
            [
                'method' => 'POST',
                'callback' => [NewslettersController::class, 'store'],
            ]
        );
    }
}
