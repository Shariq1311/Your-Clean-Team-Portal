<form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
    <input type="hidden" name="form" value="cookie-settings">

    <div class="card">
        <div class="card-header bg-transparent justify-content-end align-items-center">
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal cancel-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    {{ trans('cms::app.reset') }}
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- General Settings -->
                <div class="col-md-6">
                    <h5>{{ trans('cookie::content.general_settings') }}</h5>

                    {{ Field::checkbox(trans('cookie::content.enable_cookie_banner'), 'cookie_enabled', [
                        'checked' => get_config('cookie_enabled', true)
                    ]) }}

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_position">{{ trans('cookie::content.banner_position') }}</label>
                        <select name="cookie_position" id="cookie_position" class="form-control select2">
                            <option value="bottom" @if(get_config('cookie_position', 'bottom') == 'bottom') selected @endif>
                                {{ trans('cookie::content.bottom_right') }}
                            </option>
                            <option value="bottom-left" @if(get_config('cookie_position') == 'bottom-left') selected @endif>
                                {{ trans('cookie::content.bottom_left') }}
                            </option>
                            <option value="top" @if(get_config('cookie_position') == 'top') selected @endif>
                                {{ trans('cookie::content.top_right') }}
                            </option>
                            <option value="top-left" @if(get_config('cookie_position') == 'top-left') selected @endif>
                                {{ trans('cookie::content.top_left') }}
                            </option>
                        </select>
                        <p class="description mt-2">{{ trans('cookie::content.banner_position_help') }}</p>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_theme">{{ trans('cookie::content.banner_theme') }}</label>
                        <select name="cookie_theme" id="cookie_theme" class="form-control select2">
                            <option value="light" @if(get_config('cookie_theme', 'light') == 'light') selected @endif>
                                {{ trans('cookie::content.light_theme') }}
                            </option>
                            <option value="dark" @if(get_config('cookie_theme') == 'dark') selected @endif>
                                {{ trans('cookie::content.dark_theme') }}
                            </option>
                            <option value="custom" @if(get_config('cookie_theme') == 'custom') selected @endif>
                                {{ trans('cookie::content.custom_theme') }}
                            </option>
                        </select>
                    </div>

                    {{ Field::checkbox(trans('cookie::content.auto_hide_banner'), 'cookie_auto_hide', [
                        'checked' => get_config('cookie_auto_hide', false)
                    ]) }}

                    {{ Field::text(trans('cookie::content.auto_hide_delay'), 'cookie_hide_delay', [
                        'value' => get_config('cookie_hide_delay', 5),
                        'type' => 'number'
                    ]) }}

                    {{ Field::text(trans('cookie::content.remember_choice_days'), 'cookie_remember_days', [
                        'value' => get_config('cookie_remember_days', 30),
                        'type' => 'number'
                    ]) }}

                    {{ Field::checkbox(trans('cookie::content.force_consent'), 'cookie_force_consent', [
                        'checked' => get_config('cookie_force_consent', false)
                    ]) }}
                </div>

                <!-- Content Settings -->
                <div class="col-md-6">
                    <h5>{{ trans('cookie::content.content_settings') }}</h5>

                    {{ Field::text(trans('cookie::content.banner_title'), 'cookie_title', [
                        'value' => get_config('cookie_title', 'We use cookies')
                    ]) }}

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_message">{{ trans('cookie::content.banner_message') }}</label>
                        <textarea class="form-control" name="cookie_message" id="cookie_message" rows="3">{{ get_config('cookie_message', 'This website uses cookies to improve your experience. By continuing to use this site, you consent to our use of cookies.') }}</textarea>
                        <p class="description">{{ trans('cookie::content.banner_message_help') }}</p>
                    </div>

                    {{ Field::text(trans('cookie::content.accept_button_text'), 'cookie_accept_text', [
                        'value' => get_config('cookie_accept_text', 'Accept All')
                    ]) }}

                    {{ Field::text(trans('cookie::content.decline_button_text'), 'cookie_decline_text', [
                        'value' => get_config('cookie_decline_text', 'Decline')
                    ]) }}

                    {{ Field::text(trans('cookie::content.settings_button_text'), 'cookie_settings_text', [
                        'value' => get_config('cookie_settings_text', 'Cookie Settings')
                    ]) }}

                    {{ Field::text(trans('cookie::content.privacy_policy_link'), 'cookie_policy_link', [
                        'value' => get_config('cookie_policy_link', '')
                    ]) }}

                    {{ Field::text(trans('cookie::content.privacy_policy_text'), 'cookie_policy_text', [
                        'value' => get_config('cookie_policy_text', 'Privacy Policy')
                    ]) }}
                </div>
            </div>

            <div class="row mt-4">
                <!-- Cookie Categories -->
                <div class="col-md-6">
                    <h5>{{ trans('cookie::content.cookie_categories') }}</h5>

                    {{ Field::checkbox(trans('cookie::content.essential_cookies'), 'cookie_essential_enabled', [
                        'checked' => get_config('cookie_essential_enabled', true)
                    ]) }}
                    <p class="description">{{ trans('cookie::content.essential_cookies_desc') }}</p>

                    {{ Field::checkbox(trans('cookie::content.analytics_cookies'), 'cookie_analytics_enabled', [
                        'checked' => get_config('cookie_analytics_enabled', false)
                    ]) }}
                    <p class="description">{{ trans('cookie::content.analytics_cookies_desc') }}</p>

                    {{ Field::checkbox(trans('cookie::content.marketing_cookies'), 'cookie_marketing_enabled', [
                        'checked' => get_config('cookie_marketing_enabled', false)
                    ]) }}
                    <p class="description">{{ trans('cookie::content.marketing_cookies_desc') }}</p>

                    {{ Field::checkbox(trans('cookie::content.preference_cookies'), 'cookie_preferences_enabled', [
                        'checked' => get_config('cookie_preferences_enabled', false)
                    ]) }}
                    <p class="description">{{ trans('cookie::content.preference_cookies_desc') }}</p>
                </div>

                <!-- Styling Settings -->
                <div class="col-md-6">
                    <h5>{{ trans('cookie::content.styling_settings') }}</h5>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_banner_bg_color">{{ trans('cookie::content.banner_background_color') }}</label>
                        <input type="color" name="cookie_banner_bg_color" class="form-control form-control-color" id="cookie_banner_bg_color" value="{{ get_config('cookie_banner_bg_color', '#ffffff') }}">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_banner_text_color">{{ trans('cookie::content.banner_text_color') }}</label>
                        <input type="color" name="cookie_banner_text_color" class="form-control form-control-color" id="cookie_banner_text_color" value="{{ get_config('cookie_banner_text_color', '#333333') }}">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_button_bg_color">{{ trans('cookie::content.button_background_color') }}</label>
                        <input type="color" name="cookie_button_bg_color" class="form-control form-control-color" id="cookie_button_bg_color" value="{{ get_config('cookie_button_bg_color', '#007bff') }}">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_button_text_color">{{ trans('cookie::content.button_text_color') }}</label>
                        <input type="color" name="cookie_button_text_color" class="form-control form-control-color" id="cookie_button_text_color" value="{{ get_config('cookie_button_text_color', '#ffffff') }}">
                    </div>

                    {{ Field::text(trans('cookie::content.border_radius'), 'cookie_border_radius', [
                        'value' => get_config('cookie_border_radius', '8px')
                    ]) }}

                    {{ Field::text(trans('cookie::content.box_shadow'), 'cookie_box_shadow', [
                        'value' => get_config('cookie_box_shadow', '0 4px 15px rgba(0,0,0,0.2)')
                    ]) }}
                </div>
            </div>

            <div class="row mt-4">
                <!-- Advanced Settings -->
                <div class="col-md-12">
                    <h5>{{ trans('cookie::content.advanced_settings') }}</h5>

                    <div class="row">
                        <div class="col-md-6">
                            {{ Field::text(trans('cookie::content.cookie_domain'), 'cookie_domain', [
                                'value' => get_config('cookie_domain', '')
                            ]) }}

                            {{ Field::text(trans('cookie::content.cookie_path'), 'cookie_path', [
                                'value' => get_config('cookie_path', '/')
                            ]) }}

                            {{ Field::checkbox(trans('cookie::content.secure_cookies'), 'cookie_secure', [
                                'checked' => get_config('cookie_secure', false)
                            ]) }}
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="cookie_same_site">{{ trans('cookie::content.same_site') }}</label>
                                <select name="cookie_same_site" id="cookie_same_site" class="form-control select2">
                                    <option value="None" @if(get_config('cookie_same_site', 'Lax') == 'None') selected @endif>None</option>
                                    <option value="Lax" @if(get_config('cookie_same_site', 'Lax') == 'Lax') selected @endif>Lax</option>
                                    <option value="Strict" @if(get_config('cookie_same_site', 'Lax') == 'Strict') selected @endif>Strict</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="cookie_custom_css">{{ trans('cookie::content.custom_css') }}</label>
                        <textarea class="form-control" name="cookie_custom_css" id="cookie_custom_css" rows="6" style="font-family: monospace;">{{ get_config('cookie_custom_css', '') }}</textarea>
                        <p class="description">{{ trans('cookie::content.custom_css_help') }}</p>
                    </div>
                </div>
            </div>

            @if(config('app.debug'))
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ trans('cookie::content.preview_banner') }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">{{ trans('cookie::content.preview_help') }}</p>
                                <div class="d-flex gap-2 mb-3">
                                    <button type="button" class="btn btn-outline-primary" onclick="testCookieBanner()">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg> Preview Banner
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="resetCookieTest()">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-refresh"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg> Reset Test
                                    </button>
                                    <button type="button" class="btn btn-outline-info" onclick="showCookieDebug()">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bug-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.884 5.873a3 3 0 0 1 5.116 2.127v1" /><path d="M13 9h3a6 6 0 0 1 1 3v1m-.298 3.705a5 5 0 0 1 -9.702 -1.705v-3a6 6 0 0 1 1 -3h1" /><path d="M3 13h4" /><path d="M17 13h4" /><path d="M12 20v-6" /><path d="M4 19l3.35 -2" /><path d="M4 7l3.75 2.4" /><path d="M20 7l-3.75 2.4" /><path d="M3 3l18 18" /></svg> Debug Info
                                    </button>
                                </div>
                                <div id="cookie-debug-info" style="display: none;">
                                    <div class="alert alert-secondary">
                                        <h6>Debug Information:</h6>
                                        <pre id="debug-content" style="font-size: 12px; max-height: 200px; overflow-y: auto;"></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Configuration Tips -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">{{ trans('cookie::content.config_tips') }}</h6>
                        <ul class="mb-0 small">
                            <li>{{ trans('cookie::content.tip_gdpr_compliance') }}</li>
                            <li>{{ trans('cookie::content.tip_force_consent') }}</li>
                            <li>{{ trans('cookie::content.tip_remember_days') }}</li>
                            <li>{{ trans('cookie::content.tip_position') }}</li>
                            <li>{{ trans('cookie::content.tip_auto_hide') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <script>
                function testCookieBanner() {
                    console.log('Testing cookie banner...');
                    // Reset cookies to test banner
                    if (window.CookieManager) {
                        console.log('Using CookieManager.resetConsent()');
                        window.CookieManager.resetConsent();
                    } else {
                        console.log('CookieManager not available, using manual reset');
                        // Fallback if CookieManager not loaded
                        const cookies = ['cookie_consent', 'cookie_category_essential', 'cookie_category_analytics', 'cookie_category_marketing', 'cookie_category_preferences'];
                        cookies.forEach(function(cookie) {
                            document.cookie = cookie + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 100);
                    }
                }
                
                function resetCookieTest() {
                    if (confirm('This will reset all cookie preferences and reload the page. Continue?')) {
                        // Clear all cookie-related cookies
                        const cookies = ['cookie_consent', 'cookie_category_essential', 'cookie_category_analytics', 'cookie_category_marketing', 'cookie_category_preferences'];
                        cookies.forEach(function(cookie) {
                            document.cookie = cookie + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
                        });
                        location.reload();
                    }
                }
                
                function showCookieDebug() {
                    const debugDiv = document.getElementById('cookie-debug-info');
                    const debugContent = document.getElementById('debug-content');
                    
                    if (debugDiv.style.display === 'none') {
                        let debugInfo = {
                            timestamp: new Date().toISOString(),
                            userAgent: navigator.userAgent,
                            isHTTPS: window.location.protocol === 'https:',
                            domain: window.location.hostname,
                            path: window.location.pathname,
                            cookieManagerLoaded: typeof window.CookieManager !== 'undefined',
                            currentCookies: {},
                            cookieString: document.cookie || 'No cookies found'
                        };
                        
                        // Get current cookies
                        if (document.cookie) {
                            document.cookie.split(';').forEach(function(cookie) {
                                const parts = cookie.trim().split('=');
                                if (parts.length >= 2) {
                                    const name = parts[0];
                                    const value = parts.slice(1).join('='); // Handle values with = in them
                                    try {
                                        debugInfo.currentCookies[name] = {
                                            raw: value,
                                            decoded: decodeURIComponent(value)
                                        };
                                    } catch(e) {
                                        debugInfo.currentCookies[name] = {
                                            raw: value,
                                            decoded: 'Failed to decode',
                                            error: e.message
                                        };
                                    }
                                }
                            });
                        }
                        
                        // Get CookieManager debug info if available
                        if (window.CookieManager) {
                            try {
                                debugInfo.cookieManagerStatus = {
                                    hasConsent: window.CookieManager.hasConsent(),
                                    consentStatus: window.CookieManager.getConsentStatus()
                                };
                                
                                if (typeof window.CookieManager.getDebugInfo === 'function') {
                                    debugInfo.cookieManager = window.CookieManager.getDebugInfo();
                                }
                            } catch(e) {
                                debugInfo.cookieManagerError = e.message;
                            }
                        }
                        
                        debugContent.textContent = JSON.stringify(debugInfo, null, 2);
                        debugDiv.style.display = 'block';
                    } else {
                        debugDiv.style.display = 'none';
                    }
                }
                
                // Auto-refresh debug info every 5 seconds when visible
                setInterval(function() {
                    const debugDiv = document.getElementById('cookie-debug-info');
                    if (debugDiv && debugDiv.style.display !== 'none') {
                        showCookieDebug();
                        showCookieDebug(); // Call twice to refresh
                    }
                }, 5000);
            </script>
        </div>

        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        {{ trans('cms::app.save') }}
                    </button>

                    <button type="reset" class="btn btn-teal cancel-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                        {{ trans('cms::app.reset') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form> 