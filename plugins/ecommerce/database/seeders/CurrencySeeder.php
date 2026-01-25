<?php

use Illuminate\Database\Seeder;
use Mojahid\Ecommerce\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.0,
                'is_default' => true,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 2,
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'exchange_rate' => 0.85,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => '.',
                'decimal_separator' => ',',
                'decimal_place' => 2,
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
                'exchange_rate' => 0.75,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 2,
            ],
            [
                'code' => 'CAD',
                'name' => 'Canadian Dollar',
                'symbol' => 'C$',
                'exchange_rate' => 1.25,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 2,
            ],
            [
                'code' => 'AUD',
                'name' => 'Australian Dollar',
                'symbol' => 'A$',
                'exchange_rate' => 1.35,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 2,
            ],
            [
                'code' => 'JPY',
                'name' => 'Japanese Yen',
                'symbol' => '¥',
                'exchange_rate' => 110.0,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 0,
            ],
            [
                'code' => 'INR',
                'name' => 'Indian Rupee',
                'symbol' => '₹',
                'exchange_rate' => 75.0,
                'is_default' => false,
                'is_enabled' => true,
                'symbol_position' => 'before',
                'thousand_separator' => ',',
                'decimal_separator' => '.',
                'decimal_place' => 2,
            ],
        ];

        foreach ($currencies as $currencyData) {
            Currency::updateOrCreate(
                ['code' => $currencyData['code']],
                $currencyData
            );
        }
    }
} 