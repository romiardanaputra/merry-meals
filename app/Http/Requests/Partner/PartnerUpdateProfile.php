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
            'owner_name' => [''],
            'restaurant_name' => [''],
            'food_type' => [''],
            'restaurant_image' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'restaurant_address' => [''],
            'restaurant_contact' => ['', 'unique:partners'],
        ];
    }
}
