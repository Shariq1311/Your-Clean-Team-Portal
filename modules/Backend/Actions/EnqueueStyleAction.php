<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

class EnqueueStyleAction extends Action
{
    public function handle()
    {
        $this->addAction(self::BACKEND_HEADER_ACTION, [$this, 'enqueueStylesHeader']);
        $this->addAction(self::BACKEND_FOOTER_ACTION, [$this, 'enqueueStylesFooter']);
    }

    public function enqueueStylesHeader()
    {
        $scripts = HookAction::getEnqueueScripts();
        $styles = HookAction::getEnqueueStyles();

        echo view(
            'cms::frontend.styles',
            ['scripts' => $scripts, 'styles' => $styles]
        )->render();
    }

    public function enqueueStylesFooter()
    {
        $scripts = HookAction::getEnqueueScripts(true);
        $styles = HookAction::getEnqueueStyles(true);

        echo view(
            'cms::frontend.styles',
            ['scripts' => $scripts, 'styles' => $styles]
        )->render();
    }
}
