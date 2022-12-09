<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateProfile extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ownerName' => [''],
            'restaurantName' => [''],
            'foodType' => [''],
            'restaurantImage' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'restaurantAddress' => [''],
            'restaurantContact' => ['', 'unique:partners'],
        ];
    }
}
