<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    //view for login page
    public function index()
    {
        return view('components.login', [
            "title_page" => "Sign In",
        ]);
    }

    public function authenticate(AuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            $response = (!$request->user()->role == 'Admin') 
            ? redirect()->intended(RouteServiceProvider::USER_DASHBOARD) 
            : redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            return $response;
        }
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('landing.index');
    }

    public function register_index()
    {
        return view('components.register', [
            'title_page' => 'Sign Up',
        ]);
    }

    public function store_register(UserRequest $request)
    {
        $users_data = $request->validated();
        $users_data['password'] = Hash::make($users_data['password']);
        User::create($users_data);
        return to_route('login')->with('success_register', 'successfully registration please login!');
    }
}
