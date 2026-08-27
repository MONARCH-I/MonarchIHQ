<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    protected ?string $secretKey;
    protected ?string $publicKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->secretKey = config('services.paystack.secret_key');
        $this->publicKey = config('services.paystack.public_key');
        $this->baseUrl   = rtrim(config('services.paystack.payment_url', 'https://api.paystack.co'), '/');
    }

    /**
     * Check if Paystack API keys are set and valid (not empty or default placeholders).
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey) &&
               !str_contains($this->secretKey, 'placeholder') &&
               !str_contains($this->secretKey, 'xxxxxxxx');
    }

    /**
     * Determine if current configured key is in test mode.
     */
    public function isTestMode(): bool
    {
        return str_starts_with($this->secretKey ?? '', 'sk_test_') ||
               str_starts_with($this->publicKey ?? '', 'pk_test_');
    }

    /**
     * Initialize a payment transaction with Paystack.
     *
     * @param array $payload
     * @return array ['success' => bool, 'authorization_url' => ?string, 'access_code' => ?string, 'reference' => ?string, 'message' => string]
     */
    public function initializePayment(array $payload): array
    {
        if (!$this->isConfigured()) {
            Log::warning('Paystack secret key is not configured. Falling back to test simulation mode.');
            return [
                'success'           => false,
                'is_mock'           => true,
                'message'           => 'Paystack API keys are not configured yet. Please add valid test keys in .env.',
                'authorization_url' => null,
                'reference'         => $payload['reference'] ?? null,
            ];
        }

        try {
            // Amount must be in minor unit (pesewas/kobo/cents): e.g. GHS 10.50 -> 1050
            $amountInMinorUnit = (int) round(($payload['amount'] ?? 0) * 100);

            $body = [
                'email'        => $payload['email'],
                'amount'       => $amountInMinorUnit,
                'currency'     => $payload['currency'] ?? 'GHS',
                'reference'    => $payload['reference'],
                'callback_url' => $payload['callback_url'] ?? route('paystack.callback'),
                'metadata'     => $payload['metadata'] ?? [],
            ];

            if (!empty($payload['channels'])) {
                $body['channels'] = $payload['channels'];
            }

            $response = Http::withToken($this->secretKey)
                ->timeout(15)
                ->acceptJson()
                ->post("{$this->baseUrl}/transaction/initialize", $body);

            $data = $response->json();

            if ($response->successful() && ($data['status'] ?? false) === true) {
                return [
                    'success'           => true,
                    'authorization_url' => $data['data']['authorization_url'] ?? null,
                    'access_code'       => $data['data']['access_code'] ?? null,
                    'reference'         => $data['data']['reference'] ?? $payload['reference'],
                    'message'           => $data['message'] ?? 'Transaction initialized',
                ];
            }

            Log::error('Paystack initialization failed', [
                'payload'  => $body,
                'response' => $data,
                'status'   => $response->status(),
            ]);

            return [
                'success'           => false,
                'message'           => $data['message'] ?? 'Unable to initialize Paystack payment.',
                'authorization_url' => null,
                'reference'         => $payload['reference'],
            ];
        } catch (\Throwable $e) {
            Log::error('Paystack transaction initialize exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success'           => false,
                'message'           => 'Could not connect to payment gateway: ' . $e->getMessage(),
                'authorization_url' => null,
                'reference'         => $payload['reference'],
            ];
        }
    }

    /**
     * Verify a transaction with Paystack by reference.
     *
     * @param string $reference
     * @return array ['success' => bool, 'paid' => bool, 'data' => ?array, 'message' => string]
     */
    public function verifyPayment(string $reference): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'paid'    => false,
                'data'    => null,
                'message' => 'Paystack API keys not configured.',
            ];
        }

        try {
            $response = Http::withToken($this->secretKey)
                ->timeout(15)
                ->acceptJson()
                ->get("{$this->baseUrl}/transaction/verify/" . rawurlencode($reference));

            $data = $response->json();

            if ($response->successful() && ($data['status'] ?? false) === true) {
                $txData = $data['data'] ?? [];
                $isPaid = ($txData['status'] ?? '') === 'success';

                return [
                    'success' => true,
                    'paid'    => $isPaid,
                    'data'    => $txData,
                    'message' => $data['message'] ?? 'Transaction verified',
                ];
            }

            Log::warning('Paystack verification returned unsuccessful status', [
                'reference' => $reference,
                'response'  => $data,
            ]);

            return [
                'success' => false,
                'paid'    => false,
                'data'    => $data['data'] ?? null,
                'message' => $data['message'] ?? 'Payment verification failed',
            ];
        } catch (\Throwable $e) {
            Log::error('Paystack verification exception', [
                'reference' => $reference,
                'error'     => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'paid'    => false,
                'data'    => null,
                'message' => 'Could not verify payment: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Validate webhook signature header from Paystack.
     */
    public function validateWebhookSignature(string $rawPayload, ?string $signature): bool
    {
        if (empty($this->secretKey) || empty($signature)) {
            return false;
        }

        $expected = hash_hmac('sha512', $rawPayload, $this->secretKey);
        return hash_equals($expected, $signature);
    }
}
