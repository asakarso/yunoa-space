<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CounselingController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('landingpage');
    });

    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::get('/dokter/dashboard', function () {
        return view('dokter.dashboard');
    });
});

Route::middleware(['auth', 'role:Operator'])->group(function () {
    Route::get('/operator/dashboard', function () {
        return view('operator.dashboard');
    });
});

Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');

Route::middleware(['auth', 'role:Pengguna'])->group(function () {
    Route::get('/homepage', function () {
        return view('homepage');
    });

    Route::get('/self-assessment', function () {
        return view('assessment');
    });

    Route::get('/self-assessment/test', [AssessmentController::class, 'showQuestion']);

    Route::post('/self-assessment/store-result', [AssessmentController::class, 'store']);

    Route::get('/self-assessment/result', [AssessmentController::class, 'showResult']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
