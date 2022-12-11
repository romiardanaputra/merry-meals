<?php

namespace App\Http\Controllers\Partner;

use App\Models\Meal;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Partner\MealCreateRequest;
use App\Http\Requests\Partner\MealUpdateRequest;

class PartnerMealController extends Controller
{
    public function index()
    {
        return view('meal.mealList', [
            'meals' => Meal::all(),
            'dashboard_info' => 'Meal Lists',
            'title_page' => 'Meal lists',
        ]);
    }

    public function create()
    {
        return view('meal.mealCreate', [
            'title_page' => 'Create Meal',
            'dashboard_info' => 'Create Meal'
        ]);
    }

    public function store(MealCreateRequest $request)
    {
        $meal = new Meal;
        $meal->partnerID = auth()->user()->partner->id;
        $meal->mealName = $request->mealName;
        $meal->mealIngredient = $request->mealIngredient;
        $meal->mealDescription = $request->mealDescription;
        $meal->mealType = $request->mealType;
        $meal->mealAvailability = $request->mealAvailability;
        ($request->hasFile('mealImage'))
            ? $meal->mealImage = $request->file('mealImage')->store('meal-images')
            : back();
        $meal->save();
        return to_route('meal.index');
    }

    public function show($id)
    {
        return view('meal.mealDetail', [
            'meal' => Meal::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('meal.mealEdit', [
            'meal' => Meal::find($id),
            'title_page' => 'Meal Edit',
            'dashboard_info' => 'Meal Edit'
        ]);
    }

    public function update(MealUpdateRequest $request, $id)
    {
        $meal = Meal::find($id);
        $meal->mealName = $request->mealName;
        $meal->mealIngredient = $request->mealIngredient;
        ($request->hasFile('mealImage'))
            ? $meal->mealImage = $request->file('mealImage')->store('meal-images')
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
