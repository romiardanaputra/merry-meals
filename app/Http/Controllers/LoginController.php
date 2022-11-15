<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //view for login page
    public function index(){
        return view('components.login',[
            "name_content" => "Sign In",
            "title" => "Sign In"
        ]);
    }

    public function authenticate(Request $request){
        $credential = $request->validate([
            'email_user' => 'bail | required | max:100 | email:dns,rfc',
            'password' => 'bail | required | max:100 | min:6',
        ]);

        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('login_error', 'login failed, make sure your data is correct!');
    }
}
