<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

// Shopping Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

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
    Route::get('/products', [ProductController::class, 'adminProducts'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    // Add these inside your Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () { ... });
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    // Add this inside the Route::middleware(['auth', 'admin'])->prefix('admin')->group(...)
    Route::patch('/products/{product}/toggle-trending', [ProductController::class, 'toggleTrending'])->name('admin.products.toggle-trending');
    
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

// Public Catalog Route with Dynamic Filtering
Route::get('/products', function (Request $request) {
    $settings = Setting::pluck('value', 'key')->toArray();
    
    // Start with active products, newest first
    $query = Product::where('status', 'active')->latest();
    
    // If a category is clicked (e.g. ?category=T-Shirts), filter the query
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
        $currentCategory = $request->category;
    } else {
        $currentCategory = 'All Collection';
    }

    // Paginate results (24 products per page)
    $products = $query->paginate(24);
    
    return view('products', compact('settings', 'products', 'currentCategory'));
})->name('products.index');