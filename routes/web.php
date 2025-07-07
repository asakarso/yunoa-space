<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ArticleController; // untuk publik
use App\Http\Controllers\Operator\ArticleController as OperatorArticleController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Operator\ArticlePreviewController;

// GUEST ROUTES 
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('landingpage'));

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// ADMIN ROUTES
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
});

// DOKTER ROUTES
Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::view('/dokter/dashboard', 'dokter.dashboard')->name('dokter.dashboard');
});

// OPERATOR ROUTES
Route::middleware(['auth', 'role:Operator'])->group(function () {
    Route::get('/operator/dashboard', [DashboardController::class, 'index'])->name('operator.dashboard');

    // CRUD artikel
    Route::resource('/operator/articles', OperatorArticleController::class)->names('operator.articles');

    // Preview artikel
    Route::get('/operator/articles/{id}/preview', [ArticlePreviewController::class, 'show'])->name('operator.articles.preview');
});

// PENGGUNA ROUTES
Route::middleware(['auth', 'role:Pengguna'])->group(function () {
    Route::view('/homepage', 'homepage')->name('homepage');
    Route::view('/self-assessment', 'assessment')->name('assessment');

    // Self Assessment
    Route::get('/self-assessment/test', [AssessmentController::class, 'showQuestion']);
    Route::post('/self-assessment/store-result', [AssessmentController::class, 'store']);
    Route::get('/self-assessment/result', [AssessmentController::class, 'showResult']);

    // Counseling
    Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');
    Route::post('/counseling/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('counseling.processPayment');
    Route::get('/counseling/{userId}', [PesanController::class, 'showList'])->name('counselingList');
    Route::get('/counseling/add', [ConsultationController::class, 'index'])->name('consultation');

    // Chat
    Route::get('/chat/{userId}', [PesanController::class, 'showChat'])->name('chat');
    Route::post('/chat/send', [PesanController::class, 'send'])->name('chat.send');

    // Journal
    Route::resource('journals', JournalController::class)->parameters([
        'journals' => 'id_jurnal'
    ]);
});

// ROUTE ARTIKEL PUBLIK (boleh dilihat semua pengguna login)
Route::middleware(['auth'])->group(function () {
    Route::get('/articles/all', [ArticleController::class, 'all'])->name('articles.all');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
