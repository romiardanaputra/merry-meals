<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email:dns,rfc'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            $user = $request->user();
            if ($user->role == 'Admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            } else {
                return redirect()->intended(RouteServiceProvider::USER_DASHBOARD);
            }
        } else {
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing.index');
    }

    public function register_index(){
        return view('components.register',[
            'title_page' => 'Sign Up',
        ]);
    }

    public function store_register(Request $request)
    {
        $this->validate($request, [
            'fullName' => ['required', 'max:50'],
            'username' => ['required', 'max:10', 'min:3'],
            'email' => ['required', 'unique:users', 'email:dns,rfc'],
            'phoneNumber' => ['required', 'unique:users', 'numeric'],
            'age' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6'],
            'role' => ['required']
        ]);

        $user = new User();
        $user->fullName = $request->fullName;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->age = $request->age;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $user->save();
        return redirect('/login');
    }
}