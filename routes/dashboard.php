<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\UserType;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth' , 'auth.check:admin,super_admin'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {
    Route::get('/profile' , [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile' , [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'force_delete'])->name('categories.force-delete');
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products' , ProductsController::class);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth' , 'auth.check:admin,super_admin'])->name('dashboard');