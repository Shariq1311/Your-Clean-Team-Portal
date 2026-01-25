<?php

namespace Mojahid\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckVendorStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userType = $user->getMeta('user_type');
            
            if ($userType === 'vendor') {
                $vendorStatus = $user->getMeta('user_status', 'under_review');
                
                // If vendor is not approved, redirect to appropriate page
                if ($vendorStatus !== 'approved') {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'message' => trans('ecomm::content.login_form.vendor_' . $vendorStatus),
                            'status' => $vendorStatus
                        ], 403);
                    }
                    
                    // Set session message for display
                    session()->flash('vendor_status_message', trans('ecomm::content.login_form.vendor_' . $vendorStatus));
                    session()->flash('vendor_status_type', $vendorStatus);
                    
                    Auth::logout();
                    return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
} 