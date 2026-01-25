# PWA Manager Plugin - Setup Instructions

## Quick Start

Your PWA Manager plugin is now ready to use! Follow these steps to get started:

### 1. Initial Setup (One-time only)

Since the `erag/laravel-pwa` package is already installed, run the PWA installation command:

```bash
php artisan erag:install-pwa
```

This creates the necessary PWA configuration files.

### 2. Access the Admin Interface

1. Go to your admin dashboard
2. Navigate to **Settings > PWA Manager**
3. You'll see the PWA settings page with all configuration options

### 3. Configure Your PWA

1. **Enable PWA**: Use the toggle switch at the top
2. **Required Settings** (must fill when enabling):
   - App Name: Full name of your PWA
   - Short Name: Max 12 characters for home screen
3. **Optional Settings**:
   - Description
   - Theme & Background Colors
   - Display Mode
   - Start URL
   - Logo Upload (512x512 PNG)

### 4. Verify Requirements

The settings page shows requirement status:
- ✅ HTTPS Required (must be enabled for PWA)
- ✅ PWA Package (should be green)
- ✅ Public Directory Writable
- ⚠️ If any requirements are missing, fix them first

### 5. Save and Test

1. Save your settings
2. Visit your website
3. Check browser developer tools > Application tab > Manifest
4. Look for install prompt in supported browsers

## Requirements Checklist

- [ ] HTTPS enabled (required for PWA functionality)
- [ ] Public directory is writable
- [ ] `erag/laravel-pwa` package installed
- [ ] PWA configuration command run: `php artisan erag:install-pwa`

## File Locations

After setup, these files should exist:
- `/public/manifest.json` - PWA manifest (auto-generated)
- `/public/serviceworker.js` - Service worker (auto-generated)
- `/public/logo.png` - PWA logo (if uploaded)

## Testing Your PWA

1. **Chrome DevTools**:
   - F12 > Application tab
   - Check Manifest section
   - Check Service Workers section

2. **Installation Test**:
   - Visit your site in Chrome/Edge
   - Look for install icon in address bar
   - Try installing as PWA

3. **Mobile Test**:
   - Visit on mobile device
   - Look for "Add to Home Screen" option
   - Test offline functionality

## Troubleshooting

### PWA not working?
- Ensure HTTPS is properly configured
- Check browser console for errors
- Verify manifest.json is accessible at `/manifest.json`

### Installation prompt not showing?
- Must be on HTTPS
- User must interact with page first
- PWA criteria must be met (manifest + service worker)

### Manifest errors?
- Check public directory permissions
- Re-run: `php artisan erag:install-pwa`
- Save PWA settings again to regenerate

## Need Help?

1. Check the requirements section in PWA Manager settings
2. Review browser console for specific errors
3. Verify all files mentioned above exist
4. Check `DOCUMENTATION.md` for detailed technical information

## Success!

Once working, your users will be able to:
- Install your website as an app
- Use it offline
- Get app-like experience
- Receive faster loading times

The PWA functionality integrates seamlessly with your existing theme and requires no additional code changes. 