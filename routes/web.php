<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\PasswordController;

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

// Admin Panel Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes from Breeze, adjusted for the admin panel
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password update route
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    // Category Management (Admin only)
    Route::middleware('role:Admin')->group(function () {
        Route::resource('categories', CategoryController::class);
    });

    // News Management (Admin, Editor, Wartawan)
    Route::middleware('role:Admin|Editor|Wartawan')->group(function () {
        Route::resource('news', NewsController::class);
    });

    // Approval Management (Admin & Editor)
    Route::middleware('role:Admin|Editor')->group(function () {
        Route::post('news/{news}/approve', [ApprovalController::class, 'approve'])->name('news.approve');
        Route::post('news/{news}/reject', [ApprovalController::class, 'reject'])->name('news.reject');
    });

});

require __DIR__.'/auth.php';
