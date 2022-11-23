<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MealsController extends Controller
{

    public function index()
    {
        $meal_detail = Meal::all();
        return view('meal.index', [
            'meals' => $meal_detail,
            'title_page' => 'Create Meal'
        ]);
    }

    public function create()
    {
        return view('meal.create', [
            'title_page' => 'Create Meal'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:100'],
            'ingredient' => ['required', 'max:200'],
            'path' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000']
        ]);

        $meal = new Meal();
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;

        if ($request->hasFile('path')) {
            $new_file = $request->file('path');
            $file_path = $new_file->store('meal-images');
            $meal->path = $file_path;
            $meal->save();
            return redirect()->route('meal.index');
        }
        return redirect()->back();
    }

    public function show(Meal $meal)
    {
        $meal = Meal::find($meal->id);
        return view('meal.show');
    }

    public function edit(Meal $meal)
    {
        $meal = Meal::find($meal->id);
        return view('meal.edit');
    }

    public function update(Request $request, Meal $meal)
    {
        $this->validate($request, [
            'name' => ['required', 'max:100'],
            'ingredient' => ['required', 'max:200'],
            'path' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:1000']
        ]);

        $meal = Meal::find($meal->id);
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;

        if ($request->hasFile('path')) {
            $new_file = $request->file('path');
            $file_path = $new_file->store('meal-images');
            $meal->path = $file_path;
            $meal->save();
            return redirect('meal.show');
        }
        return redirect()->back();
    }


    public function destroy(Meal $meal)
    {
        $meal = Meal::find($meal->id);
        $meal->delete();
        return redirect()->back();
    }
}
