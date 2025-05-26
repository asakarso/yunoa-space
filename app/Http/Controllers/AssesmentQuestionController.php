<?php

namespace App\Http\Controllers;

use App\Models\AssesmentQuestion;
use App\Models\AssesmentQuestions;
use Illuminate\Http\Request;

class AssesmentQuestionController extends Controller
{
    public function showQuestion(){
        $pertanyaan = AssesmentQuestion::pluck('pertanyaan')->toArray();
        return view('test', compact('pertanyaan'));
    }
}
