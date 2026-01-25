<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Http\Controllers;

use Illuminate\Contracts\View\View;
use MojarCMS\CMS\Http\Controllers\BackendController;

class DashboardController extends BackendController
{
    public function index(): View
    {
        $title = trans('cms::app.dashboard');

        return view('network::dashboard', compact('title'));
    }
}
