<?php

namespace Mojahid\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $userId = Auth::id();
        $isCustomer = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $userId)
            ->where('roles.name', 'customer')
            ->exists();
            
        if (!$isCustomer) {
            return abort(403, 'Access denied: Customer account required');
        }
        
        return $next($request);
    }
}
