<?php

namespace MojarCMS\Backend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class EmployeeDataAccess
{
    /**
     * Handle an incoming request.
     *
     * Ensures employees can only access their own data and endpoints
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

        // Admins have full access
        if (is_admin()) {
            return $next($request);
        }

        // For employees, check if accessing their own data
        $employeeId = $request->route('employee_id') ?? $request->route('id') ?? null;
        $currentUserId = auth()->id();

        if ($employeeId && (int)$employeeId !== (int)$currentUserId) {
            throw new AuthorizationException('You do not have permission to access this employee data.');
        }

        return $next($request);
    }
}
