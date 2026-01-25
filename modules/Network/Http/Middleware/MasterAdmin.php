<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\Action;

class MasterAdmin
{
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route(
                'admin.login',
                [
                    'redirect' => url()->current()
                ]
            );
        }

        $user = Auth::user();

        if (! $user->isMasterAdmin()) {
            abort(404);
        }

        config()->set('Mojar.plugin.enable_upload', true);
        config()->set('Mojar.theme.enable_upload', true);

        do_action(Action::NETWORK_INIT, $request);

        return $next($request);
    }
}
