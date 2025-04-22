<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController; // <- Tambahkan ini

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman daftar produk
Route::get('/product', [ProductController::class, 'index']);

// Keranjang
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', function () {
    return view('checkout');
});
