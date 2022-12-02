<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\PartnerHandlerController;
use App\Http\Controllers\Member\MemberPageController;


// MealsController
Route::resource('meal', MealsController::class)->middleware('roles:admin');

// partner controller
Route::resource('partner', PartnersController::class)->middleware('roles:partner');

// admin controller
Route::resource('admin', AdminController::class)->middleware('roles:admin');
Route::resource('partner_handler', PartnerHandlerController::class)->middleware('roles:admin');

// admin page controller
Route::controller(AdminPageController::class)->middleware('roles:admin')->group(function () {
    Route::get('list/user', 'show_list_user')->name('admin.list.user');
    Route::get('list/user/location', 'show_list_location')->name('admin.list.location');
});

// dashboard user route
Route::controller(MemberPageController::class)->middleware('roles:member')->group(function () {
    Route::get('member/dashboard', 'index')->name('member.dashboard');
    // Route::get('user/menu', 'show_menu')->name('meal.menu');
    Route::get('menu/{id}/detail', 'show_menu_detail')->name('member.show');
});

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('about', 'aboutIndex')->name('about');
    Route::get('contact', 'contactIndex')->name('contact');
    Route::get('term', 'termIndex')->name('term');
    Route::get('donate', 'donationIndex')->name('donation');
});

// authentication route
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate')->name('login.authenticate');
    Route::get('register', 'register_index')->name('register.index')->middleware('guest');
    Route::post('register', 'store_register')->name('register.store')->middleware('guest');
    Route::post('logout', 'logout')->name('logout');
});

