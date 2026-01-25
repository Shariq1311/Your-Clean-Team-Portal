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

class Instamojo extends PaymentMethodAbstract implements PaymentMethodInterface
{
    public function purchase(array $params): PaymentMethodInterface
    {
        try {
            $config = $this->getConfig();
            
            \Log::info('Instamojo Configuration', [
                'test_mode' => $config['is_test_mode'],
                'has_api_key' => !empty($config['api_key']),
                'has_auth_token' => !empty($config['auth_token'])
            ]);

            $amount = $params['amount'];
            if (empty($amount) || (float)$amount <= 0) {
                throw new Exception('Invalid amount. Amount must be greater than zero.');
            }

            // Instamojo now uses the same endpoint for both test and production
            // Differentiation is handled by the API keys used
            $endpoint = 'https://www.instamojo.com/api/1.1/';

            $requestData = [
                'purpose' => $params['description'] ?? 'Order Payment',
                'amount' => (string) $amount,
                'buyer_name' => $params['customer_name'] ?? 'Customer',
                'email' => $params['customer_email'] ?? 'customer@example.com',
                'phone' => $params['customer_phone'] ?? '9999999999',
                'redirect_url' => $params['returnUrl'] ?? url('/payment/callback/instamojo'),
                'send_email' => true,
                'send_sms' => false,
                'allow_repeated_payments' => false
            ];

            \Log::info('Instamojo Payment Request', [
                'endpoint' => $endpoint,
                'params' => array_merge($requestData, ['amount' => $amount]),
                'test_mode' => $config['is_test_mode']
            ]);

            // Use Laravel's HTTP client for better reliability
            $response = Http::asForm()->withHeaders([
                'X-Api-Key' => $config['api_key'],
                'X-Auth-Token' => $config['auth_token'],
            ])->post($endpoint . 'payment-requests/', $requestData);

            if ($response->failed()) {
                $errorData = $response->json();
                $errorMessage = 'API Request Failed: ' . $response->status();
                
                if (isset($errorData['message'])) {
                    $errorMessage .= ' - ' . $errorData['message'];
                } elseif (isset($errorData['errors'])) {
                    $errorMessage .= ' - ' . json_encode($errorData['errors']);
                }
                
                \Log::error('Instamojo API Error', [
                    'status' => $response->status(),
                    'response' => $errorData,
                    'request_data' => $requestData
                ]);
                
                throw new Exception($errorMessage);
            }

            $responseBody = $response->json();

            \Log::info('Instamojo API Response', [
                'success' => $responseBody['success'] ?? false,
                'has_payment_request' => isset($responseBody['payment_request']),
                'has_longurl' => isset($responseBody['payment_request']['longurl'])
            ]);

            if (isset($responseBody['success']) && $responseBody['success'] && !empty($responseBody['payment_request']['longurl'])) {
                $this->setSuccessful(true);
                $this->setRedirect(true);
                $this->setRedirectURL($responseBody['payment_request']['longurl']);
                
                // Store payment request ID for verification
                session(['instamojo_payment_request_id' => $responseBody['payment_request']['id']]);
                
                \Log::info('Instamojo Payment Link Generated', [
                    'payment_request_id' => $responseBody['payment_request']['id'],
                    'redirect_url' => $responseBody['payment_request']['longurl']
                ]);
            } else {
                $error = $responseBody['message'] ?? 'Payment request failed';
                if (isset($responseBody['errors'])) {
                    $error .= ' - ' . json_encode($responseBody['errors']);
                }
                throw new Exception($error);
            }

            return $this;
        } catch (Exception $e) {
            \Log::error('Instamojo Payment Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
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
            $endpoint = $config['is_test_mode'] 
                ? 'https://test.instamojo.com/api/1.1/' 
                : 'https://www.instamojo.com/api/1.1/';

            $paymentRequestId = $params['payment_request_id'] ?? session('instamojo_payment_request_id');
            $paymentId = $params['payment_id'] ?? null;

            if (empty($paymentRequestId) || empty($paymentId)) {
                // Check for direct order completion
                $orderId = $params['order'] ?? null;
                $status = $params['payment_status'] ?? null;
                
                if (!empty($orderId) && ($status === 'Credit' || $status === 'successful')) {
                    $order = Order::whereCode($orderId)->first();
                    if ($order) {
                        $order->payment_status = 'paid';
                        $order->save();
                    }
                    $this->setSuccessful(true);
                    $this->setMessage('Payment completed successfully');
                    return $this;
                }
                
                throw new Exception('Missing payment request ID or payment ID for verification');
            }

            \Log::info('Instamojo Verification Request', [
                'payment_request_id' => $paymentRequestId,
                'payment_id' => $paymentId,
                'endpoint' => $endpoint
            ]);

            $response = Http::withHeaders([
                'X-Api-Key' => $config['api_key'],
                'X-Auth-Token' => $config['auth_token'],
            ])->get($endpoint . "payments/{$paymentId}/");

            if ($response->failed()) {
                $errorData = $response->json();
                $errorMessage = 'Verification failed: ' . $response->status();
                
                if (isset($errorData['message'])) {
                    $errorMessage .= ' - ' . $errorData['message'];
                }
                
                throw new Exception($errorMessage);
            }

            $responseBody = $response->json();

            \Log::info('Instamojo Verification Response', [
                'success' => $responseBody['success'] ?? false,
                'status' => $responseBody['payment']['status'] ?? null,
                'amount' => $responseBody['payment']['amount'] ?? null
            ]);

            if (isset($responseBody['success']) && $responseBody['success'] && $responseBody['payment']['status'] === 'Credit') {
                $this->setSuccessful(true);
                $this->setMessage('Payment completed successfully via Instamojo');
                
                // Update order if exists
                if (isset($responseBody['payment']['purpose'])) {
                    // Try to find order by purpose or other identifiers
                    // This depends on your specific implementation
                }
            } else {
                $this->addError('Payment verification failed or payment not credited');
                $this->setSuccessful(false);
            }

            return $this;
        } catch (Exception $e) {
            \Log::error('Instamojo Completion Error', [
                'message' => $e->getMessage(),
                'params' => $params,
                'file' => $e->getFile(),
                'line' => $e->getLine()
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

    private function getConfig(): array
    {
        $data = is_string($this->paymentMethod->data) 
            ? json_decode($this->paymentMethod->data, true) 
            : $this->paymentMethod->data;

        $isTestMode = ($data['mode'] ?? 'test') === 'test';
        
        if ($isTestMode) {
            $apiKey = $data['test_api_key'] ?? '';
            $authToken = $data['test_auth_token'] ?? '';
        } else {
            $apiKey = $data['live_api_key'] ?? '';
            $authToken = $data['live_auth_token'] ?? '';
        }

        if (empty($apiKey) || empty($authToken)) {
            $errorMsg = 'Instamojo credentials not configured for ' . ($isTestMode ? 'test' : 'live') . ' mode';
            \Log::error('Instamojo Configuration Error', [
                'error' => $errorMsg,
                'has_api_key' => !empty($apiKey),
                'has_auth_token' => !empty($authToken),
                'mode' => $isTestMode ? 'test' : 'live',
                'data_keys' => array_keys($data)
            ]);
            throw new Exception($errorMsg);
        }

        \Log::info('Instamojo Configuration Loaded', [
            'mode' => $isTestMode ? 'test' : 'live',
            'api_key_prefix' => substr($apiKey, 0, 10),
            'auth_token_prefix' => substr($authToken, 0, 10)
        ]);

        return [
            'api_key' => $apiKey,
            'auth_token' => $authToken,
            'is_test_mode' => $isTestMode
        ];
    }
}