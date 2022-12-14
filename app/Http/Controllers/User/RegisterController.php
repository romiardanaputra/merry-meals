<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserLocation;
use Stevebauman\Location\Facades\Location;
use App\Http\Requests\User\UserCreateRequest;


class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $data = Location::get('https://' . $request->ip());
        return view('components.register', compact('data'), [
            'title_page' => 'Sign Up',
        ]);
    }

    public function store(UserCreateRequest $request, UserLocation $reqLoc)
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
