<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/services', function () {
    return view('pages.services');
});

Route::get('/projects', function () {
    return view('pages.projects');
});

// Store
Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/{slug}', [StoreController::class, 'show'])->name('store.show');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/blog', function () {
    return view('pages.blog');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/careers', function () {
    return view('pages.careers');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/settings/notifications', [App\Http\Controllers\UserSettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/settings/display',       [App\Http\Controllers\UserSettingsController::class, 'updateDisplay'])->name('settings.display');
    Route::post('/settings/address',       [App\Http\Controllers\UserSettingsController::class, 'updateAddress'])->name('settings.address');
});

Route::get('/auth/{provider}/redirect', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'callback'])->name('social.callback');

require __DIR__.'/auth.php';

