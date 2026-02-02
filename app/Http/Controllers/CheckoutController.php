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
        $lineItems = [];

        // Handle Cart Checkout
        if ($request->has('source') && $request->source === 'cart') {
            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return redirect()->route('products.index');
            }
            foreach ($cart as $id => $details) {
                $totalAmount += $details['price'] * $details['quantity'];
                $items[] = $details;
                
                // Stripe Line Item
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $details['name'],
                        ],
                        'unit_amount' => $details['price'] * 100, // Amount in cents
                    ],
                    'quantity' => $details['quantity'],
                ];
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
            
            // Stripe Line Item
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => $request->quantity,
            ];
        }

        // Create Pending Order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending'
        ]);

        // Init Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['order_id' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', ['order_id' => $order->id]),
        ]);

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $order_id = $request->query('order_id');
        $order = \App\Models\Order::findOrFail($order_id);
        
        // Mark order as paid
        $order->update(['status' => 'paid']);

        // Reconstruct items for the view (since we don't have a sophisticated order_items table in this simple setup, we show a generic success or fetch from order if implemented)
        // For now, simple success message.
        $totalAmount = $order->total_amount;
        $items = []; // In a real app, you'd fetch $order->items

        return view('checkout.success', compact('totalAmount', 'items'));
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
}
