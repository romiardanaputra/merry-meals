<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Member\MemberManagementController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Partner\PartnerMealController;
use App\Http\Controllers\Partner\PartnerProfileController;

// partner controller
Route::resource('partner', PartnerProfileController::class)->middleware('roles:partner');

// meal controller
Route::resource('meal', PartnerMealController::class)->middleware('roles:partner,member');

// admin controller
Route::resource('admin', UserManagementController::class)->middleware('roles:admin');

//  member  controller
Route::controller(MemberManagementController::class)->middleware('roles:member')->prefix('member/meal/')->group(function () {
    Route::get('package', 'packageFood')->name('meal.package');
    Route::get('menu', 'menuMealShow')->name('meal.menu');
    Route::get('{id}/detail', 'menuDetailShow')->name('meal.detail');
    Route::resource('member', MemberManagementController::class );
});

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('about', 'aboutIndex')->name('about')->middleware('guest');
    Route::get('contact', 'contactIndex')->name('contact');
    Route::get('term', 'termIndex')->name('term')->middleware('guest');
    Route::get('donate', 'donationIndex')->name('donation');
});

// authentication route
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate')->name('login.authenticate');
    Route::get('register', 'registerIndex')->name('register.index')->middleware('guest');
    Route::post('register', 'storeRegister')->name('register.store')->middleware('guest');
    Route::post('logout', 'logout')->name('logout');
});

//order controller
Route::get('/test', [OrderController::class, 'index'])->middleware('roles:member');
// getting location
Route::get('ip_details', [GeolocationController::class,'ip_details'])->name('detail_geolocation');
Route::post('ip_details/store', [GeolocationController::class,'store'])->name('store_geolocation');

//stripe
Route::get('donation', [StripeController::class, 'stripe']);
Route::post('donation', [StripeController::class, 'stripePost'])->name('donation.post');
