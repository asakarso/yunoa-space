<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ArticleController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('landingpage');
    });

    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
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

    Route::get('/self-assessment',  [AssessmentController::class, 'assessmentAttempt']);
    Route::get('/self-assessment/test', [AssessmentController::class, 'showQuestion']);
    Route::post('/self-assessment/store-result', [AssessmentController::class, 'store']);
    Route::get('/self-assessment/result', [AssessmentController::class, 'showResult'])->name('result');

    Route::get('/counseling/add', [CounselingController::class, 'showDoctors'])->name('consultation');
    Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');
    Route::post('/counseling/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('counseling.processPayment');
    Route::get('/counseling/{userId}', [PesanController::class, 'showList'])->name('counselingList');
    Route::get('/chat/{consultId}', [PesanController::class, 'showChat'])->name('chat');
    Route::post('/chat/send', [PesanController::class, 'send'])->name('chat.send');
    Route::get('/review/{consultId}', [CounselingController::class, 'reviewForm'])->name('review');
    Route::post('/review/store/{consultId}', [CounselingController::class, 'storeReview'])->name('review.store');
    Route::get('/review/edit/{reviewId}', [CounselingController::class, 'reviewForm'])->name('review.edit');
    Route::put('/review/{reviewId}', [CounselingController::class, 'editReview'])->name('review.update');

    Route::resource('journals', JournalController::class)->parameters([
        'journals' => 'id_jurnal'
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/articles/all', [ArticleController::class, 'all'])->name('articles.all');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
