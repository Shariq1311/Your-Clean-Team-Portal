<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use MojarCMS\Network\Contracts\SiteManagerContract;

class MakeSiteCommand extends Command
{
    protected $signature = 'network:make-site {subdomain}';

    public function handle(): int
    {
        $subdomain = $this->argument('subdomain');

        //DB::beginTransaction();
        try {
            app(SiteManagerContract::class)->create($subdomain);

            //DB::commit();
        } catch (\Exception | \Error $e) {
            //DB::rollBack();
            throw $e;
        }

        $this->info("Site {$subdomain} created successfully.");

        return self::SUCCESS;
    }
}
