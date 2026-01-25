<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\API\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\Action;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (!$user = Auth::guard('api')->user()) {
            abort(403, __('You can not access this page.'));
        }

        if (!has_permission($user)) {
            abort(403, __('You can not access this page.'));
        }

        do_action(Action::BACKEND_INIT, $request);

        return $next($request);
    }
}
