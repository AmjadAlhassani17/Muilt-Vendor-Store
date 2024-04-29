<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOut\CheckOutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ProductController;

Route::group([
    'middleware' => ['auth'],
    'as' => 'front.',
], function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::resource('/cart' , CartController::class)->except(['show' , 'create' , 'edit']);
    Route::get('/checkout', [CheckOutController::class , 'index'])->name('checkout');
    Route::post('/checkout', [CheckOutController::class , 'store'])->name('checkout.store');
});