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
        $user = auth()->user();
        $orders = Order::where('userID', $user->id)->latest()->get();
        
        $stats = [
            'total_orders' => $orders->count(),
            'active_deliveries' => $orders->whereIn('status', ['assigned', 'picked_up'])->count(),
            'delivered_orders' => $orders->where('status', 'delivered')->count(),
            'pending_surveys' => $orders->where('status', 'delivered')->count() - \App\Models\Survey::where('userID', $user->id)->count(),
        ];

        return view('features.member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Your Activity Overview',
            'orders' => $orders->take(5),
            'stats' => $stats,
        ]);
    }

    // store order
    public function store(Request $request)
    {
        $order['userID'] = auth()->user()->id;
        $order['mealID'] = $request->mealID;
        $order['partnerID'] = $request->partnerID;
        $order['mealPackage'] = $request->package;
        
        // Ensure OrderController exists or handle logic here
        // For now, let's assume it works or fix if it fails
        $order['range'] = \App\Http\Controllers\OrderController::range($request->partnerID);
        $order['foodTemperature'] = \App\Http\Controllers\OrderController::foodTemperature($order['range']);
        
        Order::create($order);
        return to_route('member.meals.order.success');
    }

    // update order when cancelled
    public function update(Request $request, $id)
    {
        $order['status'] = $request->orderStatus;
        Order::where('id', $id)->update($order);
        return back();
    }

    // detail meal
    public function menuDetailShow($id)
    {
        return view('features.member.meals.detail', [
            'title_page' => 'Meal Detail',
            'meal' => Meal::find($id),
        ]);
    }

    // packaging meal
    public function packageFood($id)
    {
        return view('features.member.meals.package', [
            'title_page' => 'Select Package',
            'meal' => Meal::find($id),
        ]);
    }
    // display menu member
    public function menuMealShow()
    {
        return view('features.member.meals.menu', [
            'title_page' => 'Browse Meals',
            'dashboard_info' => 'Explore Nutritious Meals',
            'meals' => Meal::where('mealAvailability', 'available')->get(),
        ]);
    }

    // display survey form
    public function surveyShow()
    {
        return view('features.member.survey', [
            'title_page' => 'Service Feedback',
        ]);
    }

    // store survey
    public function surveyStore(Request $request)
    {
        $request->validate([
            'q1' => 'required|string',
            'q2' => 'required|string',
            'q3' => 'required|string',
            'q4' => 'required|string',
            'q5' => 'required|string',
            'q6' => 'required|string',
            'q7' => 'required|string',
            'q8' => 'required|string',
            'overall' => 'required|integer|min:1|max:5',
        ]);

        \App\Models\Survey::create([
            'userID' => auth()->id(),
            'questionOne' => $request->q1,
            'questionTwo' => $request->q2,
            'questionThree' => $request->q3,
            'questionFour' => $request->q4,
            'questionFive' => $request->q5,
            'questionSix' => $request->q6,
            'questionSeven' => $request->q7,
            'questionEight' => $request->q8,
            'overall' => $request->overall,
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Thank you for your feedback! It helps us improve Merry Meals.');
    }
}
