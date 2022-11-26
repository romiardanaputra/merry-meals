<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;

class MealsController extends Controller
{

    public function index()
    {
        return view('meal.index', [
            'meals' => Meal::all(),
            'title_page' => 'Create Meal'
        ]);
    }

    public function create()
    {
        return view('meal.create', [
            'title_page' => 'Create Meal'
        ]);
    }

    public function store(ImageRequest $request)
    {
        $meal = new Meal();
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;
        ($request->hasFile('path'))
            ? $meal->path = $request->file('path')->store('meal-images')
            : back();
        $meal->save();  
        return to_route('meal.index');
    }

    public function show(Meal $meal)
    {
        return view('meal.show',[
            'meal' => Meal::find($meal->id),
        ]);
    }

    public function edit(Meal $meal)
    {
        return view('meal.edit',[
            'meal' => Meal::find($meal->id),
            'title_page' => 'Meal Edit',
        ]);
    }

    public function update(ImageRequest $request, Meal $meal)
    {
        $meal = Meal::find($meal->id);
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;
        ($request->hasFile('path'))
            ? $meal->path = $request->file('path')->store('meal-images')
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
