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

use MojarCMS\CMS\Database\Seeders\DatabaseSeeder;
use MojarCMS\Tests\TestCase;

class DatabaseTest extends TestCase
{
    public function testMigration(): void
    {
        $this->artisan('migrate:refresh')
            ->assertExitCode(0);
    }

    public function testSeed(): void
    {
        $this->artisan(
            'db:seed',
            [
                '--class' => DatabaseSeeder::class
            ]
        )
            ->assertExitCode(0);
    }

    public function testMakeAdmin(): void
    {
        $this->artisan('cms:make-admin')
            ->expectsQuestion('Full Name?', 'Taylor Otwell')
            ->expectsQuestion('Email?', 'admin@admin.com')
            ->expectsQuestion('Password?', 'admin@admin.com')
            ->assertExitCode(0);
    }

    public function testMakeEmailTemplate(): void
    {
        $this->artisan('mail:generate-template')
            ->assertExitCode(0);
    }
}
