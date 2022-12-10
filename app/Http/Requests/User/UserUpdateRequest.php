<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullName' => ['max:50'],
            'username' => ['max:10', 'min:3'],
            'email' => ['email:dns,rfc'],
            'phoneNumber' => ['numeric'],
            'age' => ['numeric'],
            'address' => [],
            'password' => ['min:6'],
            'role' => []
        ];
    }
}
