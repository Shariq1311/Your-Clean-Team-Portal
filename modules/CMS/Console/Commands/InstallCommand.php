<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use MojarCMS\CMS\Support\Manager\DatabaseManager;
use MojarCMS\CMS\Support\Manager\FinalInstallManager;
use MojarCMS\CMS\Support\Manager\InstalledFileManager;

class InstallCommand extends Command
{
    protected $signature = 'Mojarcms:install';

    public function handle(
        DatabaseManager $databaseManager,
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall
    ): int {
        $this->info('JUZACMS INSTALLER');
        $this->info('-- Database Install');

        $result = $databaseManager->run();
        if (Arr::get($result, 'status') == 'error') {
            throw new Exception($result['message']);
        }

        $this->info('-- Publish assets');
        $result = $finalInstall->runFinal();
        if (Arr::get($result, 'status') == 'error') {
            throw new Exception($result['message']);
        }

        $this->info('-- Create user admin');
        $this->call('cms:make-admin');

        $this->info('-- Update installed');
        $fileManager->update();

        $this->info('CMS Install Successfully !!!');

        return self::SUCCESS;
    }
}
