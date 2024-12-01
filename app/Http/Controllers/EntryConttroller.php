<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MattDaneshvar\Survey\Models\Entry;
use MattDaneshvar\Survey\Models\Survey;

class EntryConttroller extends Controller
{
    public function create()
    {
        $survey = $this->survey();

        return view('survey.Demosurvey', ['survey' => $survey]);
    }

    public function store(Request $request , Survey $survey)
    {

        // $survey = $this->survey();
        $answers = $request->validate($request, $survey->rules);

        (new Entry)->for($survey)->fromArray($answers)->push();
    }

    protected function survey()
    {
        return Survey::where(['name' => 'Cat Population Survey'])->first();
    }
}
