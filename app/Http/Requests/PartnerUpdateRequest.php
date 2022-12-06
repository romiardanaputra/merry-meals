<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'owner_name' => [''],
            'restaurant_name' => [''],
            'food_type' => [''],
            'restaurant_image' => ['required','image', 'mimes:jpg,png,jpeg,gif,svg', 'file', 'max:1000'],
            'restaurant_address' => [''],
            'email' => ['email:dns,rfc'],
            'password' => ['min:6'],
            'restaurant_contact' => [''],
        ];
    }
}
