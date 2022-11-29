<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeolocationController extends Controller
{
    public function ip_details()
    {
        // $ip = '126.191.246.155'; //For static IP address get
        $ip = request()->ip(); //Dynamic IP address get
        $data = \Location::get($ip);
        return view('components.details', compact('data'));
    }

    public static function store(Request $request)
    {
        $u_location = new Geolocation();
        $u_location->ip = $request->ip;
        $u_location->countryName = $request->countryName;
        $u_location->countryCode = $request->countryCode;
        $u_location->regionCode = $request->regionCode;
        $u_location->regionName = $request->regionName;
        $u_location->cityName = $request->cityName;
        $u_location->zipCode = $request->zipCode;
        $u_location->latitude = $request->latitude;
        $u_location->longitude = $request->longitude;
        $u_location->save();
        return to_route('landing.index');
    }
}
