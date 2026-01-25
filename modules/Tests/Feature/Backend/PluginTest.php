<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Tests\Feature\Backend;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use MojarCMS\Tests\TestCase;

class PluginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->authUserAdmin();
    }

    public function testIndexPlugin()
    {
        $this->get("/app/plugins")
            ->assertStatus(200);
    }

    public function testActivePlugin()
    {
        $this->json(
            'POST',
            'app/plugins/bulk-actions',
            [
                'ids' => ['Mojar/example'],
                'action' => 'activate'
            ]
        )
            ->assertJson(['status' => true]);
    }

    public function testDeactivePlugin()
    {
        $this->json(
            'POST',
            'app/plugins/bulk-actions',
            [
                'ids' => ['Mojar/example'],
                'action' => 'deactivate'
            ]
        )
            ->assertJson(['status' => true]);
    }

    public function testDeletePlugin()
    {
        config()->set('Mojar.plugin.enable_upload', true);

        $pluginName = 'Mojar/example';

        $pluginPath = config('Mojar.plugin.path') . "/example";

        $destination = Storage::disk('local')->path("backups/example");

        File::copyDirectory($pluginPath, $destination);

        $this->json(
            'POST',
            'app/plugins/bulk-actions',
            [
                'ids' => [$pluginName],
                'action' => 'delete'
            ]
        )
            ->assertJson(['status' => true]);

        $this->assertFileDoesNotExist(
            $pluginPath . "/composer.json"
        );

        File::copyDirectory($destination, $pluginPath);

        $this->assertFileExists(
            $pluginPath . "/composer.json"
        );
    }
}
