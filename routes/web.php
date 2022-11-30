<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\AdminPageController;

// dashboard user route
Route::get('/user/dashboard', function () {
    return view('components.dashboard_user', [
        'title_page' => 'User Dashboard',
        'dashboard_info' => 'User Panel',
    ]);
})->middleware('roles:member,caregiver,volunteer')->name('user.dashboard');

// MealsController
Route::resource('meal', MealsController::class)->middleware('roles:admin');

// partner controller
Route::resource('partner', PartnersController::class)->middleware('roles:partner');

// admin controller
Route::resource('admin', AdminController::class)->middleware('roles:admin');
Route::controller(AdminPageController::class)->middleware('roles:admin')->group(function () {
    Route::get('/list/user', 'show_list_user')->name('admin.list.user');
    Route::get('/list/user/location', 'show_list_location')->name('admin.list.location');
});

// authentication route
Route::controller(AuthController::class)->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', 'index')->name('login')->middleware('guest');
        Route::post('/', 'authenticate')->name('login.authenticate');
    });
    Route::prefix('register')->middleware('guest')->group(function () {
        Route::get('/', 'register_index')->name('register.index');
        Route::post('/', 'store_register')->name('register.store');
    });
    Route::post('/logout', 'logout')->name('logout');
});

// UsersController
Route::controller(MemberController::class)->middleware('roles:member')->group(function () {
    Route::get('/menu', 'index')->name('member.index');
    Route::get('/menu/{id}/detail', 'show')->name('member.show');
});

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('/about', 'aboutIndex')->name('about');
    Route::get('/contact', 'contactIndex')->name('contact');
    Route::get('/term', 'termIndex')->name('term');
    Route::get('/donate', 'donationIndex')->name('donation');
});
