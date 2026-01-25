# PWA Manager Plugin for Your Clean Team CMS

A comprehensive Progressive Web App (PWA) management plugin for Your Clean Team CMS that provides complete PWA functionality with an intuitive admin interface.

## Features

✅ **Admin Dashboard Integration** - Complete PWA settings management from admin panel  
✅ **Dynamic Manifest Generation** - Auto-generate and update manifest.json based on settings  
✅ **Service Worker Management** - Automatic service worker registration and updates  
✅ **Logo Upload & Management** - Upload and manage PWA icons through admin interface  
✅ **Real-time Toggle** - Enable/disable PWA functionality instantly  
✅ **Responsive Design** - Works perfectly on all devices  
✅ **HTTPS Ready** - Secure PWA implementation  
✅ **Translation Ready** - Multi-language support  
✅ **Theme Integration** - Seamless integration with existing theme system  

## Requirements

- PHP ^8.1
- Laravel ^9.0|^10.0|^11.0
- Your Clean Team CMS
- HTTPS enabled (required for PWA functionality)
- `erag/laravel-pwa` package (automatically handled)

## Installation

The plugin is already installed in your Your Clean Team CMS. No additional installation required.

## Configuration

1. Navigate to **Admin Dashboard > Settings > PWA Manager**
2. Enable PWA functionality using the toggle switch
3. Configure your PWA settings:
   - App Name & Short Name
   - Description & Colors
   - Display Mode & Start URL
   - Upload PWA Logo (512x512 PNG)
4. Save settings to automatically update manifest.json

## PWA Settings Available

### Basic Settings
- **Enable/Disable PWA** - Toggle PWA functionality
- **App Name** - Full application name
- **Short Name** - Short name for home screen (max 12 chars)
- **Description** - App description for users

### Appearance
- **Theme Color** - Primary color for PWA interface
- **Background Color** - Background color for splash screen
- **Display Mode** - How the PWA should display (standalone, fullscreen, etc.)
- **Start URL** - Initial URL when PWA is launched

### Assets
- **PWA Logo** - Upload 512x512 PNG logo for PWA icons
- **Install Button** - Show/hide install prompt button

## Technical Details

The plugin automatically handles:

- Manifest.json generation and updates
- Service worker registration
- PWA meta tags injection
- Install prompts and offline functionality
- Caching strategies for better performance

## How It Works

1. **Frontend Integration**: Automatically injects PWA meta tags and service worker when enabled
2. **Admin Management**: Complete settings management through admin dashboard
3. **Dynamic Updates**: Real-time manifest updates based on admin settings
4. **Theme Compatibility**: Works with all existing themes without modifications

## Browser Support

- Chrome/Chromium browsers
- Firefox
- Safari (iOS 11.3+)
- Edge
- Samsung Internet

## Security

- HTTPS requirement enforced
- Secure service worker implementation
- Safe file upload handling
- XSS protection for all inputs

## Support

For issues and support, please contact the development team or create an issue in the project repository.

## Version

Current Version: 1.0.0

## License

MIT License - feel free to use and modify as needed. 