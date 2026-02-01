<?php

use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\DonationController;
use App\Http\Controllers\Pages\IndexController;
use App\Http\Controllers\Pages\DocsController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Member\MemberManagementController;
use App\Http\Controllers\Partner\PartnerMealController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {
    // Shared Dashboard Redirect (if using '/dashboard')
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === User::ROLE_SUPERADMIN) return redirect('superadmin/dashboard');
        if ($user->role === User::ROLE_ADMIN) return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
        if ($user->role === User::ROLE_PARTNER) return redirect(RouteServiceProvider::PARTNER_DASHBOARD);
        if ($user->role === User::ROLE_DRIVER) return redirect('driver/dashboard');
        return redirect(RouteServiceProvider::MEMBER_DASHBOARD);
    })->name('dashboard');

    // Superadmin Routes
    Route::middleware('roles:superadmin')->prefix('superadmin')->group(function () {
        Route::get('/dashboard', function () { return view('features.superadmin.dashboard'); })->name('superadmin.dashboard');
    });

    // Admin Routes
    Route::middleware('roles:admin')->prefix('admin')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('admin.index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('admin.create');
        Route::post('/store', [UserManagementController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.edit');
        Route::put('/update/{id}', [UserManagementController::class, 'update'])->name('admin.update');
        Route::delete('/destroy/{id}', [UserManagementController::class, 'destroy'])->name('admin.destroy');
        Route::get('/donator-list', [UserManagementController::class, 'donatorList'])->name('donator.list');

        // New Partner Management
        Route::get('/partners', [\App\Http\Controllers\Admin\PartnerController::class, 'index'])->name('admin.partners.index');
        Route::post('/partners/approve/{id}', [\App\Http\Controllers\Admin\PartnerController::class, 'approve'])->name('admin.partners.approve');
        Route::post('/partners/reject/{id}', [\App\Http\Controllers\Admin\PartnerController::class, 'reject'])->name('admin.partners.reject');
        Route::delete('/partners/destroy/{id}', [\App\Http\Controllers\Admin\PartnerController::class, 'destroy'])->name('admin.partners.destroy');

        // New Order Oversight
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::post('/orders/assign/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'assignRider'])->name('admin.orders.assign');
        Route::post('/orders/status/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.status');

        // New Reports & Analytics
        Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
    });

    // Member Routes
    Route::middleware('roles:member')->prefix('member')->group(function () {
        Route::get('/dashboard', [MemberManagementController::class, 'index'])->name('member.dashboard');
        Route::get('/survey', [MemberManagementController::class, 'surveyShow'])->name('member.survey');
        Route::post('/survey', [MemberManagementController::class, 'surveyStore'])->name('member.survey.store');
    });

    // Partner Routes
    Route::middleware('roles:partner')->prefix('partner')->group(function () {
        Route::get('/', function () { return view('features.partner.dashboard'); })->name('partner.index');
    });

    // Driver Routes
    Route::middleware('roles:driver')->prefix('driver')->group(function () {
        Route::get('/dashboard', function () { return view('features.rider.dashboard'); })->name('driver.dashboard');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Meal & Menu Routes
    Route::name('meal.')->group(function () {
        Route::get('/menu', [MemberManagementController::class, 'menuMealShow'])->name('menu');
        Route::get('/meal/{id}', [MemberManagementController::class, 'menuDetailShow'])->name('detail');
        Route::get('/package/{id}', [MemberManagementController::class, 'packageFood'])->name('package');
        Route::get('/order-success', function () { return view('features.meals.orderSuccess'); })->name('order.success');
        
        // Meal Management (Partner/Admin)
        Route::get('/meals', [PartnerMealController::class, 'index'])->name('index');
        Route::get('/meals/create', [PartnerMealController::class, 'create'])->name('create');
        Route::post('/meals/store', [PartnerMealController::class, 'store'])->name('store');
        Route::get('/meals/edit/{id}', [PartnerMealController::class, 'edit'])->name('edit');
        Route::put('/meals/update/{id}', [PartnerMealController::class, 'update'])->name('update');
        Route::delete('/meals/destroy/{id}', [PartnerMealController::class, 'destroy'])->name('destroy');
    });
});

Route::group(['middleware' => 'web'], function () {
  Route::get('/', [IndexController::class, 'index'])->name('index');
  Route::get('/about', [AboutController::class, 'index'])->name('about');
  Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
  Route::get('/docs', [DocsController::class, 'index'])->name('docs');

  Route::group(['prefix' => 'donation'], function () {
    Route::get('/', [DonationController::class, 'index'])->name('donation');
    Route::get('/create', [DonationController::class, 'create'])->name('donation.create');
  });

  Route::group(['prefix' => 'blog'], function(){
    Route::get('/', [BlogController::class, 'index'])->name('blog');
  });
});


require __DIR__ . '/auth.php';
