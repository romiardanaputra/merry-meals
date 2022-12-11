<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

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
}
