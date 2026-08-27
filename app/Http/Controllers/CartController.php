<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Show the shopping bag page.
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

        return view('store.bag', compact('items', 'subtotal'));
    }

    /**
     * Add a product to the shopping bag.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'sometimes|integer|min:1|max:99',
        ]);

        $productId = (int) $validated['product_id'];
        $qty       = (int) ($validated['quantity'] ?? 1);

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
     * Update quantity for a bag item.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:0|max:99',
        ]);

        $productId = (int) $validated['product_id'];
        $qty       = (int) $validated['quantity'];

        $cart = session('cart', []);

        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $qty;
        }

        session(['cart' => $cart]);

        $cartCount = array_sum($cart);

        // Compute updated totals
        $subtotal = 0;
        $itemLineTotal = 0;

        foreach ($cart as $pid => $q) {
            $prod = Product::find($pid);
            if ($prod) {
                $pPrice = $prod->sale_price ?? $prod->price;
                $pLine  = $pPrice * $q;
                $subtotal += $pLine;
                if ($pid === $productId) {
                    $itemLineTotal = $pLine;
                }
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'      => true,
                'productId'    => $productId,
                'quantity'     => $qty,
                'cartCount'    => $cartCount,
                'lineTotal'    => '₵' . number_format($itemLineTotal, 2),
                'rawLineTotal' => $itemLineTotal,
                'subtotal'     => '₵' . number_format($subtotal, 2),
                'rawSubtotal'  => $subtotal,
                'isEmpty'      => ($cartCount === 0),
            ]);
        }

        return back()->with('success', 'Bag updated.');
    }

    /**
     * Remove a product from the shopping bag.
     */
    public function remove(Request $request, int $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        $cartCount = array_sum($cart);

        $subtotal = 0;
        foreach ($cart as $pid => $q) {
            $prod = Product::find($pid);
            if ($prod) {
                $subtotal += ($prod->sale_price ?? $prod->price) * $q;
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success'     => true,
                'productId'   => $productId,
                'cartCount'   => $cartCount,
                'subtotal'    => '₵' . number_format($subtotal, 2),
                'rawSubtotal' => $subtotal,
                'isEmpty'     => ($cartCount === 0),
                'message'     => 'Item removed from bag.',
            ]);
        }

        return back()->with('success', 'Item removed from bag.');
    }

    /**
     * Clear the entire shopping bag.
     */
    public function clear(Request $request)
    {
        session()->forget('cart');

        if ($request->expectsJson()) {
            return response()->json([
                'success'   => true,
                'cartCount' => 0,
                'message'   => 'Bag cleared.',
            ]);
        }

        return back()->with('success', 'Your bag has been cleared.');
    }

    /**
     * Process checkout and place order.
     */
    public function checkout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Your bag is empty.'], 422);
            }
            return redirect()->route('bag.index')->with('error', 'Your bag is empty.');
        }

        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:50',
            'shipping_address' => 'required|string|max:500',
            'payment_method'   => 'nullable|string|max:100',
            'notes'            => 'nullable|string|max:1000',
        ]);

        $order = DB::transaction(function () use ($validated, $cart) {
            $subtotal = 0;
            $itemsData = [];

            foreach ($cart as $productId => $qty) {
                $product = Product::find($productId);
                if ($product) {
                    $price     = $product->sale_price ?? $product->price;
                    $lineTotal = $price * $qty;
                    $subtotal += $lineTotal;

                    $itemsData[] = [
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'unit_price' => $price,
                        'subtotal'   => $lineTotal,
                    ];
                }
            }

            // Generate unique Paystack payment reference
            $reference = 'MHQ_ORD_' . time() . '_' . strtoupper(bin2hex(random_bytes(3)));

            $order = Order::create([
                'user_id'           => auth()->id(),
                'session_id'        => session()->getId(),
                'status'            => 'pending',
                'payment_status'    => 'pending',
                'payment_method'    => 'paystack',
                'payment_reference' => $reference,
                'currency'          => 'GHS',
                'subtotal'          => $subtotal,
                'shipping'          => 0,
                'total'             => $subtotal,
                'customer_name'    => $validated['customer_name'],
                'customer_email'   => $validated['customer_email'],
                'customer_phone'   => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'notes'            => $validated['notes'] ?? null,
            ]);

            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            return $order;
        });

        // Initialize Paystack payment
        $paystack = app(\App\Services\PaystackService::class);
        $paystackInit = $paystack->initializePayment([
            'email'        => $order->customer_email,
            'amount'       => $order->total,
            'currency'     => $order->currency,
            'reference'    => $order->payment_reference,
            'callback_url' => route('paystack.callback'),
            'metadata'     => [
                'order_id'       => $order->id,
                'customer_name'  => $order->customer_name,
                'customer_phone' => $order->customer_phone,
                'items_count'    => $order->items()->count(),
                'custom_fields'  => [
                    [
                        'display_name'  => 'Order ID',
                        'variable_name' => 'order_id',
                        'value'         => '#MHQ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                    ],
                    [
                        'display_name'  => 'Customer Phone',
                        'variable_name' => 'customer_phone',
                        'value'         => $order->customer_phone,
                    ]
                ],
            ],
        ]);

        if ($paystackInit['success'] && !empty($paystackInit['authorization_url'])) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success'     => true,
                    'order_id'    => $order->id,
                    'reference'   => $order->payment_reference,
                    'redirect'    => $paystackInit['authorization_url'],
                    'message'     => 'Redirecting to Paystack payment gateway...',
                ]);
            }

            return redirect()->away($paystackInit['authorization_url']);
        }

        // If Paystack keys are not configured or offline test fallback
        if (!empty($paystackInit['is_mock'])) {
            session()->forget('cart');
            if ($request->expectsJson()) {
                return response()->json([
                    'success'     => true,
                    'order_id'    => $order->id,
                    'redirect'    => route('bag.success', $order->id),
                    'message'     => 'Order created (Test Sandbox). Please add your Paystack test keys in .env to enable live popup gateway.',
                ]);
            }

            return redirect()->route('bag.success', $order->id)
                ->with('info', 'Order registered in test mode. Configure PAYSTACK_SECRET_KEY in .env to connect to live Paystack sandbox.');
        }

        // Paystack API reported an error
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $paystackInit['message'] ?? 'Could not initialize payment gateway.',
            ], 422);
        }

        return back()->with('error', $paystackInit['message'] ?? 'Could not initialize payment gateway.');
    }

    /**
     * Order confirmation / success page.
     */
    public function orderSuccess(Order $order)
    {
        $order->load('items.product');
        return view('store.order-success', compact('order'));
    }
}
