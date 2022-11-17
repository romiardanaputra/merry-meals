<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->role;
        if (Auth::check()) {
            switch ($role) {
                case 'admin':
                    $role = 'admin';
                    return $next($request);

                    break;
                case 'caregiver':
                    $role = 'caregiver';
                    return $next($request);

                    break;
                case 'volunteer':
                    $role = 'volunteer';
                    return $next($request);

                    break;
                case 'member':
                    $role = 'member';
                    return $next($request);

                    break;
                default:
                    return $next($request);

                    break;
            }
        }
        return $next($request);
    }
}
