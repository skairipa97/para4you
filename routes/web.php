<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Hash;


// Basic routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Authentication routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Product routes - public
Route::get('/produits', [ProductController::class, 'index'])->name('produits.index');

// Routes that require authentication
Route::middleware([\App\Http\Middleware\AuthCustom::class])->group(function () {
    // Cart and checkout routes
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    // Profile routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::post('/update-profile', [LoginController::class, 'updateProfile'])->name('update-profile');
    
    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Admin routes with auth and admin middleware
Route::middleware([\App\Http\Middleware\AuthCustom::class, \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // Admin dashboard
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    
    // Admin product management
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    
    // Admin order management
    Route::post('/admin/orders/store', [AdminController::class, 'storeOrder'])->name('admin.orders.store');
    Route::patch('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    Route::get('/admin/orders/{id}/details', [AdminController::class, 'getOrderDetails'])->name('admin.orders.details');
    Route::get('/admin/stats', [AdminController::class, 'getDashboardStats'])->name('admin.stats');
});

// Test route to check session
Route::get('/check-session', function () {
    return [
        'user_id' => session('user_id'),
        'username' => session('username'),
        'name' => session('name'),
        'email' => session('email'),
        'is_admin' => session('is_admin'),
        'session_data' => session()->all()
    ];
});

