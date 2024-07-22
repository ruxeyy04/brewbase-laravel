<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductAdminController;
use App\Http\Controllers\incharge\InchargeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class, 'showWelcomePage'])->name('welcome');

Route::get('/login', function () {
    return view('login');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/productdetails', function () {
    return view('productdetails');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/aboutme', function () {
    return view('aboutme');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/wishlist', function () {
    return view('wishlist');
});

Route::get('/userprofile', function () {
    return view('userprofile');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/order', function () {
    return view('order');
});

Route::get('/orderdetails', function () {
    return view('orderdetails');
});


Route::prefix('brewbase-staff/admin')->group(function () {
    Route::get('/', [AdminController::class, 'homepage'])->name('admin.dashboard');
    Route::get('/products', [ProductAdminController::class, 'homepage'])->name('admin.products');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
});

Route::prefix('brewbase-staff/incharge')->group(function () {
    Route::get('/', [InchargeController::class, 'dashboard'])->name('incharge.dashboard');
    Route::get('/products', [InchargeController::class, 'products'])->name('incharge.products');
    Route::get('/orders', [InchargeController::class, 'orders'])->name('incharge.orders');
});


Route::get('/allcookie', function () {
    // Get all cookies
    $cookies = request()->cookies->all();

    // Return the cookies in JSON format
    return response()->json(['cookies' => $cookies]);
});