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
use App\Http\Controllers\Operator\ArticleController as OperatorArticleController;
use App\Http\Controllers\Operator\DashboardController;
use App\Http\Controllers\Operator\ArticlePreviewController;
use App\Http\Controllers\MidtransCallbackController;

// === CALLBACK MIDTRANS (TIDAK PERLU LOGIN) ===
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'callback'])->name('midtrans.callback');

// === GUEST ROUTES ===
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('landingpage'));
    
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// === ADMIN ROUTES ===
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
});

// === DOKTER ROUTES ===
Route::middleware(['auth', 'role:Dokter'])->group(function () {
    Route::view('/dokter/dashboard', 'dokter.dashboard')->name('dokter.dashboard');
});

// === OPERATOR ROUTES ===
Route::middleware(['auth', 'role:Operator'])->group(function () {
    Route::get('/operator/dashboard', [DashboardController::class, 'index'])->name('operator.dashboard');

    // CRUD artikel
    Route::resource('/operator/articles', OperatorArticleController::class)->names('operator.articles');

    // Preview artikel
    Route::get('/operator/articles/{id}/preview', [ArticlePreviewController::class, 'show'])->name('operator.articles.preview');
});

// === PENGGUNA ROUTES ===
Route::middleware(['auth', 'role:Pengguna'])->group(function () {

    // Halaman utama pengguna
    Route::view('/homepage', 'homepage')->name('homepage');

    // === SELF-ASSESSMENT ===
    Route::get('/self-assessment',  [AssessmentController::class, 'assessmentAttempt'])->name('assessment');
    Route::get('/self-assessment/test', [AssessmentController::class, 'showQuestion']);
    Route::post('/self-assessment/store-result', [AssessmentController::class, 'store'])->name('assessment.store');
    Route::get('/self-assessment/result/{asessId}', [AssessmentController::class, 'showResult'])->name('result');

    // === COUNSELING ===
    Route::get('/counseling/add', [CounselingController::class, 'showDoctors'])->name('consultation');
    Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');
    Route::post('/counseling/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('counseling.processPayment');
    Route::get('/counseling/{userId}', [PesanController::class, 'showList'])->name('counselingList');

    // === CHAT ===
    Route::get('/chat/{consultId}', [PesanController::class, 'showChat'])->name('chat');
    Route::post('/chat/send', [PesanController::class, 'send'])->name('chat.send');

    // === REVIEW ===
    Route::get('/review/{consultId}', [CounselingController::class, 'reviewForm'])->name('review');
    Route::post('/review/store/{consultId}', [CounselingController::class, 'storeReview'])->name('review.store');
    Route::get('/review/edit/{reviewId}', [CounselingController::class, 'reviewForm'])->name('review.edit');
    Route::put('/review/{reviewId}', [CounselingController::class, 'editReview'])->name('review.update');

    // === JOURNAL ===
    Route::resource('journals', JournalController::class)->parameters([
        'journals' => 'id_jurnal'
    ]);
});

// === ARTIKEL PUBLIK (LOGIN REQUIRED, SEMUA ROLE) ===
Route::middleware(['auth'])->group(function () {
    Route::get('/articles/all', [ArticleController::class, 'all'])->name('articles.all');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

