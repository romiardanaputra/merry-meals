<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;

// admin route
Route::prefix('/admin')->middleware('auth', 'AuthLogin')->group(function(){
    Route::get('/', [AdminController::class, 'index']);
});

// dashboard user route
Route::prefix('/user')->middleware('auth', 'AuthLogin')->group(function(){
    Route::get('/dashboard', [LandingController::class, 'showDashboard']);
});

// registration route
Route::prefix('/register')->group(function(){
    Route::get('/', [RegisterController::class, 'index'])->middleware('guest');
    Route::post('/', [RegisterController::class, 'store_data']);
});


// login route
Route::prefix('/login')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
});


// landing route
Route::get('/', [LandingController::class, 'index']);

//term route
Route::get('/term', function () {
    return view('components.term_condition');
});

//contact route
Route::get('/contact', function () {
    return view('components.contactUs');
});

//about route
Route::get('/about', function () {
    return view('components.about');
});

// logout route
Route::post('/logout', [LogoutController::class, 'logout']);



