<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request for submitting service feedback survey
 * Validates all survey questions and overall rating
 */
class StoreSurveyRequest extends FormRequest
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
            'q1' => ['required', 'string', 'max:1000'],
            'q2' => ['required', 'string', 'max:1000'],
            'q3' => ['required', 'string', 'max:1000'],
            'q4' => ['required', 'string', 'max:1000'],
            'q5' => ['required', 'string', 'max:1000'],
            'q6' => ['required', 'string', 'max:1000'],
            'q7' => ['required', 'string', 'max:1000'],
            'q8' => ['required', 'string', 'max:1000'],
            'overall' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'q*.required' => 'Please answer all questions.',
            'overall.required' => 'Please provide an overall rating.',
            'overall.min' => 'Rating must be between 1 and 5.',
            'overall.max' => 'Rating must be between 1 and 5.',
        ];
    }
}
