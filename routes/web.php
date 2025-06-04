<?php

use App\Http\Controllers\CounselingController;

Route::middleware(['auth'])->group(function () {
    Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');
    Route::post('/counseling/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('counseling.processPayment');
});

use Illuminate\Support\Facades\Route;

Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');

Route::get('/', function () {
    return view('welcome');
});
