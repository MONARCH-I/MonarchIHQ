<?php

use App\Models\Order;
use App\Models\User;
use App\Services\PaystackService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

test('paystack service initializes payment with correct payload and headers', function () {
    config([
        'services.paystack.secret_key' => 'sk_test_1234567890abcdef',
        'services.paystack.public_key' => 'pk_test_1234567890abcdef',
        'services.paystack.payment_url' => 'https://api.paystack.co',
    ]);

    Http::fake([
        'https://api.paystack.co/transaction/initialize' => Http::response([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => [
                'authorization_url' => 'https://checkout.paystack.com/0123456789',
                'access_code' => '0123456789',
                'reference' => 'MHQ_TEST_REF_001',
            ],
        ], 200),
    ]);

    $service = new PaystackService;
    expect($service->isConfigured())->toBeTrue();
    expect($service->isTestMode())->toBeTrue();

    $result = $service->initializePayment([
        'email' => 'test@monarchi.com.gh',
        'amount' => 150.00,
        'currency' => 'GHS',
        'reference' => 'MHQ_TEST_REF_001',
    ]);

    expect($result['success'])->toBeTrue();
    expect($result['authorization_url'])->toBe('https://checkout.paystack.com/0123456789');
    expect($result['reference'])->toBe('MHQ_TEST_REF_001');
});

test('paystack callback marks order as paid when transaction is verified', function () {
    config([
        'services.paystack.secret_key' => 'sk_test_1234567890abcdef',
        'services.paystack.public_key' => 'pk_test_1234567890abcdef',
        'services.paystack.payment_url' => 'https://api.paystack.co',
    ]);

    $order = Order::create([
        'payment_reference' => 'MHQ_TEST_REF_PAID_01',
        'status' => 'pending',
        'payment_status' => 'pending',
        'payment_method' => 'paystack',
        'currency' => 'GHS',
        'total' => 250.00,
        'customer_name' => 'Test Customer',
        'customer_email' => 'customer@example.com',
        'customer_phone' => '+233500000000',
        'shipping_address' => 'Accra, Ghana',
    ]);

    Http::fake([
        'https://api.paystack.co/transaction/verify/*' => Http::response([
            'status' => true,
            'message' => 'Verification successful',
            'data' => [
                'status' => 'success',
                'reference' => 'MHQ_TEST_REF_PAID_01',
                'amount' => 25000,
                'channel' => 'mobile_money',
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ],
        ], 200),
    ]);

    $response = $this->get(route('paystack.callback', ['reference' => 'MHQ_TEST_REF_PAID_01']));
    $response->assertRedirect(route('bag.success', $order->id));

    $order->refresh();
    expect($order->payment_status)->toBe('paid');
    expect($order->status)->toBe('processing');
    expect($order->payment_channel)->toBe('mobile_money');
    expect($order->paid_at)->not()->toBeNull();
});

test('paystack webhook marks order as paid with valid signature', function () {
    $secret = 'sk_test_secret_webhook_123';
    config(['services.paystack.secret_key' => $secret]);

    $order = Order::create([
        'payment_reference' => 'MHQ_WEBHOOK_REF_01',
        'status' => 'pending',
        'payment_status' => 'pending',
        'payment_method' => 'paystack',
        'currency' => 'GHS',
        'total' => 500.00,
        'customer_name' => 'Webhook Customer',
        'customer_email' => 'webhook@example.com',
    ]);

    $payload = json_encode([
        'event' => 'charge.success',
        'data' => [
            'reference' => 'MHQ_WEBHOOK_REF_01',
            'status' => 'success',
            'channel' => 'card',
            'metadata' => [
                'order_id' => $order->id,
            ],
        ],
    ]);

    $signature = hash_hmac('sha512', $payload, $secret);

    $response = $this->call(
        'POST',
        route('paystack.webhook'),
        [],
        [],
        [],
        ['HTTP_X_PAYSTACK_SIGNATURE' => $signature, 'CONTENT_TYPE' => 'application/json'],
        $payload
    );

    $response->assertStatus(200);

    $order->refresh();
    expect($order->payment_status)->toBe('paid');
    expect($order->payment_channel)->toBe('card');
});

test('user dashboard displays their paid and placed orders', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $order = Order::create([
        'user_id' => $user->id,
        'payment_reference' => 'MHQ_DASHBOARD_TEST_01',
        'status' => 'processing',
        'payment_status' => 'paid',
        'payment_method' => 'paystack',
        'payment_channel' => 'mobile_money',
        'currency' => 'GHS',
        'total' => 1200.00,
        'customer_name' => $user->name,
        'customer_email' => $user->email,
        'shipping_address' => 'Accra Digital Centre',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertStatus(200);
    $response->assertSee('#MHQ-'.str_pad($order->id, 5, '0', STR_PAD_LEFT));
    $response->assertSee('1,200.00');
    $response->assertSee('Paid (Mobile money)');
});
