<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $totalAmount = 0;
        $items = [];

        // Handle Cart Checkout
        if ($request->has('source') && $request->source === 'cart') {
            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('products.index');
            }
            foreach ($cart as $id => $details) {
                $totalAmount += $details['price'] * $details['quantity'];
                $items[] = $details;
            }
            session()->forget('cart');
        } 
        // Handle Single Product Buy Now
        else {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);
            $product = \App\Models\Product::findOrFail($request->product_id);
            $totalAmount = $product->price * $request->quantity;
            $items[] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image_url
            ];
        }

        \App\Models\Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'paid'
        ]);

        return view('checkout.success', compact('items', 'totalAmount'));
    }

    public function success()
    {
        return view('checkout.success');
    }
}
