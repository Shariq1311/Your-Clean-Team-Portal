<?php

return [
    // Main Menu & Settings
    'pwa_manager' => 'PWA Manager',
    'pwa_settings' => 'PWA Settings',
    'pwa_settings_description' => 'Configure Progressive Web App settings to enhance your website with app-like functionality.',
    'progressive_web_app' => 'Progressive Web App',
    'manage_pwa' => 'Manage PWA',
    
    // Global Settings
    'enable_pwa' => 'Enable PWA',
    'enable_pwa_description' => 'Turn on/off Progressive Web App functionality for your website.',
    'enable_pwa_help' => 'When enabled, your website will function as a Progressive Web App with offline capabilities.',
    
    // App Identity
    'app_identity' => 'App Identity',
    'app_name' => 'App Name',
    'app_name_description' => 'Full name of your Progressive Web App as it appears to users.',
    'app_name_help' => 'This will be displayed in the browser, app stores, and when users install your PWA.',
    'short_name' => 'Short Name',
    'short_name_description' => 'Short name for your PWA (maximum 12 characters).',
    'short_name_help' => 'Used on home screen and places where space is limited. Keep it under 12 characters.',
    'description' => 'Description',
    'description_description' => 'Brief description of your Progressive Web App.',
    'description_help' => 'This helps users understand what your app does when they install it.',
    
    // Appearance Settings
    'appearance_settings' => 'Appearance Settings',
    'theme_color' => 'Theme Color',
    'theme_color_description' => 'Primary color for your PWA interface and browser UI.',
    'theme_color_help' => 'This color will be used for the browser toolbar and UI elements when your PWA is active.',
    'background_color' => 'Background Color',
    'background_color_description' => 'Background color shown during app launch and splash screen.',
    'background_color_help' => 'Displayed while your PWA is loading, should match your app design.',
    
    // Display & Behavior
    'display_behavior' => 'Display & Behavior',
    'display_mode' => 'Display Mode',
    'display_mode_description' => 'How your PWA should be displayed when launched.',
    'display_standalone' => 'Standalone - Like a native app',
    'display_fullscreen' => 'Fullscreen - Hide all browser UI',
    'display_minimal_ui' => 'Minimal UI - Minimal browser controls',
    'display_browser' => 'Browser - Regular browser tab',
    'start_url' => 'Start URL',
    'start_url_description' => 'The URL that loads when your PWA is launched.',
    'start_url_help' => 'Usually "/" for homepage, but can be any URL within your domain.',
    
    // Orientation
    'orientation' => 'Screen Orientation',
    'orientation_description' => 'Preferred screen orientation for your PWA.',
    'orientation_any' => 'Any - Allow both orientations',
    'orientation_portrait' => 'Portrait - Vertical orientation',
    'orientation_landscape' => 'Landscape - Horizontal orientation',
    'scope' => 'PWA Scope (Navigation Control)',
    'scope_description' => 'Define the navigation scope of your PWA - CRITICAL for proper navigation.',
    'scope_help' => 'IMPORTANT: Keep this as "/" to allow navigation to all pages. If changed, users may not be able to navigate to other pages in your PWA!',
    
    // Features
    'pwa_features' => 'PWA Features',
    'show_install_button' => 'Show Install Button',
    'show_install_button_description' => 'Display an install button to prompt users to install your PWA.',
    'show_install_button_help' => 'Helps users discover and install your PWA to their home screen.',
    'init_delay' => 'Initialization Delay (ms)',
    'init_delay_help' => 'Delay in milliseconds before PWA initializes. Increase if conflicts with chatbots (1000ms = 1 second). Higher values prevent JavaScript conflicts.',
    'advanced_settings' => 'Advanced Settings',
    
    // Assets & Icons
    'assets_icons' => 'Assets & Icons',
    'pwa_logo' => 'PWA Logo',
    'pwa_logo_description' => 'Upload a 512x512 PNG logo for your PWA icons.',
    'pwa_logo_help' => 'This logo will be used for app icons, splash screens, and installation prompts.',
    'logo_requirements' => 'Logo Requirements',
    'logo_requirements_list' => [
        'Format: PNG only',
        'Size: 512x512 pixels (minimum)',
        'File size: Maximum 1MB',
        'Background: Should have solid background (transparent not recommended)',
        'Design: Simple, clear, and recognizable at small sizes'
    ],
    'upload_logo' => 'Upload Logo',
    'change_logo' => 'Change Logo',
    'remove_logo' => 'Remove Logo',
    'current_logo' => 'Current Logo',
    'no_logo_uploaded' => 'No logo uploaded yet',
    
    // Custom Icons
    'custom_icons' => 'Custom Icons',
    'custom_icons_description' => 'Advanced: Add additional custom icons in JSON format.',
    'custom_icons_help' => 'For advanced users who want to specify additional icon sizes or formats.',
    'custom_icons_example' => 'Example: [{"src": "/icon-192.png", "sizes": "192x192", "type": "image/png"}]',
    
    // Caching & Performance
    'caching_performance' => 'Caching & Performance',
    'cache_strategy' => 'Cache Strategy',
    'cache_strategy_description' => 'Choose how your PWA handles caching for offline functionality.',
    'cache_first' => 'Cache First - Fast loading, may show outdated content',
    'network_first' => 'Network First - Always fresh content when online',
    'stale_while_revalidate' => 'Stale While Revalidate - Best of both worlds',
    
    // Requirements & Status
    'requirements_status' => 'Requirements & Status',
    'pwa_requirements' => 'PWA Requirements',
    'requirement_https' => 'HTTPS Required',
    'requirement_https_desc' => 'Your website must be served over HTTPS for PWA functionality.',
    'requirement_package' => 'PWA Package',
    'requirement_package_desc' => 'Laravel PWA package must be properly installed.',
    'requirement_writable' => 'Public Directory Writable',
    'requirement_writable_desc' => 'Public directory must be writable for manifest updates.',
    'requirement_config' => 'PWA Configuration',
    'requirement_config_desc' => 'PWA configuration file must exist.',
    
    // Status Messages
    'requirement_met' => 'Requirement Met',
    'requirement_not_met' => 'Requirement Not Met',
    'all_requirements_met' => 'All requirements are met. Your PWA is ready!',
    'some_requirements_missing' => 'Some requirements are missing. Please fix them to enable PWA.',
    
    // Warnings
    'https_required_warning' => 'HTTPS is required for PWA functionality. Please enable SSL certificate.',
    'package_not_installed_warning' => 'Laravel PWA package is not properly installed or configured.',
    'public_not_writable_warning' => 'Public directory is not writable. Manifest updates may fail.',
    'config_missing_warning' => 'PWA configuration file is missing. Please run installation command.',
    
    // Success Messages
    'settings_saved_successfully' => 'PWA settings have been saved successfully!',
    'pwa_enabled_successfully' => 'Progressive Web App has been enabled successfully!',
    'pwa_disabled_successfully' => 'Progressive Web App has been disabled.',
    'logo_uploaded_successfully' => 'PWA logo has been uploaded successfully!',
    'manifest_updated_successfully' => 'PWA manifest has been updated successfully!',
    
    // Error Messages
    'validation_error' => 'Please correct the following errors and try again.',
    'logo_upload_failed' => 'Logo upload failed. Please try again.',
    'logo_upload_error' => 'An error occurred while uploading the logo.',
    'manifest_update_failed' => 'Failed to update PWA manifest. Please check permissions.',
    'field_required' => 'The :field field is required when PWA is enabled.',
    'short_name_too_long' => 'Short name must be 12 characters or less.',
    'invalid_color_format' => 'Invalid color format for :field. Use hex format (#000000).',
    'invalid_start_url' => 'Invalid start URL format. Use "/" or a valid URL.',
    'settings_save_error' => 'An error occurred while saving settings.',
    
    // Installation & Testing
    'installation_testing' => 'Installation & Testing',
    'test_pwa' => 'Test PWA',
    'test_manifest' => 'Test Manifest',
    'test_service_worker' => 'Test Service Worker',
    'install_pwa' => 'Install PWA',
    'install_instructions' => 'Installation Instructions',
    'install_instructions_list' => [
        'Open your website in a supported browser',
        'Look for the install icon in the address bar',
        'Click the install button or use browser menu',
        'Follow the installation prompts',
        'Your PWA will be added to home screen/start menu'
    ],
    
    // Browser Support
    'browser_support' => 'Browser Support',
    'supported_browsers' => 'Supported Browsers',
    'chrome_support' => 'Chrome (Recommended)',
    'firefox_support' => 'Firefox',
    'safari_support' => 'Safari (iOS 11.3+)',
    'edge_support' => 'Microsoft Edge',
    'samsung_support' => 'Samsung Internet',
    
    // Advanced Settings
    'advanced_settings' => 'Advanced Settings',
    'advanced_warning' => 'Advanced settings are for experienced users. Changes may affect PWA functionality.',
    'manifest_properties' => 'Manifest Properties',
    'service_worker_settings' => 'Service Worker Settings',
    
    // Help & Documentation
    'help_documentation' => 'Help & Documentation',
    'what_is_pwa' => 'What is a Progressive Web App?',
    'pwa_explanation' => 'A Progressive Web App (PWA) combines the best features of web and mobile apps, providing app-like experiences directly through web browsers.',
    'pwa_benefits' => 'PWA Benefits',
    'pwa_benefits_list' => [
        'Offline functionality',
        'Fast loading times',
        'App-like user experience',
        'Push notifications',
        'Home screen installation',
        'Automatic updates',
        'Cross-platform compatibility',
        'Improved engagement'
    ],
    'need_help' => 'Need Help?',
    'documentation_link' => 'View Documentation',
    'support_contact' => 'Contact Support',
    
    // Actions & Buttons
    'save_settings' => 'Save PWA Settings',
    'reset_settings' => 'Reset to Defaults',
    'enable_pwa_now' => 'Enable PWA',
    'disable_pwa_now' => 'Disable PWA',
    'upload_new_logo' => 'Upload New Logo',
    'test_configuration' => 'Test Configuration',
    'update_manifest' => 'Update Manifest',
    'check_requirements' => 'Check Requirements',
    'refresh_status' => 'Refresh Status',
    
    // Form Labels & Placeholders
    'enter_app_name' => 'Enter your app name',
    'enter_short_name' => 'Enter short name (max 12 chars)',
    'enter_description' => 'Describe what your app does',
    'choose_theme_color' => 'Choose theme color',
    'choose_background_color' => 'Choose background color',
    'enter_start_url' => 'Enter start URL (e.g., /)',
    'select_display_mode' => 'Select display mode',
    'select_orientation' => 'Select orientation',
    'select_cache_strategy' => 'Select cache strategy',
    
    // Tooltips
    'tooltip_app_name' => 'The full name of your Progressive Web App',
    'tooltip_short_name' => 'Short name used on home screen (12 characters max)',
    'tooltip_theme_color' => 'Color used for browser UI when PWA is active',
    'tooltip_background_color' => 'Color shown during app launch',
    'tooltip_display_mode' => 'How your PWA appears when launched',
    'tooltip_start_url' => 'Initial page when PWA opens',
    'tooltip_install_button' => 'Show button to help users install your PWA',
    
    // Status & Progress
    'pwa_status' => 'PWA Status',
    'status_enabled' => 'Enabled',
    'status_disabled' => 'Disabled',
    'status_ready' => 'Ready',
    'status_not_ready' => 'Not Ready',
    'configuration_complete' => 'Configuration Complete',
    'configuration_incomplete' => 'Configuration Incomplete',
    
    // File Upload
    'drag_drop_logo' => 'Drag and drop your logo here, or click to browse',
    'file_too_large' => 'File is too large. Maximum size is 1MB.',
    'invalid_file_type' => 'Invalid file type. Only PNG files are allowed.',
    'invalid_dimensions' => 'Invalid image dimensions. Minimum size is 512x512 pixels.',
    'upload_in_progress' => 'Uploading logo...',
    'upload_success' => 'Logo uploaded successfully!',
    'upload_error' => 'Upload failed. Please try again.',
    
    // Confirmation Messages
    'confirm_disable_pwa' => 'Are you sure you want to disable PWA functionality?',
    'confirm_reset_settings' => 'Are you sure you want to reset all PWA settings to defaults?',
    'confirm_remove_logo' => 'Are you sure you want to remove the current logo?',
    
    // Technical Information
    'technical_info' => 'Technical Information',
    'manifest_url' => 'Manifest URL',
    'service_worker_url' => 'Service Worker URL',
    'last_updated' => 'Last Updated',
    'cache_version' => 'Cache Version',
    'installation_count' => 'Installations',
]; 