<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Tests\Unit;

use Illuminate\Support\Facades\File;
use MojarCMS\CMS\Facades\Plugin;
use MojarCMS\CMS\Support\Updater\PluginUpdater;
use MojarCMS\Tests\TestCase;

class PluginUpdateTest extends TestCase
{
    public function testInstall()
    {
        $updater = app(PluginUpdater::class)->find('Mojar/movie');

        $updater->update();

        $this->assertDirectoryExists(
            config('Mojar.plugin.path') . "/movie"
        );

        $plugin = Plugin::find('Mojar/movie');

        $this->assertNotEmpty($plugin);
    }

    public function testUpdate()
    {
        $plugin = Plugin::find('Mojar/movie');

        $composer = File::get($plugin->getPath() . "/composer.json");

        $composer = str_replace($plugin->getVersion(), '1.0', $composer);

        File::put($plugin->getPath() . "/composer.json", $composer);

        $plugin = Plugin::find('Mojar/movie');
        $this->assertEquals($plugin->getVersion(), '1.0');

        $updater = app(PluginUpdater::class)->find('Mojar/movie');

        $updater->update();

        $plugin = Plugin::find('Mojar/movie');
        $this->assertNotEquals($plugin->getVersion(), '1.0');
    }
}
