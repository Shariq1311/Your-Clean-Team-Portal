<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\API\Http\Controllers\Admin;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Http\Controllers\ApiController;

class AdminApiController extends ApiController
{
    public function callAction($method, $parameters): \Symfony\Component\HttpFoundation\Response
    {
        do_action(Action::BACKEND_CALL_ACTION, $method, $parameters);

        return parent::callAction($method, $parameters);
    }
}
