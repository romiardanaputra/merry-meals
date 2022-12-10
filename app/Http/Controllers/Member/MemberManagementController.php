<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberManagementController extends Controller
{
    public function index()
    {
        return view('member.dashboard', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Detail',
            'meals' => Meal::all(),
        ]);
    }

<<<<<<< HEAD:app/Http/Controllers/Member/MemberPageController.php
<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function show_menu_detail($id){
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

    public function menuDetailShow($id){
>>>>>>> 30fcb838942d82c689d7430a4bc4e73578ed1d3f:app/Http/Controllers/Member/MemberManagementController.php
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

<<<<<<< HEAD:app/Http/Controllers/Member/MemberPageController.php
<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function package_food(){
=======
    public function packageFood()
    {
>>>>>>> Stashed changes:app/Http/Controllers/Member/MemberManagementController.php
=======
    public function packageFood(){
>>>>>>> 30fcb838942d82c689d7430a4bc4e73578ed1d3f:app/Http/Controllers/Member/MemberManagementController.php
        return view('components.test', [
            'title_page' => 'Safety Food Package',
        ]);
    }

<<<<<<< HEAD:app/Http/Controllers/Member/MemberPageController.php
<<<<<<< Updated upstream:app/Http/Controllers/Member/MemberPageController.php
    public function show_menu(){
=======
    public function menuMealShow(){
>>>>>>> 30fcb838942d82c689d7430a4bc4e73578ed1d3f:app/Http/Controllers/Member/MemberManagementController.php
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
