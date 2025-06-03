<?php

use App\Http\Controllers\AssessmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JournalController;


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



    Route::middleware(['auth'])->group(function () {
        Route::resource('journals', JournalController::class)->parameters([
            'journals' => 'id_jurnal'
        ]);
});



// // Semua route yang butuh autentikasi (tanpa role spesifik)
// Route::middleware(['auth'])->group(function () {
//     // Resource journals dengan parameter id_jurnal
//     Route::resource('journals', JournalController::class)->parameters([
//         'journals' => 'id_jurnal'
//     ]);
//     Route::get('/journal/history', [JournalController::class, 'history'])->name('journal.history');
    // Route logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

