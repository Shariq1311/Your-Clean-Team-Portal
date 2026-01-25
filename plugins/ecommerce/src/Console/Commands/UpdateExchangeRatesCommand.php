<?php

namespace Mojahid\Ecommerce\Console\Commands;

use Illuminate\Console\Command;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;

class UpdateExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecomm:update-exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exchange rates from configured API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting exchange rate update...');

        $currencyManager = app(CurrencyManager::class);
        
        try {
            $currencyManager->updateExchangeRatesAutomatically();
            $this->info('Exchange rates updated successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to update exchange rates: ' . $e->getMessage());
            return 1;
        }
    }
} 