<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Http\Controllers\Controller;
class MemberPageController extends Controller
{
    public function index(){
        return view('member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Detail',
            'meals' => Meal::all(),
        ]);
    }

<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function show_menu_detail($id){
        return view('components.meal_detail',[
=======
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function menuDetailShow($id)
    {
        return view('components.mealDetail', [
>>>>>>> Stashed changes:app/Http/Controllers/Member/MemberManagementController.php
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }

<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function package_food(){
=======
    public function packageFood()
    {
>>>>>>> Stashed changes:app/Http/Controllers/Member/MemberManagementController.php
        return view('components.test', [
            'title_page' => 'Safety Food Package',
        ]);
    }

<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function show_menu(){
        return view('member.menu_member', [
=======
    public function menuMealShow()
    {
        return view('components.mealMenu', [
>>>>>>> Stashed changes:app/Http/Controllers/Member/MemberManagementController.php
            'title_page' => 'Member Menu',
            'dashboard_info' => 'Meals Menu',
            'meals' => Meal::all(),
        ]);
    }
}
