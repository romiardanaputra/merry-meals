<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\GeolocationController;
use App\Http\Controllers\Member\MemberPageController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

// dashboard user route

Route::get('/user/dashboard', function () {
    return view('components.dashboard_user',[
        'title_page' => 'User Dashboard',
        'dashboard_info' => 'User Panel',
    ]);
})->middleware('roles:member,caregiver,volunteer')->name('user.dashboard');

// admin route
Route::get('/admin/dashboard', function () {
    return view('components.admin',[
        'title_page' => 'Admin Dashboard',
        'dashboard_info' => 'Admin Pannel',
    ]);
})->middleware('roles:admin')->name('admin.dashboard');

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('/about', 'aboutIndex')->name('about');
    Route::get('/contact', 'contactIndex')->name('contact');
    Route::get('/term', 'termIndex')->name('term');
    Route::get('/donate', 'donationIndex')->name('donation');
});

// MealsController
Route::resource('meal', MealsController::class)->middleware('roles:admin');

// UsersController
Route::controller(MemberController::class)->middleware('roles:member')->group(function(){
    Route::get('/menu', 'index')->name('member.index');
    Route::get('/menu/{id}/detail', 'show')->name('member.show');
});

// partner controller
Route::resource('partner', PartnersController::class)->middleware('roles:partner');

// admin controller
Route::resource('admin', AdminController::class)->middleware('roles:admin');

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

// getting location
Route::get('ip_details', [GeolocationController::class,'ip_details'])->name('detail_geolocation');
Route::post('ip_details/store', [GeolocationController::class,'store'])->name('store_geolocation');
//stripe
Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
