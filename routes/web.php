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

    // Superadmin Routes - Complete namespace isolation
    Route::middleware('roles:superadmin')->prefix('superadmin')->name('superadmin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Superadmin\SuperadminController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', \App\Http\Controllers\Superadmin\UserController::class);
        
        // Partner Management
        Route::get('/partners', [\App\Http\Controllers\Superadmin\PartnerController::class, 'index'])->name('partners.index');
        Route::get('/partners/{partner}', [\App\Http\Controllers\Superadmin\PartnerController::class, 'show'])->name('partners.show');
        Route::post('/partners/{partner}/approve', [\App\Http\Controllers\Superadmin\PartnerController::class, 'approve'])->name('partners.approve');
        Route::post('/partners/{partner}/reject', [\App\Http\Controllers\Superadmin\PartnerController::class, 'reject'])->name('partners.reject');
        Route::post('/partners/{partner}/suspend', [\App\Http\Controllers\Superadmin\PartnerController::class, 'suspend'])->name('partners.suspend');
        Route::delete('/partners/{partner}', [\App\Http\Controllers\Superadmin\PartnerController::class, 'destroy'])->name('partners.destroy');
        
        // Order Management
        Route::get('/orders', [\App\Http\Controllers\Superadmin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [\App\Http\Controllers\Superadmin\OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/assign', [\App\Http\Controllers\Superadmin\OrderController::class, 'assignDriver'])->name('orders.assign');
        Route::patch('/orders/{order}/status', [\App\Http\Controllers\Superadmin\OrderController::class, 'updateStatus'])->name('orders.status');
        Route::post('/orders/{order}/cancel', [\App\Http\Controllers\Superadmin\OrderController::class, 'cancel'])->name('orders.cancel');
        
        // Donation Management
        Route::get('/donations', [\App\Http\Controllers\Superadmin\DonationController::class, 'index'])->name('donations.index');
        Route::get('/donations/export', [\App\Http\Controllers\Superadmin\DonationController::class, 'export'])->name('donations.export');
        Route::get('/donations/{donation}', [\App\Http\Controllers\Superadmin\DonationController::class, 'show'])->name('donations.show');
        
        // Reports & Analytics
        Route::get('/reports', [\App\Http\Controllers\Superadmin\ReportController::class, 'index'])->name('reports.index');
        
        // Profile Management
        Route::get('/profile', [\App\Http\Controllers\Superadmin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [\App\Http\Controllers\Superadmin\ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [\App\Http\Controllers\Superadmin\ProfileController::class, 'updatePassword'])->name('profile.password');
        
        // Settings
        Route::get('/settings', [\App\Http\Controllers\Superadmin\SuperadminController::class, 'settings'])->name('settings');
        Route::put('/settings', [\App\Http\Controllers\Superadmin\SuperadminController::class, 'updateSettings'])->name('settings.update');
    });


    // Admin Routes (accessible by superadmin and admin)
    Route::middleware('roles:superadmin,admin')->prefix('admin')->group(function () {
        // Dashboard Overview
        Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // User Management
        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users.index');
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
    Route::middleware('roles:member')->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberManagementController::class, 'index'])->name('dashboard');
        Route::get('/survey', [MemberManagementController::class, 'surveyShow'])->name('survey');
        Route::post('/survey', [MemberManagementController::class, 'surveyStore'])->name('survey.store');
        
        // Member Meals - Browse & Order
        Route::prefix('meals')->name('meals.')->group(function () {
            Route::get('/', [MemberManagementController::class, 'menuMealShow'])->name('menu');
            Route::get('/{id}', [MemberManagementController::class, 'menuDetailShow'])->name('detail');
            Route::get('/{id}/package', [MemberManagementController::class, 'packageFood'])->name('package');
            Route::post('/order', [MemberManagementController::class, 'store'])->middleware('throttle:orders')->name('order');
            Route::get('/order/success', function () { return view('features.member.meals.success'); })->name('order.success');
        });
    });

    // Partner Routes
    Route::middleware('roles:partner')->prefix('partner')->name('partner.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Partner\PartnerDashboardController::class, 'index'])->name('index');
        Route::get('/orders', [\App\Http\Controllers\Partner\PartnerOrderController::class, 'index'])->name('orders.index');
        Route::post('/orders/status/{id}', [\App\Http\Controllers\Partner\PartnerOrderController::class, 'update'])->name('orders.update');
        
        // Partner Profile
        Route::get('/partner-profile/create', [\App\Http\Controllers\Partner\PartnerProfileController::class, 'create'])->name('create');
        Route::post('/partner-profile/store', [\App\Http\Controllers\Partner\PartnerProfileController::class, 'store'])->name('store');
        Route::get('/partner-profile', [\App\Http\Controllers\Partner\PartnerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/partner-profile', [\App\Http\Controllers\Partner\PartnerProfileController::class, 'update'])->name('profile.update');
        
        // Partner Meals - CRUD Management
        Route::prefix('meals')->name('meals.')->group(function () {
            Route::get('/', [PartnerMealController::class, 'index'])->name('index');
            Route::get('/create', [PartnerMealController::class, 'create'])->name('create');
            Route::post('/', [PartnerMealController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PartnerMealController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PartnerMealController::class, 'update'])->name('update');
            Route::delete('/{id}', [PartnerMealController::class, 'destroy'])->name('destroy');
        });
    });

    // Driver Routes
    Route::middleware('roles:driver')->prefix('driver')->name('driver.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Rider\RiderController::class, 'index'])->name('dashboard');
        Route::post('/availability', [\App\Http\Controllers\Rider\RiderController::class, 'toggleAvailability'])->name('availability.toggle');
        Route::patch('/delivery/{id}/status', [\App\Http\Controllers\Rider\RiderController::class, 'updateDeliveryStatus'])->name('delivery.status');
    });

    // Profile Routes (shared across roles)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/docs', [DocsController::class, 'index'])->name('docs');
    Route::get('/term', function() { return view('term'); })->name('term');

    // SEO
    Route::get('/sitemap.xml', [\App\Http\Controllers\SeoController::class, 'sitemap'])->name('sitemap');

    Route::group(['prefix' => 'donation'], function () {
        Route::get('/', [DonationController::class, 'index'])->name('donation');
        Route::get('/create', [DonationController::class, 'create'])->name('donation.create');
    });

    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog');
    });
});

require __DIR__ . '/auth.php';
