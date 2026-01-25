<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

use MojarCMS\Network\Http\Controllers\MappingDomainController;
use MojarCMS\Network\Http\Controllers\PluginController;
use MojarCMS\Network\Http\Controllers\DashboardController;
use MojarCMS\Network\Http\Controllers\SiteController;
use MojarCMS\Network\Http\Controllers\ThemeController;

Route::get('/', [DashboardController::class, 'index'])->name('admin.network.dashboard');

Route::post('sites/{id}/add-mapping-domain', [MappingDomainController::class, 'store'])
    ->name('network.mapping-domains.store');
Route::delete('sites/{site_id}/{id}/destroy', [MappingDomainController::class, 'destroy'])
    ->name('network.mapping-domains.destroy');
Route::mcResource('sites', SiteController::class, ['name' => 'network.sites']);

Route::mcResource('themes', ThemeController::class, ['name' => 'network.themes']);
Route::get('theme/install', [ThemeController::class, 'install'])->name('admin.network.theme.install');

Route::mcResource('plugins', PluginController::class, ['name' => 'network.plugins']);
Route::get('plugin/install', [PluginController::class, 'install'])->name('admin.network.plugin.install');
