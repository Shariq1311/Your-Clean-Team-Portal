<?php

namespace Mojahid\Ecommerce\Supports\Manager;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Mojahid\Ecommerce\Models\Currency;

class CurrencyManager
{
    protected ?string $currentCurrencyCode = null;
    protected ?Currency $currentCurrency = null;

    /**
     * Returns the user's current currency code, from session or fallback to default.
     */
    public function getCurrentCurrencyCode(): string
    {
        // If already set in memory
        if ($this->currentCurrencyCode) {
            return $this->currentCurrencyCode;
        }

        // If in session
        $sessionCode = Session::get('mc_current_currency');
        if ($sessionCode) {
            $currency = Currency::where('code', $sessionCode)->where('is_enabled', true)->first();
            if ($currency) {
                $this->currentCurrencyCode = $sessionCode;
                $this->currentCurrency = $currency;
                return $this->currentCurrencyCode;
            }
        }

        // Auto detect by IP if enabled
        if (get_config('ecomm_auto_detect_currency', false)) {
            $detectedCode = $this->detectCurrencyByIP();
            if ($detectedCode) {
                $currency = Currency::where('code', $detectedCode)->where('is_enabled', true)->first();
                if ($currency) {
                    $this->setCurrentCurrencyCode($detectedCode);
                    return $detectedCode;
                }
            }
        }

        // Fallback to default
        $defaultCurrency = Currency::default()->first();
        if ($defaultCurrency) {
            $this->currentCurrencyCode = $defaultCurrency->code;
            $this->currentCurrency = $defaultCurrency;
            return $this->currentCurrencyCode;
        }

        // Ultimate fallback
        $this->currentCurrencyCode = 'USD';
        return 'USD';
    }

    /**
     * Get current currency object
     */
    public function getCurrentCurrency(): ?Currency
    {
        if (!$this->currentCurrency) {
            $this->getCurrentCurrencyCode();
        }
        return $this->currentCurrency;
    }

    /**
     * Allows user or system to override the currency code (for currency switchers).
     */
    public function setCurrentCurrencyCode(string $code): void
    {
        $currency = Currency::where('code', $code)->where('is_enabled', true)->first();

        if ($currency) {
            $this->currentCurrencyCode = $code;
            $this->currentCurrency = $currency;
            Session::put('mc_current_currency', $code);
        }
    }

    /**
     * Convert a base price to the selected currency.
     */
    public function convertPrice(float $basePrice, ?string $toCurrency = null): float
    {
        $toCurrency = $toCurrency ?: $this->getCurrentCurrencyCode();

        $currency = Currency::where('code', $toCurrency)->where('is_enabled', true)->first();

        if (!$currency) {
            // Fallback to default
            $currency = Currency::default()->first();
            if (!$currency) {
                return $basePrice; // Return original if no currency found
            }
        }

        return $currency->convertFromBase($basePrice);
    }

    /**
     * Format an amount with symbol, decimal places, etc.
     */
    public function formatPrice(float $amount, ?string $currencyCode = null): string
    {
        $currencyCode = $currencyCode ?: $this->getCurrentCurrencyCode();
        $currency = Currency::where('code', $currencyCode)->first();

        if (!$currency) {
            // Fallback to default
            $currency = Currency::default()->first();
            if (!$currency) {
                // Ultimate fallback
                return '$' . number_format($amount, 2);
            }
        }

        return $currency->formatPrice($amount);
    }

    /**
     * Convert and format price in one call
     */
    public function convertAndFormatPrice(float $basePrice, ?string $currencyCode = null): string
    {
        $converted = $this->convertPrice($basePrice, $currencyCode);
        return $this->formatPrice($converted, $currencyCode);
    }

    /**
     * If store wants to force final checkout in a single currency, e.g. default.
     */
    public function getCheckoutCurrencyCode(): string
    {
        $force = get_config('ecomm_force_checkout_currency');
        if (!empty($force)) {
            return $force;
        }
        return $this->getCurrentCurrencyCode();
    }

    /**
     * Get all available currencies for switcher
     */
    public function getAvailableCurrencies(): array
    {
        return Currency::active()->get()->map(function ($currency) {
            return [
                'code' => $currency->code,
                'name' => $currency->full_display_name,
                'symbol' => $currency->symbol,
                'is_current' => $currency->code === $this->getCurrentCurrencyCode(),
            ];
        })->toArray();
    }

    /**
     * Detect currency by IP address
     */
    protected function detectCurrencyByIP(): ?string
    {
        try {
            $ip = request()->ip();
            if (!$ip || $ip === '127.0.0.1') {
                return null;
            }

            // Simple IP to country mapping (you can use a service like ipapi.com)
            $response = file_get_contents("http://ip-api.com/json/{$ip}");
            $data = json_decode($response, true);

            if ($data && isset($data['currency'])) {
                return $data['currency'];
            }
        } catch (\Exception $e) {
            Log::warning('Failed to detect currency by IP: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Cron or schedule for auto updating exchange rates from an external API.
     */
    public function updateExchangeRatesAutomatically(): void
    {
        if (!get_config('ecomm_auto_update_exchange', false)) {
            return;
        }

        $api = get_config('ecomm_exchange_rate_api');
        $apiKey = get_config('ecomm_exchange_rate_api_key');

        if (!$apiKey) {
            Log::warning('Exchange rate API key not configured');
            return;
        }

        try {
            if ($api === 'api_layer') {
                $this->updateViaApiLayer($apiKey);
            } elseif ($api === 'open_exchange') {
                $this->updateViaOpenExchange($apiKey);
            }
        } catch (\Exception $e) {
            Log::error('Failed to update exchange rates: ' . $e->getMessage());
        }
    }

    private function updateViaApiLayer(string $apiKey): void
    {
        $baseCurrency = Currency::default()->first();
        if (!$baseCurrency) {
            return;
        }

        $currencies = Currency::where('is_enabled', true)->where('code', '!=', $baseCurrency->code)->get();
        
        foreach ($currencies as $currency) {
            try {
                $url = "https://api.apilayer.com/fixer/convert?from={$baseCurrency->code}&to={$currency->code}&amount=1";
                $response = file_get_contents($url, false, stream_context_create([
                    'http' => [
                        'header' => "apikey: {$apiKey}\r\n"
                    ]
                ]));

                $data = json_decode($response, true);
                if ($data && isset($data['result'])) {
                    $currency->update(['exchange_rate' => $data['result']]);
                }
            } catch (\Exception $e) {
                Log::warning("Failed to update rate for {$currency->code}: " . $e->getMessage());
            }
        }

        set_config('ecomm_exchange_rate_last_updated', now()->toDateString());
    }

    private function updateViaOpenExchange(string $apiKey): void
    {
        $baseCurrency = Currency::default()->first();
        if (!$baseCurrency) {
            return;
        }

        try {
            $url = "https://openexchangerates.org/api/latest.json?app_id={$apiKey}&base={$baseCurrency->code}";
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && isset($data['rates'])) {
                $currencies = Currency::where('is_enabled', true)->get();
                
                foreach ($currencies as $currency) {
                    if (isset($data['rates'][$currency->code])) {
                        $currency->update(['exchange_rate' => $data['rates'][$currency->code]]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to update rates via OpenExchange: ' . $e->getMessage());
        }

        set_config('ecomm_exchange_rate_last_updated', now()->toDateString());
    }

    /**
     * Reset current currency (useful for testing)
     */
    public function resetCurrentCurrency(): void
    {
        $this->currentCurrencyCode = null;
        $this->currentCurrency = null;
        Session::forget('mc_current_currency');
    }
}

