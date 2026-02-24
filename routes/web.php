<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;

// Storefront
Route::get('/', [ProductController::class, 'index']);
Route::get('/', [ProductController::class, 'index'])->name('home');
// Auth Routes (Handled by Breeze)
require __DIR__.'/auth.php';

// Admin CMS - Protected by 'auth' and our custom 'admin' middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ProductController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/homepage-settings', [SettingController::class, 'editHomepage'])->name('admin.settings.homepage');
    Route::post('/homepage-settings', [SettingController::class, 'updateHomepage'])->name('admin.settings.homepage.update');
    // Product Management
    // Updated this route to point to the 'create' method so it loads the Add Product page
    Route::get('/products', [ProductController::class, 'create'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    
    // Added DELETE route for destroying products
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// Helper route to redirect /admin to the actual dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// The route Breeze looks for after login
Route::get('/dashboard', function () {
    // If the user is an admin, send them to the Admin CMS
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // If it's a normal customer, send them back to the storefront
    return redirect('/');
})->middleware(['auth'])->name('dashboard');