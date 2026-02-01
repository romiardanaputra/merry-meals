<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('features.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();
        
        if ($user->role === User::ROLE_SUPERADMIN) {
            return redirect()->intended('superadmin/dashboard');
        } elseif ($user->role === User::ROLE_ADMIN) {
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        } elseif ($user->role === User::ROLE_PARTNER) {
            return redirect()->intended(RouteServiceProvider::PARTNER_DASHBOARD);
        } elseif ($user->role === User::ROLE_DRIVER) {
            return redirect()->intended('driver/dashboard');
        }

        return redirect()->intended(RouteServiceProvider::MEMBER_DASHBOARD);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
