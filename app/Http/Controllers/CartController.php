<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show the cart page.
     */
    public function index()
    {
        $cart  = session('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if ($product) {
                $price       = $product->sale_price ?? $product->price;
                $lineTotal   = $price * $qty;
                $subtotal   += $lineTotal;
                $items[]     = [
                    'product'   => $product,
                    'qty'       => $qty,
                    'price'     => $price,
                    'lineTotal' => $lineTotal,
                ];
            }
        }

        return view('store.cart', compact('items', 'subtotal'));
    }

    /**
     * Add a product to the session cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'sometimes|integer|min:1|max:99',
        ]);

        $productId = $validated['product_id'];
        $qty       = $validated['quantity'] ?? 1;

        $cart = session('cart', []);
        $cart[$productId] = ($cart[$productId] ?? 0) + $qty;
        session(['cart' => $cart]);

        $cartCount = array_sum($cart);

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'cartCount' => $cartCount,
                'message'   => 'Added to bag!',
            ]);
        }

        return back()->with('success', 'Item added to your bag!');
    }

    /**
     * Update quantity for a cart item.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:0|max:99',
        ]);

        $productId = $validated['product_id'];
        $qty       = $validated['quantity'];

        $cart = session('cart', []);

        if ($qty === 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $qty;
        }

        session(['cart' => $cart]);

        if ($request->expectsJson()) {
            $subtotal = 0;
            foreach ($cart as $pid => $q) {
                $product  = Product::find($pid);
                $subtotal += ($product->sale_price ?? $product->price) * $q;
            }
            return response()->json([
                'success'   => true,
                'cartCount' => array_sum($cart),
                'subtotal'  => '₵' . number_format($subtotal, 2),
            ]);
        }

        return back();
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request, int $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'cartCount' => array_sum($cart)]);
        }

        return back()->with('success', 'Item removed from bag.');
    }

    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Your bag has been cleared.');
    }
}
