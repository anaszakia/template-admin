<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;


// hanya bisa diakses tamu (belum login)
Route::middleware('guest')->group(function () {
    // Form login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
         ->name('login');

    // Proses login
    Route::post('/login', [LoginController::class, 'login'])
         ->name('login.submit');

    // Form register
    Route::get('/register', [LoginController::class, 'showRegisterForm'])
         ->name('register');

    // Proses register
    Route::post('/register', [LoginController::class, 'register'])
         ->name('register.submit');
});

// Logout (method POST demi keamanan; pakai @csrf di form logout)
Route::post('/logout', [LoginController::class, 'logout'])
     ->middleware('auth')
     ->name('logout');


// auth admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        // Tambahkan resource lain untuk admin jika diperlukan
    });

// auth user
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
        // Tambahkan resource lain untuk user jika diperlukan
    });

Route::redirect('/', '/login');
