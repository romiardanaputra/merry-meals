<?php

namespace App\Http\Controllers\Member;

use App\Models\Survey;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SurveyRequest;

class SurveyController extends Controller
{
    public function index()
    {
        return view('components.survey', [
            'title_page' => 'survey'
        ]);
    }

    public function create(){
        return view('components.test', [
            'title_page' => 'survey'
        ]);
    }

    public function store(SurveyRequest $request)
    {
        $survey = $request->validated();
        $survey['userID'] = auth()->user()->id;
        Survey::create($survey);
    }
}
