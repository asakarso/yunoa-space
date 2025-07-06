<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\Admin\PaymentVerificationController;

// --- Rute untuk Pengguna yang Belum Login (Guest) ---
Route::get('/', function () { return view('landingpage'); })->name('landing');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// --- Rute untuk Semua Pengguna yang Sudah Login ---
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/counseling/add', [ConsultationController::class, 'index'])->name('consultation.index');

    // --- GRUP RUTE KHUSUS ADMIN ---
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
        Route::get('/payments/verify', [PaymentVerificationController::class, 'index'])->name('payments.index');
        Route::post('/payments/approve/{payment}', [PaymentVerificationController::class, 'approve'])->name('payments.approve');
    });

    // --- GRUP RUTE KHUSUS DOKTER ---
    Route::middleware('role:Dokter')->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', function () { return view('dokter.dashboard'); })->name('dashboard');
    });

    // --- GRUP RUTE KHUSUS OPERATOR ---
    Route::middleware('role:Operator')->prefix('operator')->name('operator.')->group(function () {
        Route::get('/dashboard', function () { return view('operator.dashboard'); })->name('dashboard');
    });

    // --- GRUP RUTE KHUSUS PENGGUNA ---
    Route::middleware('role:Pengguna')->group(function () {
        Route::get('/homepage', function () { return view('homepage'); })->name('homepage');

        Route::prefix('self-assessment')->name('assessment.')->group(function() {
            Route::get('/', function () { return view('assessment'); })->name('index');
            Route::get('/test', [AssessmentController::class, 'showQuestion'])->name('test');
            Route::post('/store-result', [AssessmentController::class, 'store'])->name('store');
            Route::get('/result', [AssessmentController::class, 'showResult'])->name('result');
        });

        Route::prefix('counseling')->name('counseling.')->group(function () {
            // PERBAIKAN: Rute statis didefinisikan SEBELUM rute dinamis
            Route::get('/payment/verifying', function () { return view('counseling.verifying'); })->name('verifying');
            
            Route::get('/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('payment');
            Route::post('/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('processPayment');
            Route::post('/verify-payment', [CounselingController::class, 'verifyPayment'])->name('verifyPayment'); 
            Route::get('/list/{userId}', [PesanController::class, 'showList'])->name('list');
        });

        Route::prefix('chat')->name('chat.')->group(function () {
            Route::get('/{userId}', [PesanController::class, 'showChat'])->name('show');
            Route::post('/send', [PesanController::class, 'send'])->name('send');
        });

        Route::resource('journals', JournalController::class)->parameters(['journals' => 'id_jurnal']);
    });

});