<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/Mojarcms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\DevTool\Actions;

use MojarCMS\CMS\Abstracts\Action;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::BACKEND_INIT, [$this, 'addAdminMenus']);
    }

    public function addAdminMenus(): void
    {
        // $this->hookAction->addAdminMenu(
        //     'Dev Tools',
        //     'dev-tools',
        //     [
        //         'parent' => 'tools',
        //     ]
        // );
    }
}
