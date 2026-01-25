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
use MojarCMS\CMS\Facades\Theme;
use MojarCMS\CMS\Support\Updater\ThemeUpdater;
use MojarCMS\Tests\TestCase;

class ThemeUpdateTest extends TestCase
{
    public function testInstall()
    {
        $updater = app(ThemeUpdater::class)->find('default');

        $updater->update();

        $this->assertDirectoryExists(
            config('Mojar.theme.path') . "/default"
        );

        $theme = Theme::find('default');

        $this->assertNotEmpty($theme);
    }

    public function testUpdate()
    {
        $theme = Theme::find('default');

        $composer = File::get($theme->getPath() . "/theme.json");

        $composer = str_replace($theme->getVersion(), '1.0', $composer);

        File::put($theme->getPath() . "/theme.json", $composer);

        $theme = Theme::find('default');

        $this->assertEquals($theme->getVersion(), '1.0');

        $updater = app(ThemeUpdater::class)->find('default');

        $updater->update();

        $theme = Theme::find('default');

        $this->assertNotEquals($theme->getVersion(), '1.0');
    }
}
