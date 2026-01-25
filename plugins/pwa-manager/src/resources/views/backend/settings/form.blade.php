<form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax" enctype="multipart/form-data">
    <input type="hidden" name="form" value="pwa-manager">

    <div class="card">
        <div class="card-header bg-transparent justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="card-title mb-0">{{ trans('pwa::content.pwa_settings') }}</h4>
                <div class="ms-3">
                    <div class="form-check form-switch">
                        {{ Field::checkbox(trans('pwa::content.enable_pwa'), 'pwa_enabled', [
                                'checked' => get_config('pwa_enabled', false),
                                'class' => 'provider-toggle',
                                'data-provider' => 'pwa_enabled',
                            ]) }}
                    </div>
                </div>
            </div>
            <div class="actions-buttons">
                <button type="submit" class="btn btn-tabler me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M14 4l0 4l-6 0l0 -4" />
                    </svg>
                    {{ trans('cms::app.save') }}
                </button>
                <button type="reset" class="btn btn-teal cancel-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
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
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">{{ trans('pwa::content.what_is_pwa') }}</h6>
                        <p class="mb-0">{{ trans('pwa::content.pwa_explanation') }}</p>
                    </div>

                    {{-- App Identity --}}
                    <h5>{{ trans('pwa::content.app_identity') }}</h5>

                    <div class="form-group">
                        <label class="col-form-label" for="pwa_app_name">{{ trans('pwa::content.app_name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="pwa_app_name" class="form-control" id="pwa_app_name"
                            value="{{ get_config('pwa_app_name', get_config('title', '')) }}" 
                            placeholder="{{ trans('pwa::content.enter_app_name') }}" required>
                        <p class="description mt-2">{{ trans('pwa::content.app_name_help') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_short_name">{{ trans('pwa::content.short_name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="pwa_short_name" class="form-control" id="pwa_short_name"
                                    value="{{ get_config('pwa_short_name', 'App') }}" maxlength="12" 
                                    placeholder="{{ trans('pwa::content.enter_short_name') }}" required>
                                <p class="description mt-2">{{ trans('pwa::content.short_name_help') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_start_url">{{ trans('pwa::content.start_url') }}</label>
                                <input type="text" name="pwa_start_url" class="form-control" id="pwa_start_url"
                                    value="{{ get_config('pwa_start_url', '/') }}" 
                                    placeholder="{{ trans('pwa::content.enter_start_url') }}">
                                <p class="description mt-2">{{ trans('pwa::content.start_url_help') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="pwa_description">{{ trans('pwa::content.description') }}</label>
                        <textarea class="form-control" name="pwa_description" id="pwa_description" rows="3"
                            placeholder="{{ trans('pwa::content.enter_description') }}">{{ get_config('pwa_description', get_config('description', '')) }}</textarea>
                        <p class="description mt-2">{{ trans('pwa::content.description_help') }}</p>
                    </div>

                    {{-- Appearance Settings --}}
                    <h5 class="mt-4">{{ trans('pwa::content.appearance_settings') }}</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_theme_color">{{ trans('pwa::content.theme_color') }}</label>
                                <input type="color" name="pwa_theme_color" class="form-control form-control-color" id="pwa_theme_color"
                                    value="{{ get_config('pwa_theme_color', '#6777ef') }}" 
                                    title="{{ trans('pwa::content.choose_theme_color') }}">
                                <p class="description mt-2">{{ trans('pwa::content.theme_color_help') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_background_color">{{ trans('pwa::content.background_color') }}</label>
                                <input type="color" name="pwa_background_color" class="form-control form-control-color" id="pwa_background_color"
                                    value="{{ get_config('pwa_background_color', '#ffffff') }}" 
                                    title="{{ trans('pwa::content.choose_background_color') }}">
                                <p class="description mt-2">{{ trans('pwa::content.background_color_help') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Display & Behavior --}}
                    <h5 class="mt-4">{{ trans('pwa::content.display_behavior') }}</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_display">{{ trans('pwa::content.display_mode') }}</label>
                                <select name="pwa_display" id="pwa_display" class="form-control select2">
                                    <option value="standalone" {{ get_config('pwa_display') == 'standalone' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.display_standalone') }}
                                    </option>
                                    <option value="fullscreen" {{ get_config('pwa_display') == 'fullscreen' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.display_fullscreen') }}
                                    </option>
                                    <option value="minimal-ui" {{ get_config('pwa_display') == 'minimal-ui' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.display_minimal_ui') }}
                                    </option>
                                    <option value="browser" {{ get_config('pwa_display') == 'browser' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.display_browser') }}
                                    </option>
                                </select>
                                <p class="description mt-2">{{ trans('pwa::content.display_mode_description') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_orientation">{{ trans('pwa::content.orientation') }}</label>
                                <select name="pwa_orientation" id="pwa_orientation" class="form-control select2">
                                    <option value="any" {{ get_config('pwa_orientation') == 'any' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.orientation_any') }}
                                    </option>
                                    <option value="portrait" {{ get_config('pwa_orientation') == 'portrait' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.orientation_portrait') }}
                                    </option>
                                    <option value="landscape" {{ get_config('pwa_orientation') == 'landscape' ? 'selected' : '' }}>
                                        {{ trans('pwa::content.orientation_landscape') }}
                                    </option>
                                </select>
                                <p class="description mt-2">{{ trans('pwa::content.orientation_description') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- PWA Scope - Critical for Navigation --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label" for="pwa_scope">{{ trans('pwa::content.scope') }}</label>
                                <input type="text" name="pwa_scope" class="form-control" id="pwa_scope"
                                    value="{{ get_config('pwa_scope', '/') }}" 
                                    placeholder="/">
                                <p class="description mt-2">{{ trans('pwa::content.scope_help') }}</p>
                                <div class="alert alert-warning mt-2">
                                    <small><strong>Important:</strong> Keep this as "/" to allow navigation to all pages. Changing this may break navigation!</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PWA Logo --}}
                    <h5 class="mt-4">{{ trans('pwa::content.assets_icons') }}</h5>

                    <div class="form-group">
                        <label class="col-form-label">{{ trans('pwa::content.pwa_logo') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::image(trans('pwa::content.pwa_logo'), 'pwa_logo', [
                                    'value' => get_config('pwa_logo'),
                                ]) }}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    {{-- PWA Features --}}
                    <h5>{{ trans('pwa::content.pwa_features') }}</h5>

                    <div class="form-check mb-3">
                        {{ Field::checkbox(trans('pwa::content.show_install_button'), 'pwa_show_install_button', [
                                    'checked' => get_config('pwa_show_install_button', true),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'pwa_show_install_button',
                                ]) }}
                        <div class="form-text">{{ trans('pwa::content.show_install_button_help') }}</div>
                    </div>

                    {{-- Advanced Settings --}}
                    <h6 class="mt-4">{{ trans('pwa::content.advanced_settings') }}</h6>
                    
                    <div class="form-group">
                        <label class="col-form-label" for="pwa_init_delay">{{ trans('pwa::content.init_delay') }}</label>
                        <input type="number" name="pwa_init_delay" class="form-control" id="pwa_init_delay"
                            value="{{ get_config('pwa_init_delay', 1000) }}" 
                            min="0" max="5000" step="100"
                            placeholder="1000">
                        <div class="form-text">
                            {{ trans('pwa::content.init_delay_help') }}
                            <br><strong>Troubleshooting:</strong> If PWA install button doesn't work when chatbots are enabled, increase this value to 2000-3000ms.
                        </div>
                    </div>

                    {{-- Requirements Status --}}
                    <h5 class="mt-4">{{ trans('pwa::content.requirements_status') }}</h5>
                    
                    <div id="pwa-requirements-status">
                        <div class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ trans('pwa::content.requirement_https') }}</strong>
                                    <small class="text-muted d-block">{{ trans('pwa::content.requirement_https_desc') }}</small>
                                </div>
                                @if(request()->isSecure())
                                    <span class="badge bg-success">✓</span>
                                @else
                                    <span class="badge bg-danger">✗</span>
                                @endif
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ trans('pwa::content.requirement_package') }}</strong>
                                    <small class="text-muted d-block">{{ trans('pwa::content.requirement_package_desc') }}</small>
                                </div>
                                @if(class_exists('EragLaravelPwa\\Core\\PWA'))
                                    <span class="badge bg-success">✓</span>
                                @else
                                    <span class="badge bg-danger">✗</span>
                                @endif
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ trans('pwa::content.requirement_writable') }}</strong>
                                    <small class="text-muted d-block">{{ trans('pwa::content.requirement_writable_desc') }}</small>
                                </div>
                                @if(is_writable(public_path()))
                                    <span class="badge bg-success">✓</span>
                                @else
                                    <span class="badge bg-warning">⚠</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- PWA Benefits --}}
                    <div class="mt-4">
                        <h6>{{ trans('pwa::content.pwa_benefits') }}</h6>
                        <div class="alert alert-info">
                            <ul class="mb-0">
                                @foreach(trans('pwa::content.pwa_benefits_list') as $benefit)
                                    <li><small>{{ $benefit }}</small></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Advanced Settings --}}
                    <div class="mt-4">
                        <h6>{{ trans('pwa::content.advanced_settings') }}</h6>
                        <div class="form-group">
                            <label class="col-form-label" for="pwa_cache_strategy">{{ trans('pwa::content.cache_strategy') }}</label>
                            <select name="pwa_cache_strategy" id="pwa_cache_strategy" class="form-control">
                                <option value="cache_first" {{ get_config('pwa_cache_strategy') == 'cache_first' ? 'selected' : '' }}>
                                    {{ trans('pwa::content.cache_first') }}
                                </option>
                                <option value="network_first" {{ get_config('pwa_cache_strategy') == 'network_first' ? 'selected' : '' }}>
                                    {{ trans('pwa::content.network_first') }}
                                </option>
                                <option value="stale_while_revalidate" {{ get_config('pwa_cache_strategy') == 'stale_while_revalidate' ? 'selected' : '' }}>
                                    {{ trans('pwa::content.stale_while_revalidate') }}
                                </option>
                            </select>
                            <div class="form-text">{{ trans('pwa::content.cache_strategy_description') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    @if(!request()->isSecure())
                        <div class="alert alert-warning mb-0">
                            <small>{{ trans('pwa::content.https_required_warning') }}</small>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="submit" class="btn btn-tabler me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                        {{ trans('pwa::content.save_settings') }}
                    </button>

                    <button type="reset" class="btn btn-teal cancel-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                        {{ trans('pwa::content.reset_settings') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // PWA Enable/Disable Toggle
    const pwaEnabledToggle = document.getElementById('pwa_enabled');
    const form = document.querySelector('.form-ajax');
    
    if (pwaEnabledToggle) {
        pwaEnabledToggle.addEventListener('change', function() {
            if (this.checked) {
                // Validate required fields when enabling
                const appName = document.getElementById('pwa_app_name');
                const shortName = document.getElementById('pwa_short_name');
                
                if (!appName.value || !shortName.value) {
                    alert('{{ trans("pwa::content.field_required", ["field" => "App Name & Short Name"]) }}');
                    this.checked = false;
                    return;
                }
            }
        });
    }
    
    // PWA Scope validation to prevent navigation issues
    const scopeInput = document.getElementById('pwa_scope');
    if (scopeInput) {
        scopeInput.addEventListener('change', function() {
            const value = this.value.trim();
            if (value !== '/' && !value.startsWith('/')) {
                alert('Scope should start with "/" to ensure proper navigation. Recommended value: "/"');
                this.focus();
            }
        });
    }
});
</script> 