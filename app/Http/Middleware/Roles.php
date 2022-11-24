<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle($request, Closure $next, ...$roles)
  {

    // if ($request->route()->named('user.index')) {
    //   if (!Auth::check()) {
    //     if (!Auth::user()->role->exists()) {
    //       return back();
    //     }
    //     return back();
    //   }
    // }
    return collect($roles)->contains(auth()->user()->role) ? $next($request) : back();
  }
}
