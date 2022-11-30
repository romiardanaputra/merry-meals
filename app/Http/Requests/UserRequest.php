<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'fullName' => ['required', 'max:50'],
            'username' => ['required', 'max:10', 'min:3', 'unique:users'],
            'email' => ['required', 'unique:users', 'email:dns,rfc'],
            'phoneNumber' => ['required', 'unique:users', 'numeric'],
            'age' => ['required', 'numeric'],
            'address' => ['required'],
            'password' => ['required', 'min:6'],
            'role' => ['required'],
            // 'ip' => ['required'],
        ];
    }
}
