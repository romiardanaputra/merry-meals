<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberPageController extends Controller
{
    public function index(){
        // dd($role);
        return view('components.meal_menu', [
            'title_page' => 'User Dashboard',
            'dashboard_info' => 'User Panel',
            'meals' => Meal::all(),
        ]);
    }
    public function show($id){
        return view('components.meal_detail',[
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }
}
