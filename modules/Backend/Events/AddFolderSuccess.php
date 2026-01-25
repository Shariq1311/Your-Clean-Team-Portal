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

use MojarCMS\Backend\Models\MediaFolder;

class AddFolderSuccess
{
    public MediaFolder $folder;

    public function __construct(MediaFolder $folder)
    {
        $this->folder = $folder;
    }
}
