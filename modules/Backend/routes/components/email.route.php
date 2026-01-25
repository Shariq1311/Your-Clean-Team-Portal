<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://github.com/Mojar/cms
 * @license    GNU V2
 */

use MojarCMS\Backend\Http\Controllers\Backend\Email\EmailHookController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'email'],
    function () {
        Route::post('/', 'Backend\EmailController@save')->name('admin.setting.email.save');

        Route::post('send-test-mail', 'Backend\EmailController@sendTestMail')->name('admin.setting.email.test-email');
    }
);

Route::mcResource('email-template', 'Backend\EmailTemplateController');
Route::mcResource('email-hooks', EmailHookController::class);
