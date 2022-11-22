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
        return view('meal.index',[
            'meals' => $meal_detail,
        ]);
    }

    public function create()
    {
        return view('meal.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:100'],
            'ingredient' => ['required', 'max:200'],
            'path' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
        ]);

        $meal = new Meal();
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;

        if ($request->hasFile('path')) {
            $new_file = $request->file('path');
            $file_path = $new_file->store('public/images');
            $meal->path = $file_path;
            $meal->save();
            return redirect('meal.show');
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
            'path' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
        ]);

        $meal = Meal::find($meal->id);
        $meal->name = $request->name;
        $meal->ingredient = $request->ingredient;

        if ($request->hasFile('path')) {
            $new_file = $request->file('path');
            $file_path = $new_file->store('public/images');
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
