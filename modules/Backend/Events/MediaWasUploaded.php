<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Events;

use MojarCMS\Backend\Models\MediaFile;

class MediaWasUploaded
{
    public $mediaFile;

    public function __construct(MediaFile $mediaFile)
    {
        $this->mediaFile = $mediaFile;
    }
}
