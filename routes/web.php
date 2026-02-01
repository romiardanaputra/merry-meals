<?php

use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\DonationController;
use App\Http\Controllers\Pages\IndexController;
use App\Http\Controllers\Pages\DocsController;
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
        Route::get('/', function () { return view('features.admin.dashboard', ['dashboard_info' => 'Admin Panel']); })->name('admin.index');
        // Add more admin routes here (Manage User, Donator List, etc.)
    });

    // Member Routes
    Route::middleware('roles:member')->prefix('member')->group(function () {
        Route::get('/menu', function () { return view('features.member.dashboard'); })->name('member.menu');
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
