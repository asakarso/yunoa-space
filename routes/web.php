<?php

use App\Http\Controllers\AssesmentQuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware(['auth', 'role:Pengguna'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });

    Route::get('/self-assessment', function () {
        return view('assessment');
    });

    Route::get('/self-assessment/test', [AssesmentQuestionController::class, 'showQuestion']);
});

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman awal
Route::get('/', function () {
    return view('landingpage');
});