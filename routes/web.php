<?php

use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Manager\ContentManagerController;
use App\Http\Controllers\Manager\EmployeeController;
use App\Http\Controllers\Manager\HrManagerController;
use App\Http\Controllers\Manager\ManagerAuthController;
use App\Http\Controllers\Manager\StoreManagerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Payment\PaystackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserSettingsController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

// ────────────────────────────────────────────────────────────────────────────
//  SEO & SITEMAP
// ────────────────────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ────────────────────────────────────────────────────────────────────────────
//  PUBLIC PAGES — Dynamic data from DB
// ────────────────────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home');
});

Route::get('/services', function () {
    return view('pages.services');
});

Route::get('/about', function () {
    return view('pages.about');
});

// Dynamic pages
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');
Route::get('/blog', [NewsController::class, 'index'])->name('blog.index');
Route::get('/careers', [CareersController::class, 'index'])->name('careers.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Legal & Info pages
Route::get('/privacy', fn () => view('pages.privacy'))->name('privacy');
Route::get('/terms', fn () => view('pages.terms'))->name('terms');
Route::get('/cookies', fn () => view('pages.cookies'))->name('cookies');
Route::get('/licenses', fn () => view('pages.licenses'))->name('licenses');
Route::get('/security', fn () => view('pages.security'))->name('security');
Route::get('/partners', fn () => view('pages.partners'))->name('partners');
Route::get('/community', fn () => view('pages.community'))->name('community');
Route::get('/divisions', fn () => view('pages.divisions'))->name('divisions');

// ────────────────────────────────────────────────────────────────────────────
//  STORE
// ────────────────────────────────────────────────────────────────────────────

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
Route::get('/payment/paystack/callback', [PaystackController::class, 'callback'])->name('paystack.callback');
Route::post('/payment/paystack/webhook', [PaystackController::class, 'webhook'])->name('paystack.webhook');
Route::get('/payment/paystack/retry/{order}', [PaystackController::class, 'retry'])->name('paystack.retry');

// Customer Orders Navigation Routes
Route::get('/orders', fn () => redirect('/dashboard#orders'))->name('orders.index');
Route::get('/orders/{order}', function (Order $order) {
    return redirect()->route('bag.success', $order->id);
})->name('orders.show');

// Legacy Cart Route Aliases & Redirects
Route::get('/cart', fn () => redirect()->route('bag.index'))->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// ────────────────────────────────────────────────────────────────────────────
//  AUTHENTICATED USER ROUTES
// ────────────────────────────────────────────────────────────────────────────

// Admin Backup Download (super_admin only)
Route::get('/monarch/backups/download/{filename}', [BackupController::class, 'download'])
    ->middleware(['auth', 'role:super_admin'])
    ->name('admin.backups.download');

Route::get('/dashboard', function () {
    $user = auth()->user();

    $orders = Order::with('items.product')
        ->where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('customer_email', $user->email);
        })
        ->latest()
        ->get();

    $totalOrders = $orders->count();
    $completedOrders = $orders->whereIn('status', ['delivered', 'completed'])->count();
    $pendingOrders = $orders->whereIn('status', ['pending', 'processing', 'shipped'])->count();
    $totalSpent = $orders->where('payment_status', 'paid')->sum('total');

    return view('dashboard', compact('orders', 'totalOrders', 'completedOrders', 'pendingOrders', 'totalSpent'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/settings/notifications', [UserSettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/settings/display', [UserSettingsController::class, 'updateDisplay'])->name('settings.display');
    Route::post('/settings/address', [UserSettingsController::class, 'updateAddress'])->name('settings.address');
});

Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

// ────────────────────────────────────────────────────────────────────────────
//  MANAGER PORTALS — ABAC Protected
// ────────────────────────────────────────────────────────────────────────────

// ── Content Manager (content_manager + super_admin) ──────────────────────────
Route::prefix('manager/content')
    ->middleware(['auth', 'role:content_manager'])
    ->name('manager.content.')
    ->group(function () {
        Route::get('/', [ContentManagerController::class, 'index'])->name('index');
        // News Articles
        Route::get('/news', [ContentManagerController::class, 'newsList'])->name('news');
        Route::get('/news/create', [ContentManagerController::class, 'newsCreate'])->name('news.create');
        Route::post('/news', [ContentManagerController::class, 'newsStore'])->name('news.store');
        Route::get('/news/{article}/edit', [ContentManagerController::class, 'newsEdit'])->name('news.edit');
        Route::put('/news/{article}', [ContentManagerController::class, 'newsUpdate'])->name('news.update');
        Route::post('/news/{article}/toggle-publish', [ContentManagerController::class, 'newsTogglePublish'])->name('news.toggle-publish');
        Route::delete('/news/{article}', [ContentManagerController::class, 'newsDestroy'])->name('news.destroy');
        // Portfolio Projects
        Route::get('/projects', [ContentManagerController::class, 'projectsList'])->name('projects');
        Route::get('/projects/create', [ContentManagerController::class, 'projectsCreate'])->name('projects.create');
        Route::post('/projects', [ContentManagerController::class, 'projectsStore'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ContentManagerController::class, 'projectsEdit'])->name('projects.edit');
        Route::put('/projects/{project}', [ContentManagerController::class, 'projectsUpdate'])->name('projects.update');
        Route::delete('/projects/{project}', [ContentManagerController::class, 'projectsDestroy'])->name('projects.destroy');
    });

// ── Store Manager (store_manager + super_admin) ───────────────────────────────
Route::prefix('manager/store')
    ->middleware(['auth', 'role:store_manager'])
    ->name('manager.store.')
    ->group(function () {
        Route::get('/', [StoreManagerController::class, 'index'])->name('index');
        // Products
        Route::get('/products', [StoreManagerController::class, 'productsList'])->name('products');
        Route::get('/products/create', [StoreManagerController::class, 'productsCreate'])->name('products.create');
        Route::post('/products', [StoreManagerController::class, 'productsStore'])->name('products.store');
        Route::get('/products/{product}/edit', [StoreManagerController::class, 'productsEdit'])->name('products.edit');
        Route::put('/products/{product}', [StoreManagerController::class, 'productsUpdate'])->name('products.update');
        Route::delete('/products/{product}', [StoreManagerController::class, 'productsDestroy'])->name('products.destroy');
        // Categories
        Route::get('/categories', [StoreManagerController::class, 'categoriesList'])->name('categories');
        Route::post('/categories', [StoreManagerController::class, 'categoriesStore'])->name('categories.store');
        Route::delete('/categories/{category}', [StoreManagerController::class, 'categoriesDestroy'])->name('categories.destroy');
        // Orders
        Route::get('/orders', [StoreManagerController::class, 'ordersList'])->name('orders');
        Route::get('/orders/{order}', [StoreManagerController::class, 'ordersShow'])->name('orders.show');
        Route::patch('/orders/{order}/status', [StoreManagerController::class, 'ordersUpdateStatus'])->name('orders.status');
    });

// ── HR Manager (hr_manager + super_admin) ─────────────────────────────────────
Route::prefix('manager/hr')
    ->middleware(['auth', 'role:hr_manager'])
    ->name('manager.hr.')
    ->group(function () {
        Route::get('/', [HrManagerController::class, 'index'])->name('index');
        // Job Listings
        Route::get('/jobs', [HrManagerController::class, 'jobsList'])->name('jobs');
        Route::get('/jobs/create', [HrManagerController::class, 'jobsCreate'])->name('jobs.create');
        Route::post('/jobs', [HrManagerController::class, 'jobsStore'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [HrManagerController::class, 'jobsEdit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [HrManagerController::class, 'jobsUpdate'])->name('jobs.update');
        Route::post('/jobs/{job}/toggle-active', [HrManagerController::class, 'jobsToggleActive'])->name('jobs.toggle-active');
        Route::delete('/jobs/{job}', [HrManagerController::class, 'jobsDestroy'])->name('jobs.destroy');
        // Contact Messages
        Route::get('/messages', [HrManagerController::class, 'messagesList'])->name('messages');
        Route::get('/messages/{message}', [HrManagerController::class, 'messagesShow'])->name('messages.show');
        Route::patch('/messages/{message}/status', [HrManagerController::class, 'messagesUpdateStatus'])->name('messages.status');
        Route::post('/messages/{message}/reply', [HrManagerController::class, 'messagesSendReply'])->name('messages.reply');
        Route::delete('/messages/{message}', [HrManagerController::class, 'messagesDestroy'])->name('messages.destroy');
    });

// ── Employee Management (super_admin + hr_manager) ────────────────────────────
Route::prefix('manager/employees')
    ->middleware(['auth', 'role:hr_manager'])
    ->name('manager.employees.')
    ->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{user}', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{user}', [EmployeeController::class, 'destroy'])->name('destroy');
    });

// ────────────────────────────────────────────────────────────────────────────
//  DEDICATED MANAGER & STAFF AUTHENTICATION
// ────────────────────────────────────────────────────────────────────────────

Route::get('/manager/login', [ManagerAuthController::class, 'create'])->name('manager.login');
Route::post('/manager/login', [ManagerAuthController::class, 'store'])->name('manager.login.store');
Route::post('/manager/logout', [ManagerAuthController::class, 'destroy'])->name('manager.logout')->middleware('auth');

// Convenience redirect: /manager → portal based on role
Route::get('/manager', function () {
    $user = auth()->user();
    if (! $user) {
        return redirect()->route('manager.login');
    }
    if ($user->isSuperAdmin() || ($user->isContentManager() && $user->role === 'content_manager')) {
        return redirect()->route('manager.content.index');
    }
    if ($user->role === 'store_manager') {
        return redirect()->route('manager.store.index');
    }
    if ($user->role === 'hr_manager') {
        return redirect()->route('manager.hr.index');
    }
    abort(403);
})->middleware(['auth'])->name('manager');

require __DIR__.'/auth.php';
