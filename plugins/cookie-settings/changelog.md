# Changelog

## [1.0.1] - 2024-12-27

### Fixed
- **MAJOR**: Fixed cookie persistence issue - banner no longer shows repeatedly after accepting/declining
- **MAJOR**: Fixed JavaScript error "this.acceptCookies is not a function" in auto-hide functionality
- **MAJOR**: Fixed secure cookie flag - only applied when on HTTPS protocol
- Fixed boolean value handling from admin settings (string "0"/"1" properly converted)
- Fixed force_consent logic to properly show/hide decline button
- Fixed cookie deletion logic with multiple deletion approaches
- Improved cookie reading function with better error handling and encoding
- Enhanced debugging capabilities in admin panel with comprehensive debug info

### Improved
- Better initialization timing to prevent race conditions
- More robust cookie encoding/decoding with fallback handling
- Enhanced admin testing tools with console logging
- Improved debug information display with detailed cookie analysis
- Better error handling throughout the JavaScript API

## [1.0.0] - 2024-12-27

### Added
- Initial release of Cookie Settings Plugin
- Cookie consent banner system with GDPR/CCPA compliance
- Admin panel settings integration
- Multiple themes and positioning options
- Customizable styling and content
- JavaScript API for developers
- Translation support 