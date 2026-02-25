<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // 1. View the Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // 2. Add Item to Cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // Default to the first available size/color if not specified on the grid
        $size = $request->size ?? ($product->sizes[0] ?? 'Default');
        $color = $request->color ?? ($product->colors[0] ?? 'Default');
        
        // Create a unique cart key so different sizes of the same shirt don't merge
        $cartKey = $product->id . '_' . $size . '_' . $color;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $request->quantity,
                'size' => $size,
                'color' => $color
            ];
        }

        session()->put('cart', $cart);
        return back()->with('cart_success', $product->name . ' was added to your cart!');
    }

    // 3. Update Item Quantity
    public function update(Request $request)
    {
        if($request->cart_key && $request->quantity) {
            $cart = session()->get('cart');
            if(isset($cart[$request->cart_key])) {
                $cart[$request->cart_key]['quantity'] = max(1, $request->quantity); // Prevent going below 1
                session()->put('cart', $cart);
            }
            return back()->with('cart_success', 'Cart updated successfully!');
        }
    }

    // 4. Remove Item from Cart
    public function remove(Request $request)
    {
        if($request->cart_key) {
            $cart = session()->get('cart');
            if(isset($cart[$request->cart_key])) {
                unset($cart[$request->cart_key]);
                session()->put('cart', $cart);
            }
            return back()->with('cart_success', 'Item removed from cart!');
        }
    }
}