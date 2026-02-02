<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $modified = false;

        foreach ($cart as $id => $details) {
            if (!isset($details['price'])) {
                unset($cart[$id]);
                $modified = true;
            }
        }

        if ($modified) {
            session()->put('cart', $cart);
        }

        return view('cart');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $id = $request->product_id;
        $quantity = $request->quantity;

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $product = \App\Models\Product::findOrFail($id);
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image_url
            ];
        }

        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'message' => 'Product added to cart successfully!'
        ]);
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart', []);
            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
            }
            return response()->json(['success' => true]);
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart', []);
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['success' => true]);
        }
    }
}
