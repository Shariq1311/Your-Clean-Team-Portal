<?php

declare(strict_types=1);

namespace Mojahid\CookieSettings\Actions;

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
            'cookie-settings',
            [
                'name' => trans('cookie::content.cookie_settings'),
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cookie"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><path d="M8 12h.01"></path><path d="M12 8h.01"></path><path d="M16 16h.01"></path><path d="M10 16h.01"></path><path d="M14 10h.01"></path></svg>',
                'view' => view('cookie::backend.settings.form'),
                'priority' => 45,
            ]
        );
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            'cookie_enabled' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.enable_cookie_banner'),
                'default' => true,
            ],
            'cookie_position' => [
                'type' => 'select',
                'label' => trans('cookie::content.banner_position'),
                'options' => [
                    'bottom' => trans('cookie::content.bottom_right'),
                    'bottom-left' => trans('cookie::content.bottom_left'),
                    'top' => trans('cookie::content.top_right'),
                    'top-left' => trans('cookie::content.top_left'),
                ],
                'default' => 'bottom',
            ],
            'cookie_theme' => [
                'type' => 'select',
                'label' => trans('cookie::content.banner_theme'),
                'options' => [
                    'light' => trans('cookie::content.light_theme'),
                    'dark' => trans('cookie::content.dark_theme'),
                    'custom' => trans('cookie::content.custom_theme'),
                ],
                'default' => 'light',
            ],
            'cookie_auto_hide' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.auto_hide_banner'),
                'default' => false,
            ],
            'cookie_hide_delay' => [
                'type' => 'number',
                'label' => trans('cookie::content.auto_hide_delay'),
                'default' => 5,
            ],
            'cookie_remember_days' => [
                'type' => 'number',
                'label' => trans('cookie::content.remember_choice_days'),
                'default' => 30,
            ],
            'cookie_force_consent' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.force_consent'),
                'default' => false,
            ],
            
            // Content Settings
            'cookie_title' => [
                'type' => 'text',
                'label' => trans('cookie::content.banner_title'),
                'default' => 'We use cookies',
            ],
            'cookie_message' => [
                'type' => 'textarea',
                'label' => trans('cookie::content.banner_message'),
                'default' => 'This website uses cookies to improve your experience. By continuing to use this site, you consent to our use of cookies.',
            ],
            'cookie_accept_text' => [
                'type' => 'text',
                'label' => trans('cookie::content.accept_button_text'),
                'default' => 'Accept All',
            ],
            'cookie_decline_text' => [
                'type' => 'text',
                'label' => trans('cookie::content.decline_button_text'),
                'default' => 'Decline',
            ],
            'cookie_settings_text' => [
                'type' => 'text',
                'label' => trans('cookie::content.settings_button_text'),
                'default' => 'Cookie Settings',
            ],
            'cookie_policy_link' => [
                'type' => 'text',
                'label' => trans('cookie::content.privacy_policy_link'),
                'default' => '',
            ],
            'cookie_policy_text' => [
                'type' => 'text',
                'label' => trans('cookie::content.privacy_policy_text'),
                'default' => 'Privacy Policy',
            ],
            
            // Cookie Categories
            'cookie_essential_enabled' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.essential_cookies'),
                'default' => true,
            ],
            'cookie_analytics_enabled' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.analytics_cookies'),
                'default' => false,
            ],
            'cookie_marketing_enabled' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.marketing_cookies'),
                'default' => false,
            ],
            'cookie_preferences_enabled' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.preference_cookies'),
                'default' => false,
            ],
            
            // Styling
            'cookie_banner_bg_color' => [
                'type' => 'color',
                'label' => trans('cookie::content.banner_background_color'),
                'default' => '#ffffff',
            ],
            'cookie_banner_text_color' => [
                'type' => 'color',
                'label' => trans('cookie::content.banner_text_color'),
                'default' => '#333333',
            ],
            'cookie_button_bg_color' => [
                'type' => 'color',
                'label' => trans('cookie::content.button_background_color'),
                'default' => '#007bff',
            ],
            'cookie_button_text_color' => [
                'type' => 'color',
                'label' => trans('cookie::content.button_text_color'),
                'default' => '#ffffff',
            ],
            'cookie_border_radius' => [
                'type' => 'text',
                'label' => trans('cookie::content.border_radius'),
                'default' => '8px',
            ],
            'cookie_box_shadow' => [
                'type' => 'text',
                'label' => trans('cookie::content.box_shadow'),
                'default' => '0 4px 15px rgba(0,0,0,0.2)',
            ],
            
            // Advanced Settings
            'cookie_domain' => [
                'type' => 'text',
                'label' => trans('cookie::content.cookie_domain'),
                'default' => '',
            ],
            'cookie_path' => [
                'type' => 'text',
                'label' => trans('cookie::content.cookie_path'),
                'default' => '/',
            ],
            'cookie_secure' => [
                'type' => 'boolean',
                'label' => trans('cookie::content.secure_cookies'),
                'default' => false,
            ],
            'cookie_same_site' => [
                'type' => 'select',
                'label' => trans('cookie::content.same_site'),
                'options' => [
                    'None' => 'None',
                    'Lax' => 'Lax',
                    'Strict' => 'Strict',
                ],
                'default' => 'Lax',
            ],
            'cookie_custom_css' => [
                'type' => 'textarea',
                'label' => trans('cookie::content.custom_css'),
                'default' => '',
            ],
        ]);
    }

    public function saveSetting(Request $request)
    {
        $data = $request->all();
        
        // Remove CSRF token and method
        unset($data['_token'], $data['_method']);
        
        foreach ($data as $key => $value) {
            set_config($key, $value);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => trans('cms::app.save_successfully')
        ]);
    }
} 