<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use MojarCMS\CMS\Support\Installer;

class Installed
{
    public function handle($request, Closure $next)
    {
        if (! Installer::alreadyInstalled()) {
            if (!str_contains(Route::currentRouteName(), 'installer.')) {
                return redirect()->route('installer.welcome');
            }
        }

        return $next($request);
    }
}
