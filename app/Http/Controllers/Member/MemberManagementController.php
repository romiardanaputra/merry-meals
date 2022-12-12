<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberManagementController extends Controller
{
   
    public function index()
    {
        return view('member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Detail',
            'orders' => Order::all(),
        ]);
    }

    public function store(Request $request){
        $order = new Order;
        $order->userID = auth()->user()->id;
        $order->mealID = $request->meal;
        $order->partnerID = $request->partnerID;
        $order->mealPackage = $request->package;
        $order->range = self::range($request->partnerID);
        $order->foodTemperature = self::foodTemperature($order->range);
        $order->save();
        return to_route('meal.order.success');
    }

    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->status = $request->orderStatus;
        $order->save();
        return back();
    }

    public function orderSuccess(){
        return view('components.orderSuccess',[
            'title_page' => 'order success'
        ]);
    }

    public function serviceSurvey(){
        return view('components.survey',[
            'title_page' => 'survey'
        ]);
    }

    // detail meal
    public function menuDetailShow($id)
    {
        return view('components.mealDetail', [
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }   

    // packaging
    public function packageFood($id){
        return view('components.mealPackage', [
            'title_page' => 'Safety Food Package',
            'meal' => Meal::find($id),
            'geolocation' => Geolocation::all(),
        ]);
    }

    public function menuMealShow()
    {
        return view('components.mealMenu', [
            'title_page' => 'Member Menu',
            'dashboard_info' => 'Meals Menu',
            'meals' => Meal::all(),
        ]);
    }

    public function range($partnerID){
        $partners = Geolocation::where('partnerID', '=', $partnerID)->first();
        $members = Geolocation::where('userID', '=', auth()->user()->id)->first();
        $pLat = $partners->latitude;
        $pLong = $partners->longitude;
        $mLat = $members->latitude;
        $mLong = $members->longitude;
        $distance = self::vincentyGreatCircleDistance($pLat, $pLong, $mLat, $mLong);
        return $distance;
    }

    public function foodTemperature($distance){
        if($distance <= 10.0){
            $foodTemperature = 'hot Meal';
        } else {
            $foodTemperature = 'frozen';
        }
        return $foodTemperature;
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
        $range = ($angle * $earthRadius) / 1000;
        return $range ;
    }
}
