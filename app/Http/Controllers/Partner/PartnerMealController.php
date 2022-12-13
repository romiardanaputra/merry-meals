<?php

namespace App\Http\Controllers\Partner;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\MealCreateRequest;
use App\Http\Requests\Partner\MealUpdateRequest;

class PartnerMealController extends Controller
{
    // display meal list in partner
    public function index()
    {
        return view('meal.mealList', [
            'meals' => Meal::all(),
            'dashboard_info' => 'Meal Lists',
            'title_page' => 'Meal lists',
        ]);
    }
    // display for form partner profile
    public function create()
    {
        return view('meal.mealCreate', [
            'title_page' => 'Create Meal',
            'dashboard_info' => 'Create Meal'
        ]);
    }

    // store meal created by partner
    public function store(MealCreateRequest $request)
    {
        $meal = $request->validated();
        $meal['partnerID'] = auth()->user()->partner->id;
        $meal['mealImage'] = ($request->hasFile('mealImage'))
            ?  $request->file('mealImage')->store('meal-images')
            : back();
        Meal::create($meal);
        return to_route('meal.index');
    }

    // show spesific meal based mealID
    public function show($id)
    {
        return view('meal.mealDetail', [
            'meal' => Meal::find($id),
        ]);
    }

    // show edit form meal based meal id 
    public function edit($id)
    {
        return view('meal.mealEdit', [
            'meal' => Meal::find($id),
            'title_page' => 'Meal Edit',
            'dashboard_info' => 'Meal Edit'
        ]);
    }

    // update meal based on meal id
    public function update(MealUpdateRequest $request, $id)
    {
        $meal = $request->validated();
        $meal['partnerID'] = auth()->user()->partner->id;
        $meal['mealImage'] = ($request->hasFile('mealImage'))
            ?  $request->file('mealImage')->store('meal-images')
            : back();
        Meal::where('id', $id)->update($meal);
        return to_route('meal.index');
    }

    // delete meal based on meal id
    public function destroy($id)
    {
        Meal::where('id', $id)->delete();
        return back();
    }
}
