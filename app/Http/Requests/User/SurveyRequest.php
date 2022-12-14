<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'questionOne' => ['required'],
            'questionTwo' => ['required'],
            'questionThree' => ['required'],
            'questionFour' => ['required'],
            'questionFive' => ['required'],
            'questionSix' => ['required'],
            'questionSeven' => ['required'],
            'questionEight' => ['required'],
            'overall' => ['required'],
        ];
    }
}
