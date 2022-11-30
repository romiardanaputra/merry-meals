<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(){
        return view('components.meal_menu',[
            'title_page' => 'Meal Menu',
            'meals' => Meal::all(),
        ]);
    }

    public function show($id){
        return view('components.menu_detail',[
            'title_page' => 'Meal Menu',
            'meal' => Meal::find($id),
        ]);
    }
}
