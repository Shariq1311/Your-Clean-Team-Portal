<?php

declare(strict_types=1);

namespace Mojahid\PwaManager\Actions;

use Illuminate\Http\Request;
use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class SettingAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'addSettingForm']);
        $this->addAction(Action::INIT_ACTION, [$this, 'registerConfigs']);
    }

    public function addSettingForm(): void
    {
        HookAction::addSettingForm(
            'pwa-manager',
            [
                'name' => trans('pwa::content.pwa_manager'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-mobile"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z"></path><path d="M11 4h2"></path><path d="M12 17v.01"></path></svg>',
                'menu_position' => 45,
                'view' => view('pwa-manager::backend.settings.form'),
            ]
        );
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            // Core PWA Settings
            'pwa_enabled' => [
                'type' => 'boolean',
                'label' => trans('pwa::content.enable_pwa'),
                'default' => false,
            ],
            
            // App Identity
            'pwa_app_name' => [
                'type' => 'text',
                'label' => trans('pwa::content.app_name'),
                'default' => '',
            ],
            'pwa_short_name' => [
                'type' => 'text',
                'label' => trans('pwa::content.short_name'),
                'default' => '',
            ],
            'pwa_description' => [
                'type' => 'textarea',
                'label' => trans('pwa::content.description'),
                'default' => '',
            ],
            
            // Appearance
            'pwa_theme_color' => [
                'type' => 'color',
                'label' => trans('pwa::content.theme_color'),
                'default' => '#6777ef',
            ],
            'pwa_background_color' => [
                'type' => 'color',
                'label' => trans('pwa::content.background_color'),
                'default' => '#ffffff',
            ],
            
            // Behavior
            'pwa_display' => [
                'type' => 'select',
                'label' => trans('pwa::content.display_mode'),
                'options' => [
                    'standalone' => trans('pwa::content.display_standalone'),
                    'fullscreen' => trans('pwa::content.display_fullscreen'),
                    'minimal-ui' => trans('pwa::content.display_minimal_ui'),
                    'browser' => trans('pwa::content.display_browser'),
                ],
                'default' => 'standalone',
            ],
            'pwa_start_url' => [
                'type' => 'text',
                'label' => trans('pwa::content.start_url'),
                'default' => '/',
            ],
            
            // Features
            'pwa_show_install_button' => [
                'type' => 'boolean',
                'label' => trans('pwa::content.show_install_button'),
                'default' => true,
            ],
            'pwa_init_delay' => [
                'type' => 'number',
                'label' => trans('pwa::content.init_delay'),
                'default' => 1000,
                'help' => trans('pwa::content.init_delay_help'),
            ],
            
            // Assets
            'pwa_logo' => [
                'type' => 'file',
                'label' => trans('pwa::content.pwa_logo'),
                'default' => '',
            ],
            'pwa_custom_icons' => [
                'type' => 'json',
                'label' => trans('pwa::content.custom_icons'),
                'default' => '[]',
            ],
            
            // Advanced Settings
            'pwa_orientation' => [
                'type' => 'select',
                'label' => trans('pwa::content.orientation'),
                'options' => [
                    'any' => trans('pwa::content.orientation_any'),
                    'portrait' => trans('pwa::content.orientation_portrait'),
                    'landscape' => trans('pwa::content.orientation_landscape'),
                ],
                'default' => 'any',
            ],
            'pwa_scope' => [
                'type' => 'text',
                'label' => trans('pwa::content.scope'),
                'default' => '/',
                'help' => trans('pwa::content.scope_help'),
            ],
            
            // Caching Strategy
            'pwa_cache_strategy' => [
                'type' => 'select',
                'label' => trans('pwa::content.cache_strategy'),
                'options' => [
                    'cache_first' => trans('pwa::content.cache_first'),
                    'network_first' => trans('pwa::content.network_first'),
                    'stale_while_revalidate' => trans('pwa::content.stale_while_revalidate'),
                ],
                'default' => 'cache_first',
            ],
        ]);
    }

    public function saveSetting(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->all();
            
            // Remove CSRF token and method
            unset($data['_token'], $data['_method']);
            
            // Validate critical fields
            if (isset($data['pwa_enabled']) && $data['pwa_enabled']) {
                $this->validatePwaSettings($data);
            }
            
            // Process custom icons JSON
            if (isset($data['pwa_custom_icons']) && is_string($data['pwa_custom_icons'])) {
                $data['pwa_custom_icons'] = json_decode($data['pwa_custom_icons'], true) ?? [];
            }
            
            // Save all settings
            foreach ($data as $key => $value) {
                if (str_starts_with($key, 'pwa_')) {
                    set_config($key, $value);
                }
            }
            
            // Update manifest if PWA is enabled
            if (!empty($data['pwa_enabled'])) {
                $this->updatePwaManifest();
            }
            
            return response()->json([
                'status' => 'success',
                'message' => trans('pwa::content.settings_saved_successfully')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
                 }
     }
     
     private function updatePwaManifest(): void
     {
         try {
             $manifestData = [
                 'name' => get_config('pwa_app_name', get_config('title', 'My App')),
                 'short_name' => get_config('pwa_short_name', 'App'),
                 'description' => get_config('pwa_description', get_config('description', '')),
                 'background_color' => get_config('pwa_background_color', '#ffffff'),
                 'theme_color' => get_config('pwa_theme_color', '#6777ef'),
                 'display' => get_config('pwa_display', 'standalone'),
                 'start_url' => get_config('pwa_start_url', '/'),
                 'scope' => get_config('pwa_scope', '/'),
                 'orientation' => get_config('pwa_orientation', 'any'),
                 'icons' => $this->buildManifestIcons()
             ];

             \EragLaravelPwa\Facades\PWA::update($manifestData);
         } catch (\Exception $e) {
             error_log("PWA manifest update failed: " . $e->getMessage());
         }
     }

     private function buildManifestIcons(): array
     {
         $icons = [];
         
         // Get PWA logo using upload_url
         $logoPath = get_config('pwa_logo');
         if ($logoPath) {
             $logoUrl = upload_url($logoPath);
             // Convert to relative path for manifest
             $relativePath = str_replace(url('/'), '', $logoUrl);
             if (!str_starts_with($relativePath, '/')) {
                 $relativePath = '/' . $relativePath;
             }
             
             $icons[] = [
                 'src' => $relativePath,
                 'sizes' => '512x512',
                 'type' => 'image/png',
                 'purpose' => 'any maskable'
             ];
             
             $icons[] = [
                 'src' => $relativePath,
                 'sizes' => '192x192',
                 'type' => 'image/png'
             ];
         }

         return $icons;
     }
     
     private function validatePwaSettings(array $data): void
    {
        $required = ['pwa_app_name', 'pwa_short_name'];
        
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new \InvalidArgumentException(
                    trans('pwa::content.field_required', ['field' => $field])
                );
            }
        }
        
        // Validate short name length
        if (isset($data['pwa_short_name']) && strlen($data['pwa_short_name']) > 12) {
            throw new \InvalidArgumentException(
                trans('pwa::content.short_name_too_long')
            );
        }
        
        // Validate colors
        $colors = ['pwa_theme_color', 'pwa_background_color'];
        foreach ($colors as $color) {
            if (isset($data[$color]) && !preg_match('/^#[0-9A-Fa-f]{6}$/', $data[$color])) {
                throw new \InvalidArgumentException(
                    trans('pwa::content.invalid_color_format', ['field' => $color])
                );
            }
        }
        
        // Validate URLs
        if (isset($data['pwa_start_url']) && !filter_var($data['pwa_start_url'], FILTER_VALIDATE_URL) && $data['pwa_start_url'] !== '/') {
            throw new \InvalidArgumentException(
                trans('pwa::content.invalid_start_url')
            );
                 }
     }
} 