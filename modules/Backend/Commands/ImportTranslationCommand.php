<?php

namespace MojarCMS\Backend\Commands;

use MojarCMS\CMS\Contracts\TranslationManager;
use MojarCMS\CMS\Facades\Plugin;
use MojarCMS\CMS\Facades\ThemeLoader;
use MojarCMS\DevTool\Commands\Plugin\Translation\ImportTranslationCommand as PluginImportTranslationCommand;

class ImportTranslationCommand extends TranslationCommand
{
    protected $signature = 'Mojarcms:import-translations';

    public function handle(): int
    {
        $import = app(TranslationManager::class)->import('cms')->run();
        $this->info("Imported {$import} rows from core");

        $plugins = Plugin::all();
        foreach ($plugins as $plugin) {
            $this->info("Import translations {$plugin->getName()} plugin");

            $this->call(
                PluginImportTranslationCommand::class,
                [
                    'plugin' => $plugin->getName()
                ]
            );
        }

        $themes = ThemeLoader::all();
        foreach ($themes as $theme) {
            $import = app(TranslationManager::class)
                ->import('theme', $theme->get('name'))
                ->run();

            $this->info("Imported {$import} from {$theme->get('name')}");
        }

        return static::SUCCESS;
    }
}
