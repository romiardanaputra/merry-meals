<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class MealUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'partnerID' => [],
            'mealName' => ['max:100'],
            'mealIngredient' => ['max:200'],
            'mealImage' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'mealDescription' => ['max:300'],
            'mealType' => [],
            'mealAvailability' => [],
        ];
    }
}
