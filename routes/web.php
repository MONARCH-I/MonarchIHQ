<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/store', function () {
    return view('store.store');
});

Route::get('/cart', function () {
    return view('store.cart');
});

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
