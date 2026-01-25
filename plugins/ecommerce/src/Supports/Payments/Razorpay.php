<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojahid
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace Mojahid\Ecommerce\Supports\Payments;

use Mojahid\Ecommerce\Abstracts\PaymentMethodAbstract;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Mojahid\Ecommerce\Models\Order;
use Illuminate\Support\Facades\Http;
use Exception;

class Razorpay extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $config = $this->getConfig();
            
            \Log::info('Razorpay Configuration', [
                'test_mode' => $config['is_test_mode'],
                'has_api_key' => !empty($config['key_id'])
            ]);

            $amount = $params['amount'];
            if (empty($amount) || (float)$amount <= 0) {
                \Log::error('Razorpay Payment Error: Invalid amount', ['amount' => $amount]);
                throw new Exception('Invalid amount. Amount must be greater than zero.');
            }

            // Convert amount to paise (smallest currency unit for INR)
            $currency = $params['currency'] ?? 'INR';
            $amountInPaise = $amount * 100;

            // Create order using Razorpay API
            $orderData = [
                'amount' => $amountInPaise,
                'currency' => $currency,
                'receipt' => $params['order_id'] ?? uniqid('order_'),
                'notes' => [
                    'order_id' => $params['order_id'] ?? uniqid('order_'),
                    'description' => $params['description'] ?? 'Order Payment'
                ]
            ];

            \Log::info('Razorpay Order Creation Request', [
                'data' => array_merge($orderData, ['key_id_length' => strlen($config['key_id'])])
            ]);

            $response = Http::timeout(30)
                ->withBasicAuth($config['key_id'], $config['key_secret'])
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.razorpay.com/v1/orders', $orderData);

            $responseData = $response->json();

            \Log::info('Razorpay Order Creation Response', [
                'status' => $response->status(),
                'order_id' => $responseData['id'] ?? null,
                'amount' => $responseData['amount'] ?? null,
                'currency' => $responseData['currency'] ?? null
            ]);

            if ($response->successful() && isset($responseData['id'])) {
                $orderId = $responseData['id'];
                
                // Create payment link using Razorpay Payment Links API
                $paymentLinkData = [
                    'amount' => $amountInPaise,
                    'currency' => $currency,
                    'accept_partial' => false,
                    'description' => $params['description'] ?? 'Order Payment',
                    'customer' => [
                        'name' => $params['customer_name'] ?? 'Customer',
                        'email' => $params['customer_email'] ?? 'customer@example.com',
                    ],
                    'notify' => [
                        'sms' => false,
                        'email' => false
                    ],
                    'reminder_enable' => false,
                    'options' => [
                        'checkout' => [
                            'name' => config('app.name', 'Store'),
                        ]
                    ],
                    'callback_url' => $params['returnUrl'] ?? url('/payment/callback/razorpay'),
                    'callback_method' => 'get'
                ];

                $linkResponse = Http::timeout(30)
                    ->withBasicAuth($config['key_id'], $config['key_secret'])
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                    ])
                    ->post('https://api.razorpay.com/v1/payment_links', $paymentLinkData);

                $linkResponseData = $linkResponse->json();

                \Log::info('Razorpay Payment Link Response', [
                    'status' => $linkResponse->status(),
                    'link_id' => $linkResponseData['id'] ?? null,
                    'short_url' => $linkResponseData['short_url'] ?? null,
                    'has_short_url' => !empty($linkResponseData['short_url'])
                ]);

                if ($linkResponse->successful() && !empty($linkResponseData['short_url'])) {
                    $this->setSuccessful(true);
                    $this->setRedirect(true);
                    $this->setRedirectURL($linkResponseData['short_url']);
                    return $this;
                }

                // Fallback: if payment link fails, create a simple checkout URL
                $checkoutUrl = $this->createCheckoutUrl($config, $responseData, $params);
                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($checkoutUrl);
                return $this;
            }

            $errorMessage = $responseData['error']['description'] ?? 'Order creation failed';
            throw new Exception($errorMessage);

        } catch (Exception $e) {
            \Log::error('Razorpay Payment Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }

    public function completed(array $params): PaymentMethodInterface
    {
        try {
            $config = $this->getConfig();

            // Handle different callback scenarios
            $paymentId = $params['razorpay_payment_id'] ?? $params['payment_id'] ?? null;
            $orderId = $params['razorpay_order_id'] ?? $params['order_id'] ?? null;
            $signature = $params['razorpay_signature'] ?? $params['signature'] ?? null;

            if (empty($paymentId)) {
                // If no payment ID, check if we have an order ID for fallback
                $orderCode = $params['order'] ?? null;
                if (!empty($orderCode)) {
                    $order = Order::whereCode($orderCode)->first();
                    if ($order) {
                        $order->payment_status = 'paid';
                        $order->save();
                        $this->setSuccessful(true);
                        return $this;
                    }
                }
                throw new Exception('No payment ID provided');
            }

            \Log::info('Razorpay Payment Verification', [
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'has_signature' => !empty($signature)
            ]);

            // Verify signature if provided
            if (!empty($signature) && !empty($orderId)) {
                $expectedSignature = hash_hmac('sha256', $orderId . "|" . $paymentId, $config['key_secret']);
                
                if ($signature !== $expectedSignature) {
                    throw new Exception('Invalid signature verification');
                }
            }

            // Fetch payment details from Razorpay
            $response = Http::timeout(30)
                ->withBasicAuth($config['key_id'], $config['key_secret'])
                ->get("https://api.razorpay.com/v1/payments/{$paymentId}");

            $paymentData = $response->json();

            \Log::info('Razorpay Payment Fetch Response', [
                'status' => $response->status(),
                'payment_status' => $paymentData['status'] ?? null,
                'amount' => $paymentData['amount'] ?? null
            ]);

            if ($response->successful() && isset($paymentData['status'])) {
                $paymentStatus = $paymentData['status'];
                
                if (in_array($paymentStatus, ['captured', 'authorized'])) {
                    $this->setSuccessful(true);
                    
                    // Update order if exists
                    if (!empty($params['order'])) {
                        $order = Order::whereCode($params['order'])->first();
                        if ($order) {
                            $order->payment_status = 'paid';
                            $order->save();
                        }
                    }
                } else {
                    $this->setSuccessful(false);
                    $this->addError('Payment not completed. Status: ' . $paymentStatus);
                }
            } else {
                $errorMessage = $paymentData['error']['description'] ?? 'Payment verification failed';
                $this->setSuccessful(false);
                $this->addError($errorMessage);
            }

            return $this;

        } catch (Exception $e) {
            \Log::error('Razorpay Completion Error', [
                'message' => $e->getMessage(),
                'params' => $params
            ]);
            
            $this->addError($e->getMessage());
            $this->setSuccessful(false);
            throw $e;
        }
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }

    private function createCheckoutUrl(array $config, array $orderData, array $params): string
    {
        // Create a simple HTML page URL with Razorpay checkout
        $checkoutParams = [
            'key' => $config['key_id'],
            'amount' => $orderData['amount'],
            'currency' => $orderData['currency'],
            'order_id' => $orderData['id'],
            'name' => config('app.name', 'Store'),
            'description' => $params['description'] ?? 'Order Payment',
            'prefill[email]' => $params['customer_email'] ?? 'customer@example.com',
            'prefill[name]' => $params['customer_name'] ?? 'Customer',
            'callback_url' => $params['returnUrl'] ?? url('/payment/callback/razorpay')
        ];

        // Return the hosted checkout URL
        return 'https://api.razorpay.com/v1/checkout/embedded?' . http_build_query($checkoutParams);
    }

    private function getConfig(): array
    {
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;

        $isTestMode = ($data['mode'] ?? 'test') === 'test';
        
        if ($isTestMode) {
            $keyId = $data['test_key_id'] ?? '';
            $keySecret = $data['test_key_secret'] ?? '';
        } else {
            $keyId = $data['live_key_id'] ?? '';
            $keySecret = $data['live_key_secret'] ?? '';
        }

        if (empty($keyId) || empty($keySecret)) {
            $errorMsg = 'Razorpay credentials not configured for ' . ($isTestMode ? 'test' : 'live') . ' mode';
            \Log::error('Razorpay Config Error', ['error' => $errorMsg]);
            throw new Exception($errorMsg);
        }

        \Log::info('Using Razorpay Credentials', [
            'mode' => $isTestMode ? 'test' : 'live',
            'key_id_prefix' => substr($keyId, 0, 10),
            'key_secret_length' => strlen($keySecret)
        ]);

        return [
            'key_id' => $keyId,
            'key_secret' => $keySecret,
            'is_test_mode' => $isTestMode
        ];
    }
}