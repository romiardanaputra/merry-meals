<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\UsersController;

// landing route
Route::get('/', function () {
    return view('components.landing', [
        'title_page' => 'Landing',
    ]);
})->name('landing.index');

//term route
Route::get('/term', function () {
    return view('components.term_condition', [
        'title_page' => 'Term',
    ]);
})->name('term');

//contact route
Route::get('/contact', function () {
    return view('components.contactUs', [
        'title_page' => 'Contact'
    ]);
})->name('contact');

//about route
Route::get('/about', function () {
    return view('components.about', [
        'title_page' => 'About'
    ]);
})->name('about');

// donation route
Route::get('/donate', function () {
    return view('components.donate_before_login', [
        'title_page' => 'Donation',
    ]);
})->name('donation');

// MealsController
Route::resource('meal', MealsController::class);

// UsersController
Route::resource('user', UsersController::class);

// admin route
Route::prefix('/admin')->middleware('auth', 'AuthLogin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.landing');
});

// dashboard user route
Route::prefix('/user')->middleware('auth', 'AuthLogin')->group(function () {
    Route::get('/dashboard', [LandingController::class, 'showDashboard'])->name('user.landing');
});

// authentication route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
