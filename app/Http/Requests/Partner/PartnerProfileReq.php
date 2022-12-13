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
            'userID' => [],
            'ownerName' => ['required'],
            'restaurantName' => ['required'],
            'foodType' => ['required'],
            'restaurantImage' => ['required','image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'restaurantAddress' => ['required'],
            'restaurantContact' => ['required', 'unique:partners'],
        ];
    }
}
