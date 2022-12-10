<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicPageController;
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
<<<<<<< HEAD
    Route::get('/about', 'aboutIndex')->name('about');
    Route::get('/contact', 'contactIndex')->name('contact');
    Route::get('/term', 'termIndex')->name('term');
    Route::get('/donate', 'donationIndex')->name('donation');
});

// MealsController
Route::resource('meal', MealsController::class)->middleware('roles:admin,partner');

// partner controller
Route::resource('partner', PartnersController::class)->middleware('roles:partner');

// admin controller
<<<<<<< Updated upstream
Route::resource('admin', AdminController::class)->middleware('roles:admin');
Route::resource('partner_handler', PartnerHandlerController::class)->middleware('roles:admin');

// admin page controller
Route::controller(AdminPageController::class)->middleware('roles:admin')->group(function () {
    Route::get('list/user', 'show_list_user')->name('admin.list.user');
    Route::get('list/user/location', 'show_list_location')->name('admin.list.location');
});

// dashboard member route
Route::controller(MemberPageController::class)->middleware('roles:member')->prefix('member')->group(function () {
    Route::get('dashboard', 'index')->name('member.dashboard');
    Route::get('menu/package', 'package_food')->name('member.menu.package');
    Route::get('menu', 'show_menu')->name('meal.menu');
    Route::get('menu/{id}/detail', 'show_menu_detail')->name('member.show');
=======
Route::resource('admin', UserManagementController::class)->middleware('roles:admin');

//  member  controller
Route::controller(MemberManagementController::class)->middleware('roles:member')->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('package', 'packageFood')->name('meal.package');
        Route::get('menu', 'menuMealShow')->name('meal.menu');
        Route::get('detail/{id}', 'menuDetailShow')->name('meal.detail');
    });
    Route::resource('member', MemberManagementController::class);
>>>>>>> Stashed changes
});

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index')->middleware('guest');
=======
>>>>>>> 30fcb838942d82c689d7430a4bc4e73578ed1d3f
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
