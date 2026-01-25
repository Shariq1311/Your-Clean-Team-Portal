<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

use MojarCMS\Backend\Http\Controllers\FileManager\FileManagerController;
use MojarCMS\Backend\Http\Controllers\FileManager\UploadController;
use MojarCMS\Backend\Http\Controllers\FileManager\ItemsController;
use MojarCMS\Backend\Http\Controllers\FileManager\FolderController;
use MojarCMS\Backend\Http\Controllers\FileManager\DeleteController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'file-manager'],
    function () {
        Route::get('/', [FileManagerController::class, 'index']);

        Route::get('/errors', [FileManagerController::class, 'getErrors']);

        Route::any('/upload', [UploadController::class, 'upload'])->name('filemanager.upload');

        Route::any('/import', [UploadController::class, 'import'])->name('filemanager.import');

        Route::get('/jsonitems', [ItemsController::class, 'getItems']);

        /*Route::get('/move', 'ItemsController@move');

        Route::get('/domove', 'ItemsController@domove');*/

        Route::post('/newfolder', [FolderController::class, 'addfolder']);

        Route::get('/folders', [FolderController::class, 'getFolders']);

        /*Route::get('/rename', 'RenameController@getRename');

        Route::get('/download', 'DownloadController@getDownload');*/

        Route::post('/delete', [DeleteController::class, 'delete']);
    }
);
