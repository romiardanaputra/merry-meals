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
        $user = auth()->user();
        if ($user->role === 'admin' || $user->role === 'superadmin') {
            $meals = Meal::all();
        } else {
            $meals = Meal::where('partnerID', $user->partner->id)->get();
        }

        return view('features.partner.meals.index', [
            'meals' => $meals,
            'dashboard_info' => 'Meal Lists',
            'title_page' => 'Meal Management',
        ]);
    }
    // display for form partner profile
    public function create()
    {
        return view('features.partner.meals.create', [
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
        return to_route('partner.meals.index');
    }

    // show spesific meal based mealID
    public function show($id)
    {
        return view('features.meals.mealDetail', [
            'meal' => Meal::find($id),
        ]);
    }

    // show edit form meal based meal id 
    public function edit($id)
    {
        return view('features.partner.meals.edit', [
            'meal' => Meal::find($id),
            'title_page' => 'Edit Meal',
            'dashboard_info' => 'Edit Meal'
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
        return to_route('partner.meals.index');
    }

    // delete meal based on meal id
    public function destroy($id)
    {
        Meal::where('id', $id)->delete();
        return back();
    }
}
