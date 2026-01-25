<?php

declare(strict_types=1);

namespace MojarCMS\DevTool\Commands\Plugin\Migration;

use Illuminate\Console\Command;
use MojarCMS\CMS\Contracts\LocalPluginRepositoryContract;
use MojarCMS\CMS\Support\Plugin;

class LaravelModulesV6Migrator extends Command
{
    protected $name = 'plugin:v6:migrate';
    protected $description = 'Migrate laravel-modules v5 plugins statuses to v6.';

    public function handle()
    {
        $moduleStatuses = [];
        /** @var LocalPluginRepositoryContract $modules */
        $modules = $this->laravel['plugins'];

        $modules = $modules->all();
        /** @var Plugin $module */
        foreach ($modules as $module) {
            if ($module->json()->get('active') === 1) {
                $module->enable();
                $moduleStatuses[] = [$module->getName(), 'Enabled'];
            }
            if ($module->json()->get('active') === 0) {
                $module->disable();
                $moduleStatuses[] = [$module->getName(), 'Disabled'];
            }
        }
        $this->info('All plugins have been migrated.');
        $this->table(['Plugin name', 'Status'], $moduleStatuses);
    }
}
