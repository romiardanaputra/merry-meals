<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// admin route
Route::get('/admin/dashboard', function(){
    return view('components.admin');
})->middleware(['auth', 'isAdmin'])->name('admin.dashboard');

// dashboard user route
Route::get('/user/dashboard', function(){
    return view('components.dashboard_user');
})->middleware(['auth', 'isUser'])->name('user.dashboard');

// MealsController
Route::resource('meal', MealsController::class)->middleware(['auth', 'isAdmin']);

// UsersController
Route::resource('user', UsersController::class);

// authentication route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
