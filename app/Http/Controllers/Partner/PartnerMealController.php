<?php

namespace App\Http\Controllers\Partner;

use App\Models\Meal;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;

class PartnerMealController extends Controller
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

    public function store(ImageRequest $request)
    {
        $meal = new Meal;
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;
        ($request->hasFile('path'))
            ? $meal->path = $request->file('path')->store('meal-images')
            : back();
        $meal->save();  
        return to_route('meal.index');
    }

    public function show($id)
    {
        return view('meal.show_detail_meal',[
            'meal' => Meal::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('meal.edit_meal',[
            'meal' => Meal::find($id),
            'title_page' => 'Meal Edit',
            'dashboard_info' => 'Meal Edit'
        ]);
    }

    public function update(ImageRequest $request, $id)
    {
        $meal = Meal::find($id);
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;
        ($request->hasFile('path'))
            ? $meal->path = $request->file('path')->store('meal-images')
            : back();
        $meal->save();  
        return to_route('meal.index');
    }

    public function destroy($id)
    {
        $meal = Meal::find($id);
        $meal->delete();
        return back();
    }
}
