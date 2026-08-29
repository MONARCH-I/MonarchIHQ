<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    protected PaystackService $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Handle Paystack payment verification callback.
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference') ?? $request->query('trxref');

        if (! $reference) {
            return redirect()->route('bag.index')->with('error', 'No payment reference received. Transaction could not be verified.');
        }

        // Find the order by payment reference
        $order = Order::where('payment_reference', $reference)->first();

        // Verify with Paystack API
        $verification = $this->paystack->verifyPayment($reference);

        if ($verification['paid'] && ($verification['data'] ?? false)) {
            $data = $verification['data'];
            $channel = $data['channel'] ?? 'card/momo';

            if (! $order && isset($data['metadata']['order_id'])) {
                $order = Order::find($data['metadata']['order_id']);
            }

            if ($order) {
                $order->markAsPaid($channel, $data);
            }

            // Clear shopping bag
            session()->forget('cart');

            $orderId = $order ? $order->id : null;
            if ($orderId) {
                return redirect()->route('bag.success', $orderId)
                    ->with('success', 'Payment successful! Thank you for your purchase.');
            }

            return redirect()->route('store.index')
                ->with('success', 'Payment verified successfully!');
        }

        // Payment failed or was cancelled
        if ($order) {
            $order->markAsFailed($verification['data'] ?? null);
        }

        return redirect()->route('bag.index')
            ->with('error', 'Payment was not completed or failed verification. Please try again.');
    }

    /**
     * Retry payment for an existing unpaid order.
     */
    public function retry(Order $order)
    {
        if ($order->isPaid()) {
            return redirect()->route('bag.success', $order->id)->with('info', 'This order has already been paid.');
        }

        // Create new unique reference
        $reference = 'MHQ_RETRY_'.$order->id.'_'.bin2hex(random_bytes(4));
        $order->update(['payment_reference' => $reference]);

        $init = $this->paystack->initializePayment([
            'email' => $order->customer_email,
            'amount' => $order->total,
            'currency' => $order->currency,
            'reference' => $reference,
            'callback_url' => route('paystack.callback'),
            'metadata' => [
                'order_id' => $order->id,
                'customer_name' => $order->customer_name,
                'customer_phone' => $order->customer_phone,
            ],
        ]);

        if ($init['success'] && ! empty($init['authorization_url'])) {
            return redirect()->away($init['authorization_url']);
        }

        return back()->with('error', $init['message'] ?? 'Could not initialize payment gateway.');
    }

    /**
     * Handle Paystack Webhook events (e.g. charge.success).
     */
    public function webhook(Request $request)
    {
        $signature = $request->header('X-Paystack-Signature') ?? $request->header('x-paystack-signature');
        $rawBody = $request->getContent();

        if (! $this->paystack->validateWebhookSignature($rawBody, $signature)) {
            Log::warning('Paystack webhook signature verification failed.');

            return response()->json(['status' => false, 'message' => 'Invalid signature'], 400);
        }

        $event = json_decode($rawBody, true);
        if (! $event) {
            return response()->json(['status' => false, 'message' => 'Invalid JSON payload'], 400);
        }

        $eventName = $event['event'] ?? '';
        $data = $event['data'] ?? [];

        Log::info('Paystack webhook received', ['event' => $eventName, 'reference' => $data['reference'] ?? null]);

        if ($eventName === 'charge.success') {
            $reference = $data['reference'] ?? null;
            $orderId = $data['metadata']['order_id'] ?? null;

            $order = null;
            if ($reference) {
                $order = Order::where('payment_reference', $reference)->first();
            }
            if (! $order && $orderId) {
                $order = Order::find($orderId);
            }

            if ($order && ! $order->isPaid()) {
                $channel = $data['channel'] ?? 'card/momo';
                $order->markAsPaid($channel, $data);
                Log::info("Order #{$order->id} marked as paid via Paystack webhook");
            }
        }

        return response()->json(['status' => true, 'message' => 'Webhook handled successfully'], 200);
    }
}
