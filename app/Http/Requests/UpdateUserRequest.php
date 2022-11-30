<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'fullName' => ['max:50'],
            'username' => ['max:10', 'min:3'],
            'email' => ['email:dns,rfc'],
            'phoneNumber' => ['numeric'],
            'age' => ['numeric'],
            'address' => [],
            'password' => ['min:6'],
            'role' =>[]
        ];
    }
}
