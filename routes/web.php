<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Partner\PartnerMealController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Member\MemberManagementController;

// partner controller
Route::resource('partner', PartnerProfileController::class)->middleware('roles:partner');

// meal controller
Route::resource('meal', PartnerMealController::class)->middleware('roles:partner,member');

// admin controller
Route::resource('admin', UserManagementController::class)->middleware('roles:admin');

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('/about', 'aboutIndex')->name('about');
    Route::get('/contact', 'contactIndex')->name('contact');
    Route::get('/term', 'termIndex')->name('term');
    Route::get('/donate', 'donationIndex')->name('donation');
});

//  member  controller
Route::controller(MemberManagementController::class)->middleware('roles:member')->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('package/{id}', 'packageFood')->name('meal.package');
        Route::get('order/success', 'orderSuccess')->name('meal.order.success');
        Route::get('survey', 'serviceSurvey')->name('member.survey');
        Route::get('menu', 'menuMealShow')->name('meal.menu');
        Route::get('menu/detail/{id}', 'menuDetailShow')->name('meal.detail');
    });
    Route::resource('member', MemberManagementController::class);
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



//stripe
Route::get('donation', [StripeController::class, 'stripe']);
Route::post('donation', [StripeController::class, 'stripePost'])->name('donation.post');
