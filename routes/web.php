<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;





Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');// Route to the admin dashboard (handled by AdminController)


// Additional admin dashboard route that loads products and orders
Route::get('/admin', [AdminController::class, 'admin'])->name('admin');


// Fix-password example route
Route::get('/fix-password', function () {
    $newHashedPassword = Hash::make('admin123');
    return ['new_hashed_password' => $newHashedPassword];
});
// Product routes
Route::get('/produits', [ProductController::class, 'index'])->name('produits.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');


// Order routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Assuming you want a view of orders
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create'); // Assuming an order creation page
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store'); // Store order data

// Admin-specific routes for order handling
Route::post('/admin/orders/store', [AdminController::class, 'storeOrder'])->name('admin.orders.store'); // Admin-only order storage logic

