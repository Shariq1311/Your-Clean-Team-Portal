<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearCacheCommand extends Command
{
    protected $signature = 'Mojarcms:clear-cache';

    public function handle(): int
    {
        if (config('cache.default') != 'file') {
            Cache::clear();
        }

        Cache::store('file')->clear();

        $this->info('Caches cleared successfully.');

        return self::SUCCESS;
    }
}
