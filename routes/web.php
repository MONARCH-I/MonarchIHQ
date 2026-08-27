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

// Shopping Bag & Checkout
Route::get('/bag', [CartController::class, 'index'])->name('bag.index');
Route::post('/bag/add', [CartController::class, 'add'])->name('bag.add');
Route::patch('/bag/update', [CartController::class, 'update'])->name('bag.update');
Route::delete('/bag/remove/{productId}', [CartController::class, 'remove'])->name('bag.remove');
Route::post('/bag/clear', [CartController::class, 'clear'])->name('bag.clear');
Route::post('/bag/checkout', [CartController::class, 'checkout'])->name('bag.checkout');
Route::get('/bag/success/{order}', [CartController::class, 'orderSuccess'])->name('bag.success');

// Paystack Payment Routes
Route::get('/payment/paystack/callback', [\App\Http\Controllers\Payment\PaystackController::class, 'callback'])->name('paystack.callback');
Route::post('/payment/paystack/webhook', [\App\Http\Controllers\Payment\PaystackController::class, 'webhook'])->name('paystack.webhook');
Route::get('/payment/paystack/retry/{order}', [\App\Http\Controllers\Payment\PaystackController::class, 'retry'])->name('paystack.retry');

// Customer Orders Navigation Routes
Route::get('/orders', fn() => redirect('/dashboard#orders'))->name('orders.index');
Route::get('/orders/{order}', function (\App\Models\Order $order) {
    return redirect()->route('bag.success', $order->id);
})->name('orders.show');

// Admin Backup Download Route
Route::get('/monarch/backups/download/{filename}', [\App\Http\Controllers\Admin\BackupController::class, 'download'])
    ->middleware(['auth'])
    ->name('admin.backups.download');

// Legacy Cart Route Aliases & Redirects
Route::get('/cart', fn() => redirect()->route('bag.index'))->name('cart.index');
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
    $user = auth()->user();

    // Fetch user orders by user_id OR customer_email
    $orders = \App\Models\Order::with('items.product')
        ->where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
        })
        ->latest()
        ->get();

    $totalOrders     = $orders->count();
    $completedOrders = $orders->whereIn('status', ['delivered', 'completed'])->count();
    $pendingOrders   = $orders->whereIn('status', ['pending', 'processing', 'shipped'])->count();
    $totalSpent      = $orders->where('payment_status', 'paid')->sum('total');

    return view('dashboard', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'totalSpent'));
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

