<?php

namespace MojarCMS\Translation;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

class TranslationAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addBackendMenu']);
    }

    public function addBackendMenu(): void
    {
        // HookAction::registerAdminPage(
        //     'translations',
        //     [
        //         'title' => trans('cms::app.translations'),
        //         'menu' => [
        //             'icon' => 'fa fa-language',
        //             'position' => 90,
        //             'parent' => 'tools',
        //         ],
        //     ]
        // );
    }
}
