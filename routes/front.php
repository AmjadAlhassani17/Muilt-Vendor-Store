<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\Information\FAQController;
use App\Http\Controllers\Front\CheckOut\CheckOutController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthController;
use App\Http\Controllers\Front\Information\AboutUsController;
use App\Http\Controllers\Front\Information\ContactUsController;

Route::group([
    'middleware' => ['auth'],
    'as' => 'front.',
], function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::resource('/cart' , CartController::class)->except(['show' , 'create' , 'edit']);
    Route::get('/checkout', [CheckOutController::class , 'index'])->name('checkout');
    Route::post('/checkout', [CheckOutController::class , 'store'])->name('checkout.store');
    Route::get('/auth/user/2FA',[TwoFactorAuthController::class, 'index'])->name('two-factor-auth');
    Route::get('/FAQ',[FAQController::class, 'index'])->name('FAQ');
    Route::get('/ContactUs',[ContactUsController::class, 'index'])->name('ContactUs');
    Route::get('/AboutUs',[AboutUsController::class, 'index'])->name('AboutUs');
});