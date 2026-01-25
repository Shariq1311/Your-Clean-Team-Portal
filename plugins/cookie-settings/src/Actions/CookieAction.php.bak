<?php

declare(strict_types=1);

namespace Mojahid\CookieSettings\Actions;

use Illuminate\Http\Request;
use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;

final class CookieAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'registerFrontendActions']);
        $this->addAction(Action::INIT_ACTION, [$this, 'registerConfigs']);
    }

    public function registerFrontendActions(): void
    {
        // Add cookie scripts to frontend
        HookAction::addAction('theme.footer', [$this, 'addCookieScripts'], 20);
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            // General Cookie Settings
            'cookie_enabled',
            'cookie_position',
            'cookie_theme',
            'cookie_auto_hide',
            'cookie_hide_delay',
            'cookie_remember_days',
            'cookie_force_consent',
            
            // Cookie Banner Content
            'cookie_title',
            'cookie_message',
            'cookie_accept_text',
            'cookie_decline_text',
            'cookie_settings_text',
            'cookie_policy_link',
            'cookie_policy_text',
            
            // Cookie Categories
            'cookie_essential_enabled',
            'cookie_analytics_enabled',
            'cookie_marketing_enabled',
            'cookie_preferences_enabled',
            
            // Styling
            'cookie_banner_bg_color',
            'cookie_banner_text_color',
            'cookie_button_bg_color',
            'cookie_button_text_color',
            'cookie_border_radius',
            'cookie_box_shadow',
            
            // Advanced Settings
            'cookie_domain',
            'cookie_path',
            'cookie_secure',
            'cookie_same_site',
            'cookie_custom_css',
        ]);
    }

    public function addCookieScripts(): void
    {
        if (!get_config('cookie_enabled', true)) {
            return;
        }

        $settings = $this->getCookieSettings();
        $script = $this->renderCookieScript($settings);
        
        echo $script;
    }

    private function getCookieSettings(): array
    {
        // Helper function to convert string/boolean values properly
        $toBool = function($value, $default = false) {
            if (is_bool($value)) return $value;
            if (is_string($value)) return in_array(strtolower($value), ['1', 'true', 'on', 'yes']);
            if (is_numeric($value)) return (bool) $value;
            return $default;
        };

        return [
            'enabled' => $toBool(get_config('cookie_enabled', true), true),
            'position' => get_config('cookie_position', 'bottom'),
            'theme' => get_config('cookie_theme', 'light'),
            'auto_hide' => $toBool(get_config('cookie_auto_hide', false)),
            'hide_delay' => (int) get_config('cookie_hide_delay', 5),
            'remember_days' => (int) get_config('cookie_remember_days', 30),
            'force_consent' => $toBool(get_config('cookie_force_consent', false)),
            
            // Content
            'title' => get_config('cookie_title', 'We use cookies'),
            'message' => get_config('cookie_message', 'This website uses cookies to improve your experience. By continuing to use this site, you consent to our use of cookies.'),
            'accept_text' => get_config('cookie_accept_text', 'Accept All'),
            'decline_text' => get_config('cookie_decline_text', 'Decline'),
            'settings_text' => get_config('cookie_settings_text', 'Cookie Settings'),
            'policy_link' => get_config('cookie_policy_link', ''),
            'policy_text' => get_config('cookie_policy_text', 'Privacy Policy'),
            
            // Categories
            'categories' => [
                'essential' => $toBool(get_config('cookie_essential_enabled', true), true),
                'analytics' => $toBool(get_config('cookie_analytics_enabled', false)),
                'marketing' => $toBool(get_config('cookie_marketing_enabled', false)),
                'preferences' => $toBool(get_config('cookie_preferences_enabled', false)),
            ],
            
            // Styling
            'styling' => [
                'banner_bg' => get_config('cookie_banner_bg_color', '#ffffff'),
                'banner_text' => get_config('cookie_banner_text_color', '#333333'),
                'button_bg' => get_config('cookie_button_bg_color', '#007bff'),
                'button_text' => get_config('cookie_button_text_color', '#ffffff'),
                'border_radius' => get_config('cookie_border_radius', '8px'),
                'box_shadow' => get_config('cookie_box_shadow', '0 4px 15px rgba(0,0,0,0.2)'),
            ],
            
            // Advanced
            'domain' => get_config('cookie_domain', ''),
            'path' => get_config('cookie_path', '/'),
            'secure' => $toBool(get_config('cookie_secure', false)),
            'same_site' => get_config('cookie_same_site', 'Lax'),
            'custom_css' => get_config('cookie_custom_css', ''),
        ];
    }

    private function renderCookieScript(array $settings): string
    {
        $settingsJson = json_encode($settings, JSON_HEX_APOS | JSON_HEX_QUOT);
        
        $script = "<!-- Cookie Settings Script -->\n";
        $script .= "<style id='cookie-banner-styles'>\n";
        $script .= $this->getCookieBannerStyles($settings);
        $script .= "</style>\n";
        
        $script .= "<script type='text/javascript'>\n";
        $script .= "window.cookieSettings = {$settingsJson};\n";
        $script .= $this->getCookieJavaScript();
        $script .= "</script>\n";
        
        return $script;
    }

    private function getCookieBannerStyles(array $settings): string
    {
        $styling = $settings['styling'];
        $position = $settings['position'];
        
        $styles = "
        #cookie-banner {
            position: fixed;
            z-index: 9999;
            background: {$styling['banner_bg']};
            color: {$styling['banner_text']};
            padding: 20px;
            border-radius: {$styling['border_radius']};
            box-shadow: {$styling['box_shadow']};
            max-width: 500px;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
            transform: translateY(100%);
            opacity: 0;
        }
        
        #cookie-banner.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        #cookie-banner." . ($position === 'top' ? 'top' : 'bottom') . " {
            " . ($position === 'top' ? 'top: 20px;' : 'bottom: 20px;') . "
            " . (strpos($position, 'left') !== false ? 'left: 20px;' : 'right: 20px;') . "
        }
        
        #cookie-banner h4 {
            margin: 0 0 10px 0;
            font-size: 18px;
            font-weight: bold;
        }
        
        #cookie-banner p {
            margin: 0 0 15px 0;
            font-size: 14px;
            line-height: 1.4;
        }
        
        #cookie-banner .cookie-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        #cookie-banner button {
            background: {$styling['button_bg']};
            color: {$styling['button_text']};
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        
        #cookie-banner button:hover {
            opacity: 0.8;
            transform: translateY(-1px);
        }
        
        #cookie-banner button.decline {
            background: #6c757d;
        }
        
        #cookie-banner button.settings {
            background: transparent;
            color: {$styling['banner_text']};
            border: 1px solid {$styling['banner_text']};
        }
        
        #cookie-banner a {
            color: {$styling['button_bg']};
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            #cookie-banner {
                left: 20px !important;
                right: 20px !important;
                max-width: none;
                margin: 0;
            }
            
            #cookie-banner .cookie-buttons {
                flex-direction: column;
            }
            
            #cookie-banner button {
                width: 100%;
            }
        }
        
        /* Cookie Settings Modal Styles */
        .cookie-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .cookie-modal.show {
            opacity: 1;
            visibility: visible;
        }
        
        .cookie-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }
        
        .cookie-modal-content {
            position: relative;
            background: {$styling['banner_bg']};
            color: {$styling['banner_text']};
            border-radius: {$styling['border_radius']};
            box-shadow: {$styling['box_shadow']};
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow: auto;
            font-family: Arial, sans-serif;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }
        
        .cookie-modal.show .cookie-modal-content {
            transform: scale(1);
        }
        
        .cookie-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 20px 0;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .cookie-modal-header h3 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }
        
        .cookie-modal-close {
            background: none;
            border: none;
            font-size: 28px;
            color: {$styling['banner_text']};
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        
        .cookie-modal-close:hover {
            opacity: 0.7;
        }
        
        .cookie-modal-body {
            padding: 20px;
        }
        
        .cookie-modal-body > p {
            margin: 0 0 20px 0;
            font-size: 16px;
            line-height: 1.5;
        }
        
        .cookie-category {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        
        .cookie-category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .cookie-category h4 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        
        .cookie-category p {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
            opacity: 0.8;
        }
        
        /* Toggle Switch Styles */
        .cookie-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .cookie-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .cookie-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 24px;
        }
        
        .cookie-slider:before {
            position: absolute;
            content: '';
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        
        input:checked + .cookie-slider {
            background-color: {$styling['button_bg']};
        }
        
        input:checked + .cookie-slider:before {
            transform: translateX(26px);
        }
        
        input:disabled + .cookie-slider {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .cookie-modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            padding: 0 20px 20px;
            border-top: 1px solid rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        
        .cookie-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .cookie-btn-primary {
            background: {$styling['button_bg']};
            color: {$styling['button_text']};
        }
        
        .cookie-btn-secondary {
            background: transparent;
            color: {$styling['banner_text']};
            border: 1px solid {$styling['banner_text']};
        }
        
        .cookie-btn:hover {
            opacity: 0.8;
            transform: translateY(-1px);
        }
        
        @media (max-width: 768px) {
            .cookie-modal-content {
                width: 95%;
                max-height: 90vh;
            }
            
            .cookie-modal-header {
                padding: 15px;
            }
            
            .cookie-modal-body {
                padding: 15px;
            }
            
            .cookie-modal-footer {
                flex-direction: column;
                padding: 15px;
            }
            
            .cookie-btn {
                width: 100%;
            }
            
            .cookie-category-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
        
        {$settings['custom_css']}
        ";
        
        return $styles;
    }

    private function getCookieJavaScript(): string
    {
        return "
        (function() {
            'use strict';
            
            const CookieManager = {
                settings: window.cookieSettings,
                cookieName: 'cookie_consent',
                categoryPrefix: 'cookie_category_',
                
                init: function() {
                    if (!this.settings.enabled) {
                        return;
                    }
                    
                    // Give a moment for everything to load, then check consent
                    setTimeout(() => {
                        const hasConsent = this.hasConsent();
                        if (!hasConsent) {
                            this.showBanner();
                        } else {
                         //
                        }
                    }, 100); // Shorter delay, just enough for DOM to be ready
                    
                    this.bindEvents();
                },
                
                hasConsent: function() {
                    const consent = this.getCookie(this.cookieName);
                    return consent !== null && consent !== '' && (consent === 'accepted' || consent === 'declined');
                },
                
                showBanner: function() {
                    if (document.getElementById('cookie-banner')) return;
                    
                    const banner = this.createBanner();
                    document.body.appendChild(banner);
                    
                    // Show with animation
                    setTimeout(() => {
                        banner.classList.add('show');
                    }, 100);
                    
                    // Auto hide if enabled
                    if (this.settings.auto_hide && this.settings.hide_delay > 0) {
                        setTimeout(() => {
                            this.acceptAll();
                        }, this.settings.hide_delay * 1000);
                    }
                },
                
                createBanner: function() {
                    const banner = document.createElement('div');
                    banner.id = 'cookie-banner';
                    banner.className = this.settings.position;
                    
                    const policyLink = this.settings.policy_link ? 
                        ' <a href=\"' + this.settings.policy_link + '\" target=\"_blank\">' + this.settings.policy_text + '</a>' : '';
                    
                    // Check if force consent is enabled (should be boolean or string)
                    const forceConsent = this.settings.force_consent === true || this.settings.force_consent === '1' || this.settings.force_consent === 1;
                    
                    banner.innerHTML = '<h4>' + this.settings.title + '</h4>' +
                        '<p>' + this.settings.message + policyLink + '</p>' +
                        '<div class=\"cookie-buttons\">' +
                        '<button onclick=\"CookieManager.acceptAll()\">' + this.settings.accept_text + '</button>' +
                        (forceConsent ? '' : '<button class=\"decline\" onclick=\"CookieManager.declineAll()\">' + this.settings.decline_text + '</button>') +
                        '<button class=\"settings\" onclick=\"CookieManager.showSettings()\">' + this.settings.settings_text + '</button>' +
                        '</div>';
                    
                    return banner;
                },
                
                acceptAll: function() {
                    this.setCookie(this.cookieName, 'accepted', this.settings.remember_days);
                    
                    // Set all cookie categories to accepted
                    this.setCookieCategory('essential', true);
                    this.setCookieCategory('analytics', this.settings.categories.analytics);
                    this.setCookieCategory('marketing', this.settings.categories.marketing);
                    this.setCookieCategory('preferences', this.settings.categories.preferences);
                    
                    this.hideBanner();
                    this.triggerEvent('cookiesAccepted');
                },
                
                declineAll: function() {
                    this.setCookie(this.cookieName, 'declined', this.settings.remember_days);
                    
                    // Set cookie categories - only essential allowed
                    this.setCookieCategory('essential', true);
                    this.setCookieCategory('analytics', false);
                    this.setCookieCategory('marketing', false);
                    this.setCookieCategory('preferences', false);
                    
                    this.hideBanner();
                    this.triggerEvent('cookiesDeclined');
                },
                
                showSettings: function() {
                    this.createSettingsModal();
                },
                
                createSettingsModal: function() {
                    // Remove existing modal if present
                    const existingModal = document.getElementById('cookie-settings-modal');
                    if (existingModal) {
                        existingModal.remove();
                    }
                    
                    const modal = document.createElement('div');
                    modal.id = 'cookie-settings-modal';
                    modal.className = 'cookie-modal';
                    
                    modal.innerHTML = this.getSettingsModalHTML();
                    document.body.appendChild(modal);
                    
                    // Show modal with animation
                    setTimeout(() => {
                        modal.classList.add('show');
                    }, 10);
                    
                    // Bind modal events
                    this.bindModalEvents();
                },
                
                getSettingsModalHTML: function() {
                    const essential = this.getCookieCategory('essential', true);
                    const analytics = this.getCookieCategory('analytics', false);
                    const marketing = this.getCookieCategory('marketing', false);
                    const preferences = this.getCookieCategory('preferences', false);
                    
                    return '<div class=\"cookie-modal-overlay\" onclick=\"CookieManager.closeSettingsModal()\"></div>' +
                        '<div class=\"cookie-modal-content\">' +
                        '<div class=\"cookie-modal-header\">' +
                        '<h3>Cookie Settings</h3>' +
                        '<button class=\"cookie-modal-close\" onclick=\"CookieManager.closeSettingsModal()\">&times;</button>' +
                        '</div>' +
                        '<div class=\"cookie-modal-body\">' +
                        '<p>Choose which cookies you allow us to use. You can change these settings at any time.</p>' +
                        
                        '<div class=\"cookie-category\">' +
                        '<div class=\"cookie-category-header\">' +
                        '<h4>Essential Cookies</h4>' +
                        '<label class=\"cookie-switch\">' +
                        '<input type=\"checkbox\" checked disabled>' +
                        '<span class=\"cookie-slider\"></span>' +
                        '</label>' +
                        '</div>' +
                        '<p>These cookies are necessary for the website to function and cannot be disabled.</p>' +
                        '</div>' +
                        
                        (this.settings.categories.analytics ? 
                        '<div class=\"cookie-category\">' +
                        '<div class=\"cookie-category-header\">' +
                        '<h4>Analytics Cookies</h4>' +
                        '<label class=\"cookie-switch\">' +
                        '<input type=\"checkbox\" id=\"analytics-toggle\" ' + (analytics ? 'checked' : '') + '>' +
                        '<span class=\"cookie-slider\"></span>' +
                        '</label>' +
                        '</div>' +
                        '<p>These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.</p>' +
                        '</div>' : '') +
                        
                        (this.settings.categories.marketing ? 
                        '<div class=\"cookie-category\">' +
                        '<div class=\"cookie-category-header\">' +
                        '<h4>Marketing Cookies</h4>' +
                        '<label class=\"cookie-switch\">' +
                        '<input type=\"checkbox\" id=\"marketing-toggle\" ' + (marketing ? 'checked' : '') + '>' +
                        '<span class=\"cookie-slider\"></span>' +
                        '</label>' +
                        '</div>' +
                        '<p>These cookies are used to deliver relevant advertisements and marketing campaigns to you.</p>' +
                        '</div>' : '') +
                        
                        (this.settings.categories.preferences ? 
                        '<div class=\"cookie-category\">' +
                        '<div class=\"cookie-category-header\">' +
                        '<h4>Preference Cookies</h4>' +
                        '<label class=\"cookie-switch\">' +
                        '<input type=\"checkbox\" id=\"preferences-toggle\" ' + (preferences ? 'checked' : '') + '>' +
                        '<span class=\"cookie-slider\"></span>' +
                        '</label>' +
                        '</div>' +
                        '<p>These cookies remember your preferences and settings to provide a personalized experience.</p>' +
                        '</div>' : '') +
                        
                        '</div>' +
                        '<div class=\"cookie-modal-footer\">' +
                        '<button class=\"cookie-btn cookie-btn-secondary\" onclick=\"CookieManager.acceptSelected()\">Save Settings</button>' +
                        '<button class=\"cookie-btn cookie-btn-primary\" onclick=\"CookieManager.acceptAll(); CookieManager.closeSettingsModal();\">Accept All</button>' +
                        '</div>' +
                        '</div>';
                },
                
                bindModalEvents: function() {
                    // Close modal on escape key
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            CookieManager.closeSettingsModal();
                        }
                    });
                },
                
                acceptSelected: function() {
                    this.setCookie(this.cookieName, 'accepted', this.settings.remember_days);
                    
                    // Get selected preferences
                    this.setCookieCategory('essential', true);
                    
                    const analyticsEl = document.getElementById('analytics-toggle');
                    if (analyticsEl) {
                        this.setCookieCategory('analytics', analyticsEl.checked);
                    }
                    
                    const marketingEl = document.getElementById('marketing-toggle');
                    if (marketingEl) {
                        this.setCookieCategory('marketing', marketingEl.checked);
                    }
                    
                    const preferencesEl = document.getElementById('preferences-toggle');
                    if (preferencesEl) {
                        this.setCookieCategory('preferences', preferencesEl.checked);
                    }
                    
                    this.closeSettingsModal();
                    this.hideBanner();
                    this.triggerEvent('cookieSettingsSaved');
                },
                
                closeSettingsModal: function() {
                    const modal = document.getElementById('cookie-settings-modal');
                    if (modal) {
                        modal.classList.remove('show');
                        setTimeout(() => {
                            modal.remove();
                        }, 300);
                    }
                },
                
                setCookieCategory: function(category, enabled) {
                    this.setCookie(this.categoryPrefix + category, enabled ? 'true' : 'false', this.settings.remember_days);
                },
                
                getCookieCategory: function(category, defaultValue) {
                    const value = this.getCookie(this.categoryPrefix + category);
                    return value === null ? defaultValue : value === 'true';
                },
                
                hideBanner: function() {
                    const banner = document.getElementById('cookie-banner');
                    if (banner) {
                        banner.classList.remove('show');
                        setTimeout(() => {
                            banner.remove();
                        }, 300);
                    }
                },
                
                setCookie: function(name, value, days) {
                    try {
                        const expires = new Date();
                        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
                        
                        let cookieString = name + '=' + encodeURIComponent(value) + ';expires=' + expires.toUTCString() + ';path=' + this.settings.path;
                        
                        if (this.settings.domain && this.settings.domain !== '') {
                            cookieString += ';domain=' + this.settings.domain;
                        }
                        
                        // Only add secure flag if setting is true AND we're on HTTPS
                        if (this.settings.secure && this.settings.secure !== '0' && window.location.protocol === 'https:') {
                            cookieString += ';secure';
                        }
                        
                        cookieString += ';samesite=' + this.settings.same_site;
                        
                        document.cookie = cookieString;
                    } catch (error) {
                        console.error('Error setting cookie:', error);
                    }
                },
                
                getCookie: function(name) {
                    try {
                        if (!document.cookie) return null;
                        
                        const nameEQ = name + '=';
                        const ca = document.cookie.split(';');
                        
                        for (let i = 0; i < ca.length; i++) {
                            let c = ca[i].trim(); // Use trim() instead of manual space removal
                            if (c.indexOf(nameEQ) === 0) {
                                const value = c.substring(nameEQ.length);
                                try {
                                    return decodeURIComponent(value);
                                } catch (decodeError) {
                                    console.warn('Failed to decode cookie value:', value);
                                    return value; // Return raw value if decoding fails
                                }
                            }
                        }
                        
                        return null;
                    } catch (error) {
                        console.error('Error getting cookie:', name, error);
                        return null;
                    }
                },
                
                // Public API methods
                getConsentStatus: function() {
                    return {
                        hasConsent: this.hasConsent(),
                        essential: this.getCookieCategory('essential', true),
                        analytics: this.getCookieCategory('analytics', false),
                        marketing: this.getCookieCategory('marketing', false),
                        preferences: this.getCookieCategory('preferences', false)
                    };
                },
                
                // Reset all cookie preferences
                resetConsent: function() {
                    // Remove consent cookie
                    this.deleteCookie(this.cookieName);
                    
                    // Remove category cookies
                    this.deleteCookie(this.categoryPrefix + 'essential');
                    this.deleteCookie(this.categoryPrefix + 'analytics');
                    this.deleteCookie(this.categoryPrefix + 'marketing');
                    this.deleteCookie(this.categoryPrefix + 'preferences');
                    
                    // Show banner again
                    setTimeout(() => {
                        this.showBanner();
                    }, 500);
                    
                    this.triggerEvent('cookiesReset');
                },
                
                // Delete a specific cookie
                deleteCookie: function(name) {
                    try {
                        // Try multiple deletion approaches to ensure cookie is cleared
                        const deletionStrings = [
                            name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=' + this.settings.path,
                            name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/',
                            name + '=;max-age=0;path=' + this.settings.path,
                            name + '=;max-age=0;path=/'
                        ];
                        
                        if (this.settings.domain && this.settings.domain !== '') {
                            deletionStrings.push(name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=' + this.settings.path + ';domain=' + this.settings.domain);
                            deletionStrings.push(name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/;domain=' + this.settings.domain);
                        }
                        
                        deletionStrings.forEach(function(cookieString) {
                            document.cookie = cookieString;
                        });
                        
                        console.log('Cookie deleted:', name);
                    } catch (error) {
                        console.error('Error deleting cookie:', error);
                    }
                },
                
                // Check if a specific cookie category is enabled
                isCategoryEnabled: function(category) {
                    return this.getCookieCategory(category, false);
                },
                
                // Enable/disable a specific cookie category
                setCategoryEnabled: function(category, enabled) {
                    if (category === 'essential') {
                        console.warn('Essential cookies cannot be disabled');
                        return false;
                    }
                    
                    this.setCookieCategory(category, enabled);
                    this.triggerEvent('cookieCategoryChanged', { category: category, enabled: enabled });
                    return true;
                },
                
                // Get debug information
                getDebugInfo: function() {
                    return {
                        settings: this.settings,
                        consent: this.getConsentStatus(),
                        allCookies: document.cookie.split(';').reduce(function(cookies, cookie) {
                            const parts = cookie.trim().split('=');
                            if (parts.length === 2) {
                                cookies[parts[0]] = decodeURIComponent(parts[1]);
                            }
                            return cookies;
                        }, {}),
                        cookieName: this.cookieName,
                        categoryPrefix: this.categoryPrefix
                    };
                },
                
                triggerEvent: function(eventName, additionalData) {
                    const event = new CustomEvent(eventName, {
                        detail: Object.assign({
                            settings: this.settings,
                            consent: this.getConsentStatus()
                        }, additionalData || {})
                    });
                    document.dispatchEvent(event);
                },
                
                bindEvents: function() {
                    // Make CookieManager globally available
                    window.CookieManager = this;
                    
                    // Add global method to show settings modal
                    window.showCookieSettings = function() {
                        CookieManager.showSettings();
                    };
                    
                    // Add global method to reset consent
                    window.resetCookieConsent = function() {
                        if (confirm('Are you sure you want to reset your cookie preferences? This will show the cookie banner again.')) {
                            CookieManager.resetConsent();
                        }
                    };
                }
            };
            
            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    CookieManager.init();
                });
            } else {
                CookieManager.init();
            }
        })();
        ";
    }
} 