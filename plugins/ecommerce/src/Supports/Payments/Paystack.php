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

class Paystack extends PaymentMethodAbstract implements PaymentMethodInterface
{
    private array $supportedCurrencies = ['NGN', 'USD', 'GHS', 'ZAR', 'KES'];
    
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $config = $this->getConfig();
            
            \Log::info('Paystack Configuration', [
                'test_mode' => $config['is_test_mode'],
                'has_secret_key' => !empty($config['secret_key'])
            ]);

            $amount = $params['amount'];
            if (empty($amount) || (float)$amount <= 0) {
                \Log::error('Paystack Payment Error: Invalid amount', ['amount' => $amount]);
                throw new Exception('Invalid amount. Amount must be greater than zero.');
            }

            // Handle currency validation and conversion
            $currency = $this->validateAndGetCurrency($params['currency'] ?? 'NGN');
            $amountInMinorUnit = $this->convertToMinorUnit($amount, $currency);

            $initializeData = [
                'email' => $params['customer_email'] ?? 'customer@example.com',
                'amount' => $amountInMinorUnit,
                'currency' => $currency,
                'reference' => $params['order_id'] ?? uniqid('order_'),
                'callback_url' => $params['returnUrl'] ?? url('/payment/callback/paystack'),
                'metadata' => [
                    'order_id' => $params['order_id'] ?? uniqid('order_'),
                    'description' => $params['description'] ?? 'Order Payment',
                    'custom_fields' => [
                        [
                            'display_name' => 'Order ID',
                            'variable_name' => 'order_id',
                            'value' => $params['order_id'] ?? uniqid('order_'),
                        ]
                    ]
                ],
            ];

            // Add channels for better compatibility
            $initializeData['channels'] = ['card', 'bank', 'ussd', 'qr', 'mobile_money', 'bank_transfer'];

            \Log::info('Paystack Initialize Request', [
                'data' => array_merge($initializeData, ['secret_key_length' => strlen($config['secret_key'])])
            ]);

            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $config['secret_key'],
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->post('https://api.paystack.co/transaction/initialize', $initializeData);

            $responseData = $response->json();

            \Log::info('Paystack Initialize Response', [
                'status' => $response->status(),
                'success' => $responseData['status'] ?? false,
                'message' => $responseData['message'] ?? '',
                'has_authorization_url' => isset($responseData['data']['authorization_url'])
            ]);

            if ($response->successful() && ($responseData['status'] ?? false)) {
                $authorizationUrl = $responseData['data']['authorization_url'] ?? null;
                
                if (empty($authorizationUrl)) {
                    throw new Exception('No authorization URL received from Paystack');
                }

                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($authorizationUrl);
                return $this;
            }

            // Handle specific error cases
            $errorMessage = $responseData['message'] ?? 'Transaction initialization failed';
            
            if (strpos($errorMessage, 'Currency not supported') !== false) {
                // Try with NGN as fallback
                if ($currency !== 'NGN') {
                    \Log::info('Retrying with NGN currency');
                    $initializeData['currency'] = 'NGN';
                    $initializeData['amount'] = $this->convertToMinorUnit($amount, 'NGN');
                    
                    $retryResponse = Http::timeout(30)->withHeaders([
                        'Authorization' => 'Bearer ' . $config['secret_key'],
                        'Content-Type' => 'application/json',
                        'Cache-Control' => 'no-cache',
                    ])->post('https://api.paystack.co/transaction/initialize', $initializeData);

                    $retryResponseData = $retryResponse->json();
                    
                    if ($retryResponse->successful() && ($retryResponseData['status'] ?? false)) {
                        $authorizationUrl = $retryResponseData['data']['authorization_url'] ?? null;
                        
                        if ($authorizationUrl) {
                            $this->setSuccessful(true);
                            $this->setRedirect(true);
                            $this->setRedirectURL($authorizationUrl);
                            return $this;
                        }
                    }
                }
                
                throw new Exception('Currency not supported by your Paystack account. Please enable international payments or use NGN currency.');
            }

            throw new Exception($errorMessage);

        } catch (Exception $e) {
            \Log::error('Paystack Payment Error', [
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

            $reference = $params['reference'] ?? $params['trxref'] ?? null;
            
            if (empty($reference)) {
                // If no reference, check if we have an order ID for fallback
                $orderId = $params['order'] ?? null;
                if (!empty($orderId)) {
                    $order = Order::whereCode($orderId)->first();
                    if ($order) {
                        $order->payment_status = 'paid';
                        $order->save();
                        $this->setSuccessful(true);
                        return $this;
                    }
                }
                throw new Exception('No transaction reference provided');
            }

            \Log::info('Paystack Verification Request', [
                'reference' => $reference
            ]);

            // Verify transaction with Paystack
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $config['secret_key'],
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->get("https://api.paystack.co/transaction/verify/{$reference}");

            $responseData = $response->json();

            \Log::info('Paystack Verification Response', [
                'status' => $response->status(),
                'success' => $responseData['status'] ?? false,
                'transaction_status' => $responseData['data']['status'] ?? null,
                'message' => $responseData['message'] ?? ''
            ]);

            if ($response->successful() && ($responseData['status'] ?? false)) {
                $transactionData = $responseData['data'];
                $transactionStatus = $transactionData['status'] ?? '';

                if ($transactionStatus === 'success') {
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
                    $this->addError('Payment not completed. Status: ' . $transactionStatus);
                }
            } else {
                $errorMessage = $responseData['message'] ?? 'Transaction verification failed';
                $this->setSuccessful(false);
                $this->addError($errorMessage);
            }

            return $this;

        } catch (Exception $e) {
            \Log::error('Paystack Completion Error', [
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

    private function validateAndGetCurrency(string $currency): string
    {
        $currency = strtoupper($currency);
        
        // If currency is supported, return it
        if (in_array($currency, $this->supportedCurrencies)) {
            return $currency;
        }
        
        // Log unsupported currency and fallback to NGN
        \Log::warning('Unsupported currency for Paystack', [
            'requested_currency' => $currency,
            'fallback_to' => 'NGN'
        ]);
        
        return 'NGN'; // Default fallback
    }

    private function convertToMinorUnit(float $amount, string $currency): int
    {
        // All supported Paystack currencies use 2 decimal places
        // Convert to smallest unit (kobo for NGN, cents for USD, etc.)
        return (int) round($amount * 100);
    }

    private function getConfig(): array
    {
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;

        $isTestMode = ($data['mode'] ?? 'test') === 'test';
        
        if ($isTestMode) {
            $publicKey = $data['test_public_key'] ?? '';
            $secretKey = $data['test_secret_key'] ?? '';
        } else {
            $publicKey = $data['live_public_key'] ?? '';
            $secretKey = $data['live_secret_key'] ?? '';
        }

        if (empty($secretKey)) {
            $errorMsg = 'Paystack secret key not configured for ' . ($isTestMode ? 'test' : 'live') . ' mode';
            \Log::error('Paystack API Key Error', ['error' => $errorMsg]);
            throw new Exception($errorMsg);
        }

        if (empty($publicKey)) {
            $errorMsg = 'Paystack public key not configured for ' . ($isTestMode ? 'test' : 'live') . ' mode';
            \Log::error('Paystack API Key Error', ['error' => $errorMsg]);
            throw new Exception($errorMsg);
        }

        \Log::info('Using Paystack API Key', [
            'mode' => $isTestMode ? 'test' : 'live',
            'public_key_prefix' => substr($publicKey, 0, 7),
            'secret_key_prefix' => substr($secretKey, 0, 7),
            'secret_key_length' => strlen($secretKey)
        ]);

        return [
            'public_key' => $publicKey,
            'secret_key' => $secretKey,
            'is_test_mode' => $isTestMode
        ];
    }
}