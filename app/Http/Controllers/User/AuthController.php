<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\User\UserAuthRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('components.login', [
            "title_page" => "Sign In",
        ]);
    }

    public function authenticate(UserAuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            if ($request->user()->role == 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            } elseif ($request->user()->role == 'member') {
                return redirect()->intended(RouteServiceProvider::MEMBER_DASHBOARD);
            } elseif ($request->user()->role == 'caregiver') {
                return redirect()->intended(RouteServiceProvider::CAREGIVER_DASHBOARD);
            } elseif ($request->user()->role == 'volunteer') {
                return redirect()->intended(RouteServiceProvider::VOLUNTEER_DASHBOARD);
            }elseif($request->user()->role == 'donor'){
                return redirect()->intended(RouteServiceProvider::DONOR_DASHBOARD);
            }elseif ($request->user()->role == 'partner') {
                return redirect()->intended(RouteServiceProvider::PARTNER_DASHBOARD);
            } else {
                return abort(403);
            }
        }
        return to_route('login')->with('loginFailed', 'login failed please input your data correctly!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('landing.index');
    }    
}
