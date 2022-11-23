<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //view for login page
    public function index()
    {
        return view('components.login', [
            "title_page" => "Sign In",
        ]);
    }

    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email:dns,rfc'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            $user = $request->user();
            if($user->role == 'Admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            } else {
                return redirect()->intended(RouteServiceProvider::USER_DASHBOARD);
            }
        } else {
            return back()->with('login_error', 'login failed, make sure your data is correct!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing.index');
    }
}
