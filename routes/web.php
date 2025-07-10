<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\DoctorRegisterController;
use App\Http\Controllers\Auth\DoctorStatusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Operator\ArticleController as OperatorArticleController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\ArticlePreviewController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DoctorVerificationController;


Route::get('/', fn() => view('landingpage'))->name('landing');
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'callback'])->name('midtrans.callback');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/register/doctor', [DoctorRegisterController::class, 'showRegistrationForm'])->name('register.doctor');
    Route::post('/register/doctor', [DoctorRegisterController::class, 'register'])->name('register.doctor.submit');
    Route::get('/register/doctor/status', [DoctorStatusController::class, 'show'])->name('register.doctor.status');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
    Route::get('/articles/all', [ArticleController::class, 'all'])->name('articles.all');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserManagementController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::get('/doctors/verification', [DoctorVerificationController::class, 'index'])->name('doctors.verification');
    Route::get('/doctors/verification/{doctor}', [DoctorVerificationController::class, 'show'])->name('doctors.show');
    Route::post('/doctors/verify/{doctor}', [DoctorVerificationController::class, 'verify'])->name('doctors.verify');
    Route::delete('/doctors/reject/{doctor}', [DoctorVerificationController::class, 'reject'])->name('doctors.reject');
    // Route untuk message dihapus
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::view('/dashboard', 'dokter.dashboard')->name('dashboard');
});

Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');
    Route::resource('/articles', OperatorArticleController::class);
    Route::get('/articles/{id}/preview', [ArticlePreviewController::class, 'show'])->name('articles.preview');
});

Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::view('/homepage', 'homepage')->name('homepage');
    Route::get('/self-assessment', [AssessmentController::class, 'assessmentAttempt'])->name('assessment');
    Route::get('/self-assessment/test', [AssessmentController::class, 'showQuestion']);
    Route::post('/self-assessment/store-result', [AssessmentController::class, 'store'])->name('assessment.store');
    Route::get('/self-assessment/result/{asessId}', [AssessmentController::class, 'showResult'])->name('result');
    Route::get('/consultation/add', [CounselingController::class, 'showDoctors'])->name('consultation');
    Route::get('/counseling/payment/{doctor_id}', [CounselingController::class, 'showPayment'])->name('counseling.payment');
    Route::post('/counseling/payment/{doctor_id}', [CounselingController::class, 'processPayment'])->name('counseling.processPayment');
    Route::get('/counseling/list/{userId}', [PesanController::class, 'showList'])->name('counselingList');
    Route::get('/chat/{consultId}', [PesanController::class, 'showChat'])->name('chat');
    Route::post('/chat/send', [PesanController::class, 'send'])->name('chat.send');
    Route::get('/review/{consultId}', [CounselingController::class, 'reviewForm'])->name('review');
    Route::post('/review/store/{consultId}', [CounselingController::class, 'storeReview'])->name('review.store');
    Route::get('/review/edit/{reviewId}', [CounselingController::class, 'reviewForm'])->name('review.edit');
    Route::put('/review/{reviewId}', [CounselingController::class, 'editReview'])->name('review.update');
    Route::resource('journals', JournalController::class)->parameters(['journals' => 'id_jurnal']);
});