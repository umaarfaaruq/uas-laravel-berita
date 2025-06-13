<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\UserDashboardController; // Pastikan ini diimpor

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // This could be a public-facing page in the future
    return view('welcome');
});

// Admin, Editor, Wartawan Panel Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Route untuk dashboard utama (yang sebelumnya /dashboard, sekarang di bawah /admin/dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute profil dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute update password
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Manajemen Kategori (Hanya Admin)
    Route::middleware('role:Admin')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // Manajemen Berita (Admin, Editor, Wartawan)
    // Pastikan NewsController memiliki logika hasAnyRole untuk memfilter berita berdasarkan user_id
    // jika yang login bukan Admin/Editor.
    Route::middleware('role:Admin|Editor|Wartawan')->group(function () {
        Route::resource('news', NewsController::class);
    });

    // Manajemen Persetujuan Berita (Admin & Editor)
    Route::middleware('role:Admin|Editor')->group(function () {
        Route::post('news/{news}/approve', [ApprovalController::class, 'approve'])->name('news.approve');
        Route::post('news/{news}/reject', [ApprovalController::class, 'reject'])->name('news.reject');
    });

});

// Dashboard Khusus untuk Peran 'User' Biasa
// Pastikan user sudah terautentikasi, terverifikasi email, dan memiliki peran 'User'
Route::middleware(['auth', 'verified', 'role:User'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});


require __DIR__.'/auth.php'; // Mengimpor rute autentikasi Laravel Breeze