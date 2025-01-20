<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;


Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})
        ->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/all-products', [ProductController::class, 'index'])
        ->name('admin.all-products');

    Route::get('/admin/add-products', [ProductController::class, 'create'])
        ->name('admin.add-products');

    Route::post('/admin/add-products/store', [ProductController::class, 'store'])
        ->name('admin.add-products.store');

    Route::get('/admin/edit-product/{id}', [ProductController::class, 'edit'])
        ->name('admin.edit-product');

    Route::put('/admin/edit-product/{id}', [ProductController::class, 'update'])
        ->name('admin.update-product');

    Route::delete('/admin/delete-product/{id}', [ProductController::class, 'destroy'])
        ->name('admin.delete-product');
});

// Customer routes

Route::get('/', [CustomerController::class, 'index'])
    ->name('customer.dashboard');

Route::get('/all-products', [CustomerController::class, 'allProducts'])
    ->name('customer.all-products');

Route::get('/product/{id}', [CustomerController::class, 'productDetail'])
    ->name('customer.product-detail');

Route::middleware(['auth', 'verified', RoleMiddleware::class . ':customer'])->group(function () {

    Route::get('/cart', [CustomerController::class, 'showCart'])
        ->name('customer.show-cart');

    Route::post('/cart/add', [CustomerController::class, 'addToCart'])
        ->name('customer.add-cart');
});
