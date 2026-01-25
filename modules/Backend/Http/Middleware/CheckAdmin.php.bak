<?php

namespace MojarCMS\Backend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!is_admin()) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        return $next($request);
    }
}
