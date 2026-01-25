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

use Illuminate\Support\Facades\Storage;
use MojarCMS\CMS\Models\User;
use MojarCMS\CMS\Support\FileManager;
use MojarCMS\Tests\TestCase;

class MediaTest extends TestCase
{
    public function testUploadByPath()
    {
        Storage::put('tmps/test.gif', base64_decode('R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='));

        $media = FileManager::addFile(
            Storage::path('tmps/test.gif'),
            'file',
            null,
            User::first()->id
        );

        $this->assertNotEmpty($media->path);

        $this->assertFileDoesNotExist(Storage::path('tmps/test.gif'));
    }

    public function testUploadByUrl()
    {
        $img = 'https://cdn.Mojar.com/mc-styles/Mojar/images/thumb-default.png';

        $media = FileManager::addFile($img, 'image', null, User::first()->id);

        $this->assertNotEmpty($media->path);

        $this->assertFileExists(
            Storage::disk('public')->path($media->path)
        );
    }
}
