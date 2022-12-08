<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class PartnerProfileReq extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'owner_name' => ['required'],
            'restaurant_name' => ['required'],
            'food_type' => ['required'],
            'restaurant_image' => ['required','image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'restaurant_address' => ['required'],
            'restaurant_contact' => ['required', 'unique:partners'],
        ];
    }
}
