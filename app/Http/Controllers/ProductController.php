<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    // PUBLIC: Homepage
    public function index() {
        $trending = Product::where('is_trending', true)->take(4)->get();
        $latest = Product::latest()->take(6)->get();
        return view('welcome', compact('trending', 'latest'));
    }

    // ADMIN: List Products
    /**
     * Display the Admin CMS product list.
     */
    public function adminIndex()
    {
        $products = \App\Models\Product::all();
        
        // Fix: Change this from 'admin.products.index' to 'admin.dashboard'
        return view('admin.dashboard', compact('products'));
    }
    
    // ADMIN: Store Product
    public function store(Request $request) {
        $request->validate(['name' => 'required', 'price' => 'required|numeric']);
        
        $path = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'price' => $request->price,
            'image' => $path
        ]);

        return back()->with('success', 'Product added successfully!');
    }
}