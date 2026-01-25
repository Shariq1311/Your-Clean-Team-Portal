<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

use MojarCMS\API\Http\Controllers\Auth\LoginController;
use MojarCMS\API\Http\Controllers\Auth\RegisterController;
use MojarCMS\API\Http\Controllers\ThemeController;
use MojarCMS\API\Http\Controllers\PluginController;

Route::get('themes', [ThemeController::class, 'index']);
Route::get('plugins', [PluginController::class, 'index']);
