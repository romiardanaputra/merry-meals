<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberManagementController extends Controller
{
    public function index()
    {
        return view('member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Detail',
            'users' => User::all(),
        ]);
    }

    public function store(){
        
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

    public function menuDetailShow($id)
    {
        return view('components.mealDetail', [
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }

    public function packageFood(){
        return view('components.mealPackage', [
            'title_page' => 'Safety Food Package',
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
