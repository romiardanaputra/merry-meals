<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;

class MealsController extends Controller
{

    public function index()
    {
        return view('meal.list_meal', [
            'meals' => Meal::all(),
            'dashboard_info' => 'Meal Lists',
            'title_page' => 'Meal lists',
         

        ]);
    }

    public function create()
    {
        return view('meal.create_meal', [
            'title_page' => 'Create Meal',
            'dashboard_info' => 'Create Meal'
        ]);
    }

    public function store(ImageRequest $req)
    {
        $meal = new Meal;
        $meal->name = $req->name;
        $meal->ingredient = $req->ingredient;
        ($req->hasFile('path'))
            ? $meal->path = $req->file('path')->store('meal-images')
            : back();
        $meal->save();  
        return to_route('meal.index');
    }

    public function show(Meal $meal)
    {
        return view('meal.show_detail_meal',[
            'meal' => Meal::find($meal->id),
        ]);
    }

    public function edit(Meal $meal)
    {
        return view('meal.edit_meal',[
            'meal' => Meal::find($meal->id),
            'title_page' => 'Meal Edit',
            'dashboard_info' => 'Meal Edit'
        ]);
    }

    public function update(ImageRequest $req, Meal $meal)
    {
        $meal = Meal::find($meal->id);
        $meal->name = $req->name;
        $meal->ingredient = $req->ingredient;
        ($req->hasFile('path'))
            ? $meal->path = $req->file('path')->store('meal-images')
            : back();
        $meal->save();  
        return to_route('meal.index');
    }


    public function destroy(Meal $meal)
    {
        $meal = Meal::find($meal->id);
        $meal->delete();
        return back();
    }
}
