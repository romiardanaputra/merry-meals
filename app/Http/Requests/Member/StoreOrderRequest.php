<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request for placing a new order
 * Validates meal selection and package choice
 */
class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'member';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mealID' => ['required', 'integer', 'exists:meals,id'],
            'partnerID' => ['required', 'integer', 'exists:partners,id'],
            'package' => ['required', 'string', 'in:1day,7days,30days'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'mealID.required' => 'Please select a meal.',
            'mealID.exists' => 'The selected meal is no longer available.',
            'partnerID.required' => 'Restaurant information is missing.',
            'partnerID.exists' => 'The selected restaurant is not available.',
            'package.required' => 'Please select a delivery package.',
            'package.in' => 'Invalid delivery package selected.',
        ];
    }
}
