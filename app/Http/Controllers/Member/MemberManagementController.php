<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Models\Order;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberManagementController extends Controller
{
    // display member dashboard
    public function index()
    {
        return view('member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Detail',
            'orders' => Order::all(),
        ]);
    }

    // store order
    public function store(Request $request)
    {
        $order['userID'] = auth()->user()->id;
        $order['mealID'] = $request->meal;
        $order['partnerID'] = $request->partnerID;
        $order['mealPackage'] = $request->package;
        $order['range'] = OrderController::range($request->partnerID);
        $order['foodTemperature'] = OrderController::foodTemperature($order['range']);
        Order::create($order);
        return to_route('meal.order.success');
    }

    // update order when cancelled
    public function update(Request $request, $id)
    {
        $order['status'] = $request->orderStatus;
        Order::where('id', $id)->update($order);
        return back();
    }
    // display survey for member
    public function serviceSurvey()
    {
        return view('components.survey', [
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

    // packaging meal
    public function packageFood($id)
    {
        return view('components.mealPackage', [
            'title_page' => 'Safety Food Package',
            'meal' => Meal::find($id),
        ]);
    }
    // display menu member
    public function menuMealShow()
    {
        return view('components.mealMenu', [
            'title_page' => 'Member Menu',
            'dashboard_info' => 'Meals Menu',
            'meals' => Meal::all(),
        ]);
    }
}
