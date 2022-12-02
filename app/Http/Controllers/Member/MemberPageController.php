<?php

namespace App\Http\Controllers\Member;

use App\Models\Meal;
use App\Http\Controllers\Controller;
class MemberPageController extends Controller
{
    public function show_menu_detail($id){
        return view('components.meal_detail',[
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }

    public function index(){
        
        return view('member.menu_member', [
            'title_page' => 'Member Dashboard',
            'dashboard_info' => 'Meals Menu',
            'meals' => Meal::all(),
        ]);
    }
}
