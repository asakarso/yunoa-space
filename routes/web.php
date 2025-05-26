<?php

use App\Http\Controllers\AssesmentQuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/self-assessment', function () {
    return view('assessment');
});

Route::get('/self-assessment/test', [AssesmentQuestionController::class, 'showQuestion']);