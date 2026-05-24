<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'home'])->name('store.home');
Route::get('/shop/products', [StoreController::class, 'products'])->name('store.products');
Route::post('/checkout', [StoreController::class, 'checkout'])->middleware('auth')->name('store.checkout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/products', [AdminController::class, 'productsPage'])->name('admin.products');
    Route::get('/admin/products/data', [AdminController::class, 'productsData'])->name('admin.products.data');
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    Route::get('/admin/categories', [AdminController::class, 'categoriesPage'])->name('admin.categories');
    Route::get('/admin/categories/data', [AdminController::class, 'categoriesData'])->name('admin.categories.data');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    Route::get('/admin/customers', [AdminController::class, 'customersPage'])->name('admin.customers');
    Route::get('/admin/customers/data', [AdminController::class, 'customersData'])->name('admin.customers.data');
    Route::post('/admin/customers', [AdminController::class, 'storeCustomer'])->name('admin.customers.store');
    Route::put('/admin/customers/{id}', [AdminController::class, 'updateCustomer'])->name('admin.customers.update');
    Route::delete('/admin/customers/{id}', [AdminController::class, 'destroyCustomer'])->name('admin.customers.destroy');

    Route::get('/admin/orders', [AdminController::class, 'ordersPage'])->name('admin.orders');
    Route::get('/admin/orders/data', [AdminController::class, 'ordersData'])->name('admin.orders.data');
    Route::post('/admin/orders', [AdminController::class, 'storeOrder'])->name('admin.orders.store');
    Route::put('/admin/orders/{id}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('/admin/orders/{id}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
});

require __DIR__.'/auth.php';
