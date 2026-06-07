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

Route::get('/search', function () {
    return view('store.search');
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
});

require __DIR__.'/auth.php';
