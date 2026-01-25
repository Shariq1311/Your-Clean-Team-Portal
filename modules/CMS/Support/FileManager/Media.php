<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\CMS\Support\FileManager;

use MojarCMS\Backend\Repositories\MediaFileRepository;
use MojarCMS\Backend\Repositories\MediaFolderRepository;
use MojarCMS\CMS\Models\Model;

class Media
{
    protected MediaFileRepository $fileRepository;
    protected MediaFolderRepository $folderRepository;
    protected Model $model;

    public function __construct(
        MediaFileRepository $fileRepository,
        MediaFolderRepository $folderRepository,
        Model $model
    ) {
        $this->fileRepository = $fileRepository;
        $this->folderRepository = $folderRepository;
        $this->model = $model;
    }
}
