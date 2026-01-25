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

use MojarCMS\Tests\TestCase;

class OptimizeTest extends TestCase
{
    public function testOptimize()
    {
        $this->artisan('optimize')
            ->assertExitCode(0);
    }

    public function testOptimizeClear()
    {
        $this->artisan('optimize:clear')
            ->assertExitCode(0);
    }
}
