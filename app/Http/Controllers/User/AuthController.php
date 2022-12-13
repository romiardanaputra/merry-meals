<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Stevebauman\Location\Facades\Location;
use App\Http\Requests\User\UserAuthRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserLocation;

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

    public function registerIndex(Request $request)
    {
        $data = Location::get('https://' . $request->ip());
        return view('components.register', compact('data'), [
            'title_page' => 'Sign Up',
        ]);
    }

    public function storeRegister(UserCreateRequest $request, UserLocation $reqLoc)
    {
        $users = $request->validated();
        $users['password'] = Hash::make($users['password']);
        $dataUsers = User::create($users);
        self::userLocation($dataUsers, $request, $reqLoc);
        return to_route('login')->with('successRegister', 'successfully registration please login!');
    }

    public static function userLocation($dataUsers, $request, $reqLoc)
    {
        $uLoc = $reqLoc->validated();
        $data = Location::get('https://' . $request->ip());
        $uLoc['ip'] = $data->ip;
        $uLoc['countryName'] = $data->countryName;
        $uLoc['countryCode'] = $data->countryCode;
        $uLoc['regionName'] = $data->regionName;
        $uLoc['regionCode'] = $data->regionCode;
        $uLoc['cityName'] = $data->cityName;
        $uLoc['zipCode'] = $data->zipCode;
        $uLoc['latitude'] = $data->latitude;
        $uLoc['longitude'] = $data->longitude;
        $uLoc['userID'] = $dataUsers->id;
        Geolocation::create($uLoc);
    }
}
