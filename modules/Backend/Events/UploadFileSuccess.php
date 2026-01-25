<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Backend\Events;

use MojarCMS\Backend\Models\MediaFile;

class UploadFileSuccess
{
    public function __construct(public MediaFile $file) {}
}
