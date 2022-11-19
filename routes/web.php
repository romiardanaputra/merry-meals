<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;

// admin route
Route::prefix('/admin')->middleware('auth', 'AuthLogin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.landing');
});

// dashboard user route
Route::prefix('/user')->middleware('auth', 'AuthLogin')->group(function () {
    Route::get('/dashboard', [LandingController::class, 'showDashboard'])->name('user.landing');
});

// registration route
Route::prefix('/register')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->middleware('guest')->name('registration.landing');
    Route::post('/', [RegisterController::class, 'store_data'])->name('registration.store');
});


// login route
Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');
});


// landing route
Route::get('/', [LandingController::class, 'index'])->name('landing.page');

//term route
Route::get('/term', function () {
    return view('components.term_condition');
})->name('term');

//contact route
Route::get('/contact', function () {
    return view('components.contactUs');
})->name('contact');

//about route
Route::get('/about', function () {
    return view('components.about');
})->name('about');

// logout route
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// donate before login route
Route::get('/donate_before_login', function () {
    return view('components.donate_before_login');
})->name('donation');
