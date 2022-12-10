<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\User\UserAuthRequest;
use App\Http\Requests\User\UserCreateRequest;
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

    public function authenticate(UserAuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();
            if($request->user()->role == 'admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
            } elseif($request->user()->role == 'member'){
                return redirect()->intended(RouteServiceProvider::MEMBER_DASHBOARD);
            } elseif($request->user()->role == 'caregiver'){
                return redirect()->intended(RouteServiceProvider::CAREGIVER_DASHBOARD);
            } elseif($request->user()->role == 'volunteer'){
                return redirect()->intended(RouteServiceProvider::VOLUNTEER_DASHBOARD);
<<<<<<< HEAD
<<<<<<< Updated upstream
=======
            }elseif($request->user()->role == 'partner'){
                return redirect()->intended(RouteServiceProvider::PARTNER_DASHBOARD);
            }else{
                return abort(403);
>>>>>>> Stashed changes
=======
            }elseif($request->user()->role == 'partner'){
                return redirect()->intended(RouteServiceProvider::PARTNER_DASHBOARD);
>>>>>>> 30fcb838942d82c689d7430a4bc4e73578ed1d3f
            }
        }
        return to_route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('landing.index');
    }

    public function registerIndex(Request $request)
    {
        $data = Location::get('https://' . $request->ip()); 
        return view('components.register', compact('data') , [
            'title_page' => 'Sign Up',
        ]);
    }

    public function storeRegister(UserCreateRequest $request)
    {
        $users = $request->validated();
        $users['password'] = Hash::make($users['password']);
        $dataUsers = User::create($users);
        self::userLocation($dataUsers, $request);
        return to_route('login')->with('success_register', 'successfully registration please login!');
    }

    public static function userLocation($dataUsers, $request){
        $data = Location::get('https://' . $request->ip());
        $loc = new Geolocation;
        $loc->ip = $data->ip;
        $loc->countryName = $data->countryName;
        $loc->countryCode = $data->countryCode;
        $loc->regionCode = $data->regionCode;
        $loc->regionName = $data->regionName;
        $loc->cityName = $data->cityName;
        $loc->zipCode = $data->zipCode;
        $loc->latitude = $data->latitude;
        $loc->longitude = $data->longitude;
        $loc->userID = $dataUsers->id;
        $loc->save();
    }
}