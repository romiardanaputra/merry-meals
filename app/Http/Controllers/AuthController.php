<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Models\Geolocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
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
            $response = (!$request->user()->role == 'admin')
                ? redirect()->intended(RouteServiceProvider::USER_DASHBOARD)
                : redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            return $response;
        }
        return to_route('landing.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('landing.index');
    }

    public function register_index(Request $request)
    {
        $data = Location::get('https://' . $request->ip());  //dynamic ip address
        return view('components.register', compact('data') , [
            'title_page' => 'Sign Up',
        ]);
    }

    public function store_register(UserRequest $request)
    {
        $users_data = $request->validated();
        $users_data['password'] = Hash::make($users_data['password']);
        // User::create($users_data);
        $create_user = User::create($users_data);
        $data = Location::get('https://' . $request->ip());  //dynamic ip address
        $u_location = new Geolocation;
        $u_location->ip = $data->ip;
        $u_location->countryName = $data->countryName;
        $u_location->countryCode = $data->countryCode;
        $u_location->regionCode = $data->regionCode;
        $u_location->regionName = $data->regionName;
        $u_location->cityName = $data->cityName;
        $u_location->zipCode = $data->zipCode;
        $u_location->latitude = $data->latitude;
        $u_location->longitude = $data->longitude;
        $u_location->user_id = $create_user->id;
        $u_location->save();
        return to_route('login')->with('success_register', 'successfully registration please login!');
    }
}
