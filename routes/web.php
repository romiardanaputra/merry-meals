<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\OrderController;
use App\Http\Controllers\User\PublicPageController;
use App\Http\Controllers\Partner\PartnerMealController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Partner\PartnerProfileController;
use App\Http\Controllers\Member\MemberManagementController;
use App\Http\Controllers\Member\SurveyController;
use App\Http\Controllers\Rider\RiderController as VolunteerController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\RegisterController;

// register controller
Route::resource('register',RegisterController::class)->middleware('guest');

// survey controller
Route::resource('survey',SurveyController::class)->middleware('roles:member,caregiver')->only(['index', 'store']);

// rider controller
Route::resource('volunteer',VolunteerController::class)->middleware('roles:volunteer');

// partner controller
Route::resource('partner', PartnerProfileController::class)->middleware('roles:partner');

// meal controller
Route::resource('meal', PartnerMealController::class)->middleware('roles:partner');

// admin controller
Route::get('donator/list', [UserManagementController::class, 'donatorList'])->middleware('roles:admin')->name('donator.list');
Route::resource('admin', UserManagementController::class)->middleware('roles:admin');

// order controller
Route::get('order/success', [OrderController::class, 'orderSuccess'])->name('meal.order.success');

// public page controller
Route::controller(PublicPageController::class)->group(function () {
    Route::get('/', 'index')->name('landing.index');
    Route::get('/about', 'aboutIndex')->name('about');
    Route::get('/contact', 'contactIndex')->name('contact');
    Route::get('/term', 'termIndex')->name('term');
    Route::get('/donate', 'donationIndex')->name('donation');
});

//  member  controller
Route::controller(MemberManagementController::class)->middleware('roles:member,donor')->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('package/{id}', 'packageFood')->name('meal.package');
        Route::get('survey', 'serviceSurvey')->name('member.survey');
        Route::get('menu', 'menuMealShow')->name('meal.menu');
        Route::get('menu/detail/{id}', 'menuDetailShow')->name('meal.detail');
    });
    Route::resource('member', MemberManagementController::class);
});

// authentication route
Route::controller(UserAuthController::class)->group(function () {
    Route::get('login', 'index')->middleware('guest')->name('login');
    Route::post('login', 'authenticate')->name('login.authenticate');
    Route::post('logout', 'logout')->name('logout');
});

//stripe
Route::get('donation', [StripeController::class, 'stripe'])->name('donation.form');
Route::post('donation', [StripeController::class, 'stripePost'])->name('donation.post');

