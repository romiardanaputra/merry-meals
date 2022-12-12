<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserLocation extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ip' => [],
            'countryName' => [],
            'countryCode' => [],
            'regionCode' => [],
            'regionName' => [],
            'cityName' => [],
            'zipCode' => [],
            'latitude' => [],
            'longitude' => [],
        ];
    }
}
