<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Roles
{

  public function handle(Request $request, Closure $next, ...$roles)
  {
    if (!Auth::check()) {
      abort(403);
    }
    return collect($roles)->contains(auth()->user()->role) ? $next($request) : back();
  }
}
