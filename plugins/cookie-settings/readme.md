# Cookie Settings Plugin

A comprehensive cookie consent and settings plugin for Laravel CMS with GDPR/CCPA compliance features.

## Features

### Core Functionality
- **Cookie Consent Banner**: Fully customizable cookie consent popup
- **GDPR/CCPA Compliance**: Built-in compliance features for privacy regulations
- **Multiple Themes**: Light, dark, and custom theme options
- **Flexible Positioning**: Top/bottom, left/right positioning options
- **Responsive Design**: Mobile-friendly cookie banners
- **Auto-hide Options**: Configurable auto-accept functionality

### Cookie Categories
- **Essential Cookies**: Required cookies for site functionality
- **Analytics Cookies**: Tracking and website usage cookies
- **Marketing Cookies**: Advertising and marketing cookies  
- **Preference Cookies**: User preference and settings cookies

### Customization Options
- **Content Settings**: Fully customizable text and messages
- **Styling Options**: Color customization, border radius, shadows
- **Advanced Settings**: Cookie domain, path, security settings
- **Custom CSS**: Add your own CSS for complete customization

### Admin Features
- **Easy Configuration**: Settings page in admin panel
- **Real-time Preview**: See changes as you configure
- **Translation Ready**: Multi-language support
- **Configuration Tips**: Built-in help and compliance tips

## Installation

1. Place the plugin in your `plugins` directory:
```
plugins/cookie-settings/
```

2. Register the service provider in your Laravel application (if not auto-discovered):
```php
// config/app.php
'providers' => [
    // ...
    Mojahid\CookieSettings\Providers\CookieServiceProvider::class,
],
```

3. The plugin will automatically register routes, views, and configurations.

## Configuration

### Admin Panel
Navigate to **Settings → Cookie Settings** in your admin panel to configure:

1. **General Settings**:
   - Enable/disable cookie banner
   - Set banner position and theme
   - Configure auto-hide behavior
   - Set remember duration

2. **Content Settings**:
   - Customize banner title and message
   - Set button texts
   - Configure privacy policy link

3. **Cookie Categories**:
   - Enable/disable cookie categories
   - Configure tracking and marketing cookies

4. **Styling**:
   - Customize colors and appearance
   - Set border radius and shadows
   - Add custom CSS

5. **Advanced Settings**:
   - Configure cookie domain and path
   - Set security options
   - SameSite policy configuration

### Default Configuration
```php
// Default settings applied on first installation
'cookie_enabled' => true,
'cookie_position' => 'bottom',
'cookie_theme' => 'light',
'cookie_remember_days' => 30,
'cookie_title' => 'We use cookies',
'cookie_message' => 'This website uses cookies to improve your experience...',
```

## Usage

### Frontend Integration
The cookie banner automatically appears to visitors who haven't given consent. The plugin provides:

- **Automatic Banner Display**: Shows to new visitors
- **Consent Management**: Remembers user choices
- **Event Triggers**: JavaScript events for custom integration

### JavaScript Events
The plugin triggers custom events for developers:

```javascript
// Cookie accepted event
document.addEventListener('cookiesAccepted', function(e) {
    console.log('Cookies accepted', e.detail.consent);
    // Enable analytics/tracking scripts
});

// Cookie declined event  
document.addEventListener('cookiesDeclined', function(e) {
    console.log('Cookies declined', e.detail.consent);
    // Disable non-essential tracking
});

// Cookie settings saved event
document.addEventListener('cookieSettingsSaved', function(e) {
    console.log('Cookie settings updated', e.detail.consent);
    // Adjust scripts based on new preferences
});

// Cookie preferences reset event
document.addEventListener('cookiesReset', function(e) {
    console.log('Cookie preferences reset');
    // Clean up any tracking scripts
});

// Cookie category changed event
document.addEventListener('cookieCategoryChanged', function(e) {
    console.log('Category changed:', e.detail.category, e.detail.enabled);
    // Handle specific category changes
});
```

### Cookie Management API
The plugin provides a comprehensive JavaScript API:

```javascript
// Check consent status
if (window.CookieManager && window.CookieManager.hasConsent()) {
    // User has given consent
}

// Get detailed consent information
const consent = window.CookieManager.getConsentStatus();
console.log(consent);
// Returns: { hasConsent: true, essential: true, analytics: false, marketing: true, preferences: false }

// Check specific cookie category
if (window.CookieManager.isCategoryEnabled('analytics')) {
    // Analytics cookies are enabled
    gtag('config', 'GA_MEASUREMENT_ID');
}

// Enable/disable specific categories programmatically
window.CookieManager.setCategoryEnabled('analytics', true);

// Show cookie settings modal programmatically
window.showCookieSettings();

// Reset all cookie preferences
window.resetCookieConsent();

// Get debug information
console.log(window.CookieManager.getDebugInfo());
```

## Compliance Features

### GDPR Compliance
- Clear consent mechanisms
- Easy-to-understand language
- Granular cookie controls
- Privacy policy integration
- User choice persistence

### CCPA Compliance  
- Clear disclosure of data collection
- Opt-out mechanisms
- Consumer rights information

### Best Practices
- Non-intrusive banner design
- Clear categorization of cookies
- Easy consent withdrawal
- Regular consent refresh

## Customization

### Custom Themes
Create custom themes by setting `cookie_theme` to 'custom' and using custom CSS:

```css
#cookie-banner.custom-theme {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}
```

### Custom Positioning
Position the banner anywhere using custom CSS:
```css
#cookie-banner.custom-position {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
```

## Troubleshooting

### Common Issues

1. **Banner Not Showing**:
   - Ensure `cookie_enabled` is set to `true`
   - Check browser console for JavaScript errors
   - Verify the service provider is registered

2. **Settings Not Saving**:
   - Check file permissions on storage directory
   - Verify database connection
   - Check error logs

3. **Styling Issues**:
   - Clear browser cache
   - Check for CSS conflicts
   - Verify custom CSS syntax

### Debug Mode
Enable debug mode to see detailed cookie information:
```javascript
// In browser console
window.CookieManager.settings
```

## License

This plugin is licensed under the MIT License.

## Support

For support and documentation, please visit the plugin documentation or contact support.

## Changelog

### Version 1.0.0
- Initial release
- Full cookie consent functionality
- GDPR/CCPA compliance features
- Admin panel integration
- Multiple theme support
- Responsive design 