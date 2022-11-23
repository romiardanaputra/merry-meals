<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
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
            if ($role == 'Member' || $role == 'Caregiver' || $role == 'Volunteer') {
                return $next($request);
            } else {
                return redirect()->back()->with('message', 'please, register first!');
            }
        } else {
            return redirect()->back();
        }
        return $next($request);
    }
}
