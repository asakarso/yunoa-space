<?php

use App\Http\Controllers\CounselingController;

use Illuminate\Support\Facades\Route;

Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');

Route::get('/', function () {
    return view('welcome');
});
