<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        // $member_data = User::where('id', Auth::id())->get();
        // // $partner_data = Partner::where('id', Partner::get()->id);
        // $lat_partner = DB::table('geolocations')->where('partner_id', 2)->value('latitude');
        // $lon_partner = DB::table('geolocations')->where('partner_id', 2)->value('longitude');
        // $lon_member = DB::table('geolocations')->where('user_id', 2)->value('longitude');
        // $lat_member = DB::table('geolocations')->where('user_id', 2)->value('latitude');
        // $distance = self::vincentyGreatCircleDistance($lat_partner, $lon_partner, $lat_member, $lon_member);
        // dd(floor($distance));
        return view('member.dashboard',[
            'title_page'=> 'member dashboard',
        ]);
    }

    public function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
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
        return ($angle * $earthRadius) / 1000;
    }

    public function orderDetail($id){

        $mealID =  Meal::where('mealID','=',$id);
        $order = new Order();
        $order->userID = auth()->user()->id;
        dd($mealID);

    }
}
