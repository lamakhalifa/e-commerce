<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Category;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    $rooms = Category::whereNull('parent_id')
    ->with('media')
    ->get();
    return view('welcome', compact('rooms'));
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout.process');
Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.process');

});

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

