<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullName' => ['required', 'max:50'],
            'username' => ['required', 'max:10', 'min:3', 'unique:users'],
            'email' => ['required', 'unique:users'],
            'phoneNumber' => ['required', 'unique:users', 'numeric'],
            'age' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required'],
        ];
    }
}
