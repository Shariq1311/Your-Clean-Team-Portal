<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Tests;

use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Support\Installer;

class InstallTest extends TestCase
{
    public function testInstallCommand(): void
    {
        $this->resetTestData();

        $this->artisan('Mojarcms:install')
            ->expectsQuestion('Full Name?', 'Taylor Otwell')
            ->expectsQuestion('Email?', 'demo@gmail.com')
            ->expectsQuestion('Password?', '12345678')
            ->assertExitCode(0);

        $this->assertFileExists(Installer::installedPath());

        $this->assertDatabaseHas('users', ['email' => 'demo@gmail.com', 'is_admin' => 1]);
    }

    protected function resetTestData(): void
    {
        $this->artisan('migrate:reset', ['--force' => true])
            ->assertExitCode(0);

        if (file_exists(Installer::installedPath())) {
            unlink(Installer::installedPath());
        }
    }
}
