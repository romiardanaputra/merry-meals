<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class MealCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mealName' => ['required', 'max:100'],
            'mealIngredient' => ['required', 'max:200'],
            'mealImage' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'mealDescription' => ['required', 'max:300'],
        ];
    }
}
