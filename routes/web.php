<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TermController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\RegisterController;



// registration route
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store_data']);

// login route
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);

// landing route
Route::get('/', [LandingController::class, 'index']);

// terms and condition route
Route::get('/term_condition', [TermController::class, 'index']);

//about route
Route::get('/term', function () {
    return view('components.term_condition');
});

Route::get('/logout', [LogoutController::class, 'logout']);



