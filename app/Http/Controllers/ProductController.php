<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Storefront index
    public function index()
    {
        $products = Product::where('status', 'active')->get();
        return view('welcome', compact('products'));
    }

    // Admin Dashboard list
    // Admin Dashboard (Now just for stats)
    public function adminIndex()
    {
        // We will just pass the total count for the stats card
        $productCount = Product::count();
        return view('admin.dashboard', compact('productCount'));
    }

    // Admin Products List Page
    public function adminProducts()
    {
        // Fetch all products, newest first
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }
    // Show Create Product Form
    public function create()
    {
        return view('admin.products.create');
    }

    // Store New Product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'images' => 'max:10',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'status' => $request->status ?? 'active',
            'is_trending' => $request->has('is_trending'),
            'sizes' => $request->sizes ?? [],
            'colors' => $request->colors ?? [],
            'images' => $imagePaths,
            'image' => $imagePaths[0] ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully!');
    }

    // Delete Product
    public function destroy(Product $product)
    {
        // 1. Delete the images from the server storage so they don't take up space
        if (!empty($product->images)) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        } elseif ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // 2. Delete the product from the database
        $product->delete();

        // 3. return back() smoothly reloads the current page you clicked delete from!
        return back()->with('success', 'Product deleted successfully!');
    }
    // Show Edit Product Form
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update Existing Product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'images' => 'max:10',
        ]);

        // Handle Image Uploads if new images are provided
        $imagePaths = $product->images ?? []; 
        if ($request->hasFile('images')) {
            // Optional: You could delete old images here if you want to replace them entirely,
            // or just append them. For simplicity, we'll replace them here.
            if (!empty($product->images)) {
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }

        // Update the product
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id, // keep slug unique
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'status' => $request->status ?? 'active',
            'is_trending' => $request->has('is_trending'),
            'sizes' => $request->sizes ?? [],
            'colors' => $request->colors ?? [],
            'images' => $imagePaths,
            'image' => $imagePaths[0] ?? $product->image, // Keep old main image if no new ones
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }
}