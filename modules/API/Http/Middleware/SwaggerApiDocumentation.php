<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Http\Middleware;

class SwaggerApiDocumentation
{
    public function handle($request, \Closure $next)
    {
        if (!config('Mojar.api.enable')) {
            abort(404);
        }

        return $next($request);
    }
}
