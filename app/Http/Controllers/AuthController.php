<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
             'email' => 'bail | required | max:100 | email:dns,rfc',
             'password' => 'bail | required | max:100 | min:6',
         ]);
 
         if (Auth::attempt($credential)) {
             $request->session()->regenerate();
             $admin = route('admin.landing');
             $staff = route('user.landing');
             $member = route('user.landing');
             $role = Auth::user()->role;
             if (Auth::check()) {
                 if ($role == 'admin') {
                     return redirect()->intended($admin);
                 } elseif ($role == 'caregiver' || 'volunteer') {
                     return redirect()->intended($staff);
                 } elseif ($role == 'member') {
                     return redirect()->intended($member);
                 }
                 dd('error');
             }
         }
         return back()->with('login_error', 'login failed, make sure your data is correct!');
     }

     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect('/');
     }
}
