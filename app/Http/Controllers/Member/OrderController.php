<?php

namespace App\Http\Controllers\Member;

use App\Models\Geolocation;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // display success page after order
    public function orderSuccess(){
        return view('components.orderSuccess',[
            'title_page' => 'order success'
        ]);
    }

    // get partner and member location based longitude and latitude
    public static function range($partnerID){
        $partners = Geolocation::where('partnerID', '=', $partnerID)->first();
        $members = Geolocation::where('userID', '=', auth()->user()->id)->first();
        $pLat = $partners->latitude;
        $pLong = $partners->longitude;
        $mLat = $members->latitude;
        $mLong = $members->longitude;
        $distance = self::vincentyGreatCircleDistance($pLat, $pLong, $mLat, $mLong);
        return $distance;
    }

    // determine food temperature
    public static function foodTemperature($distance){
        if($distance <= 10.0){
            $foodTemperature = 'hot Meal';
        } else {
            $foodTemperature = 'frozen';
        }
        return $foodTemperature;
    }

    // radius calculation 
    public static function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
    
        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
    
        $angle = atan2(sqrt($a), $b);
        // distance / 1000 = distance in km
        $range = ($angle * $earthRadius) / 1000;
        return $range ;
    }
}
