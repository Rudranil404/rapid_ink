<?php

use App\Http\Controllers\ProductController;

// Storefront
Route::get('/', [ProductController::class, 'index']);

// Auth Routes (Handled by Breeze)
require __DIR__.'/auth.php';

// Admin CMS - Protected by 'auth' and our custom 'admin' middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [ProductController::class, 'adminIndex'])->name('admin.dashboard');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
});
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// The route Breeze looks for after login
Route::get('/dashboard', function () {
    // If the user is an admin, send them to the Admin CMS
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // If it's a normal customer, send them back to the storefront
    return redirect('/');
})->middleware(['auth'])->name('dashboard');