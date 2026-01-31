<?php

use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\DonationController;
use App\Http\Controllers\Pages\IndexController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'web'], function () {
  Route::get('/', [IndexController::class, 'index'])->name('index');
  Route::get('/about', [AboutController::class, 'index'])->name('about');
  Route::get('/contact', [ContactController::class, 'index'])->name('contact');

  Route::group(['prefix' => 'donation'], function () {
    Route::get('/', [DonationController::class, 'index'])->name('donation');
    Route::get('/create', [DonationController::class, 'create'])->name('donation.create');
  });

  Route::group(['prefix' => 'blog'], function(){
    Route::get('/', [BlogController::class, 'index'])->name('blog');
  });
});


require __DIR__ . '/auth.php';
