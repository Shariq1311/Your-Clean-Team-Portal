<form method="post" action="{{ route('admin.setting.save') }}" class="form-ajax">
    <input type="hidden" name="form" value="chatbot">

    <div class="card">
        <div class="card-header bg-transparent justify-content-end align-items-center">
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
            <!-- Global Settings -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3>{{ trans('chatbot::content.global_settings') }}</h3>
                    <p class="text-muted">{{ trans('chatbot::content.global_settings_description') }}</p>
                </div>
            </div>

            {{ Field::checkbox(trans('chatbot::content.enable_chatbots'), 'chatbot_enabled', [
                'checked' => get_config('chatbot_enabled', true),
                'description' => trans('chatbot::content.enable_chatbots_description')
            ]) }}

            {{ Field::checkbox(trans('chatbot::content.enable_logging'), 'chatbot_logging_enabled', [
                'checked' => get_config('chatbot_logging_enabled', false),
                'description' => trans('chatbot::content.enable_logging_description')
            ]) }}

            <hr class="my-4">

            <!-- Chatbot Providers -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3>{{ trans('chatbot::content.chatbot_providers') }}</h3>
                    <p class="text-muted">{{ trans('chatbot::content.chatbot_providers_description') }}</p>
                </div>
            </div>

            <div class="accordion" id="chatbotProvidersAccordion">
                
                <!-- WhatsApp Business -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="whatsapp-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#whatsapp-collapse" aria-expanded="false">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/whatsapp.svg"
                                 class="me-2" width="20" height="20" alt="WhatsApp"
                                 style="filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%);">

                            <span class="fw-bold">{{ trans('chatbot::content.whatsapp_business') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[whatsapp][enabled]', [
                                    'checked' => get_config('chatbot_providers.whatsapp.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'whatsapp',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="whatsapp-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.phone_number') }}
                                </label>
                                <div class="col">
                                    <input type="tel" class="form-control" name="chatbot_providers[whatsapp][phone_number]" 
                                           value="{{ get_config('chatbot_providers.whatsapp.phone_number', '') }}"
                                           placeholder="+1234567890">
                                    <div class="form-hint">{{ trans('chatbot::content.phone_number_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.default_message') }}</label>
                                <div class="col">
                                    <textarea class="form-control" name="chatbot_providers[whatsapp][default_message]" 
                                              rows="3" placeholder="{{ trans('chatbot::content.whatsapp_default_message') }}">{{ get_config('chatbot_providers.whatsapp.default_message', trans('chatbot::content.whatsapp_default_message')) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[whatsapp][position]">
                                        <option value="bottom-right" {{ get_config('chatbot_providers.whatsapp.position', 'bottom-right') === 'bottom-right' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_right') }}</option>
                                        <option value="bottom-left" {{ get_config('chatbot_providers.whatsapp.position') === 'bottom-left' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_left') }}</option>
                                        <option value="top-right" {{ get_config('chatbot_providers.whatsapp.position') === 'top-right' ? 'selected' : '' }}>{{ trans('chatbot::content.top_right') }}</option>
                                        <option value="top-left" {{ get_config('chatbot_providers.whatsapp.position') === 'top-left' ? 'selected' : '' }}>{{ trans('chatbot::content.top_left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.auto_show_delay') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="chatbot_providers[whatsapp][auto_show_delay]" 
                                               value="{{ get_config('chatbot_providers.whatsapp.auto_show_delay', 3) }}"
                                               min="0" max="60">
                                        <span class="input-group-text">{{ trans('chatbot::content.seconds') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Crisp Chat -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="crisp-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#crisp-collapse" aria-expanded="false">
                            <img src="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/solid/chat-bubble-oval-left.svg" 
                                class="me-2" width="20" height="20" alt="Crisp"
                                style="filter: invert(27%) sepia(98%) saturate(1352%) hue-rotate(204deg) brightness(95%) contrast(106%);">
                            <span class="fw-bold">{{ trans('chatbot::content.crisp_chat') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[crisp][enabled]', [
                                    'checked' => get_config('chatbot_providers.crisp.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'crisp',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="crisp-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.website_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[crisp][website_id]" 
                                           value="{{ get_config('chatbot_providers.crisp.website_id', '') }}"
                                           placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                                    <div class="form-hint">{{ trans('chatbot::content.crisp_website_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.language') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[crisp][locale]">
                                        <option value="auto" {{ get_config('chatbot_providers.crisp.locale', 'auto') === 'auto' ? 'selected' : '' }}>{{ trans('chatbot::content.auto_detect') }}</option>
                                        <option value="en" {{ get_config('chatbot_providers.crisp.locale') === 'en' ? 'selected' : '' }}>English</option>
                                        <option value="fr" {{ get_config('chatbot_providers.crisp.locale') === 'fr' ? 'selected' : '' }}>Français</option>
                                        <option value="de" {{ get_config('chatbot_providers.crisp.locale') === 'de' ? 'selected' : '' }}>Deutsch</option>
                                        <option value="es" {{ get_config('chatbot_providers.crisp.locale') === 'es' ? 'selected' : '' }}>Español</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[crisp][position]">
                                        <option value="right" {{ get_config('chatbot_providers.crisp.position', 'right') === 'right' ? 'selected' : '' }}>{{ trans('chatbot::content.right') }}</option>
                                        <option value="left" {{ get_config('chatbot_providers.crisp.position') === 'left' ? 'selected' : '' }}>{{ trans('chatbot::content.left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.theme_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[crisp][color]" 
                                               value="{{ get_config('chatbot_providers.crisp.color', '#007bff') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[crisp][color]" 
                                               value="{{ get_config('chatbot_providers.crisp.color', '#007bff') }}"
                                               placeholder="#007bff">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tidio Live Chat -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="tidio-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#tidio-collapse" aria-expanded="false">
                            <img src="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/solid/chat-bubble-left-right.svg" 
                                class="me-2" width="20" height="20" alt="Tidio"
                                style="filter: invert(27%) sepia(51%) saturate(2878%) hue-rotate(266deg) brightness(104%) contrast(97%);">
                            <span class="fw-bold">{{ trans('chatbot::content.tidio_live_chat') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[tidio][enabled]', [
                                    'checked' => get_config('chatbot_providers.tidio.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'tidio',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="tidio-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.public_key') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[tidio][public_key]" 
                                           value="{{ get_config('chatbot_providers.tidio.public_key', '') }}"
                                           placeholder="abcdefghijklmnopqrstuvwxyz123456">
                                    <div class="form-hint">{{ trans('chatbot::content.tidio_public_key_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[tidio][position]">
                                        <option value="right" {{ get_config('chatbot_providers.tidio.position', 'right') === 'right' ? 'selected' : '' }}>{{ trans('chatbot::content.right') }}</option>
                                        <option value="left" {{ get_config('chatbot_providers.tidio.position') === 'left' ? 'selected' : '' }}>{{ trans('chatbot::content.left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.primary_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[tidio][primary_color]" 
                                               value="{{ get_config('chatbot_providers.tidio.primary_color', '#007bff') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[tidio][primary_color]" 
                                               value="{{ get_config('chatbot_providers.tidio.primary_color', '#007bff') }}"
                                               placeholder="#007bff">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.hide_when_offline') }}</label>
                                <div class="col">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               name="chatbot_providers[tidio][hide_when_offline]" value="1"
                                               {{ get_config('chatbot_providers.tidio.hide_when_offline', false) ? 'checked' : '' }}>
                                        <span class="form-check-label">{{ trans('chatbot::content.enable') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Facebook Messenger -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="messenger-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#messenger-collapse" aria-expanded="false">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/messenger.svg"
                                class="me-2" width="20" height="20" alt="Messenger"
                                style="filter: invert(27%) sepia(98%) saturate(1352%) hue-rotate(204deg) brightness(95%) contrast(106%);">
                            <span class="fw-bold">{{ trans('chatbot::content.facebook_messenger') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[messenger][enabled]', [
                                    'checked' => get_config('chatbot_providers.messenger.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'messenger',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="messenger-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.messenger_page_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[messenger][page_id]" 
                                           value="{{ get_config('chatbot_providers.messenger.page_id', '') }}"
                                           placeholder="123456789012345">
                                    <div class="form-hint">{{ trans('chatbot::content.messenger_page_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.messenger_app_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[messenger][app_id]" 
                                           value="{{ get_config('chatbot_providers.messenger.app_id', '') }}"
                                           placeholder="123456789012345">
                                    <div class="form-hint">{{ trans('chatbot::content.messenger_app_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.theme_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[messenger][theme_color]" 
                                               value="{{ get_config('chatbot_providers.messenger.theme_color', '#0084ff') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[messenger][theme_color]" 
                                               value="{{ get_config('chatbot_providers.messenger.theme_color', '#0084ff') }}"
                                               placeholder="#0084ff">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.messenger_logged_in_greeting') }}</label>
                                <div class="col">
                                    <textarea class="form-control" name="chatbot_providers[messenger][logged_in_greeting]" 
                                              rows="2" placeholder="{{ trans('chatbot::content.messenger_logged_in_greeting') }}">{{ get_config('chatbot_providers.messenger.logged_in_greeting', trans('chatbot::content.messenger_logged_in_greeting')) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.messenger_logged_out_greeting') }}</label>
                                <div class="col">
                                    <textarea class="form-control" name="chatbot_providers[messenger][logged_out_greeting]" 
                                              rows="2" placeholder="{{ trans('chatbot::content.messenger_logged_out_greeting') }}">{{ get_config('chatbot_providers.messenger.logged_out_greeting', trans('chatbot::content.messenger_logged_out_greeting')) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LiveChat -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="livechat-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#livechat-collapse" aria-expanded="false">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/livechat.svg"
                                class="me-2" width="20" height="20" alt="LiveChat"
                                style="filter: invert(27%) sepia(98%) saturate(1352%) hue-rotate(204deg) brightness(95%) contrast(106%);">
                            <span class="fw-bold">{{ trans('chatbot::content.livechat') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[livechat][enabled]', [
                                    'checked' => get_config('chatbot_providers.livechat.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'livechat',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="livechat-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.livechat_license_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[livechat][license_id]" 
                                           value="{{ get_config('chatbot_providers.livechat.license_id', '') }}"
                                           placeholder="1234567">
                                    <div class="form-hint">{{ trans('chatbot::content.livechat_license_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.livechat_group_id') }}</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[livechat][group_id]" 
                                           value="{{ get_config('chatbot_providers.livechat.group_id', '') }}"
                                           placeholder="0">
                                    <div class="form-hint">{{ trans('chatbot::content.livechat_group_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[livechat][position]">
                                        <option value="right" {{ get_config('chatbot_providers.livechat.position', 'right') === 'right' ? 'selected' : '' }}>{{ trans('chatbot::content.right') }}</option>
                                        <option value="left" {{ get_config('chatbot_providers.livechat.position') === 'left' ? 'selected' : '' }}>{{ trans('chatbot::content.left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.theme_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[livechat][theme_color]" 
                                               value="{{ get_config('chatbot_providers.livechat.theme_color', '#0078d4') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[livechat][theme_color]" 
                                               value="{{ get_config('chatbot_providers.livechat.theme_color', '#0078d4') }}"
                                               placeholder="#0078d4">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.auto_show_delay') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="chatbot_providers[livechat][auto_show_delay]" 
                                               value="{{ get_config('chatbot_providers.livechat.auto_show_delay', 0) }}"
                                               min="0" max="60">
                                        <span class="input-group-text">{{ trans('chatbot::content.seconds') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.hide_when_offline') }}</label>
                                <div class="col">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               name="chatbot_providers[livechat][hide_when_offline]" value="1"
                                               {{ get_config('chatbot_providers.livechat.hide_when_offline', false) ? 'checked' : '' }}>
                                        <span class="form-check-label">{{ trans('chatbot::content.enable') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zendesk Chat -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="zendesk-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#zendesk-collapse" aria-expanded="false">
                           <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/zendesk.svg"
                                class="me-2" width="20" height="20" alt="Zendesk"
                                style="filter: invert(15%) sepia(25%) saturate(1945%) hue-rotate(155deg) brightness(93%) contrast(94%);">
                            <span class="fw-bold">{{ trans('chatbot::content.zendesk_chat') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[zendesk][enabled]', [
                                    'checked' => get_config('chatbot_providers.zendesk.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'zendesk',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="zendesk-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.zendesk_widget_key') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[zendesk][widget_key]" 
                                           value="{{ get_config('chatbot_providers.zendesk.widget_key', '') }}"
                                           placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                                    <div class="form-hint">{{ trans('chatbot::content.zendesk_widget_key_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[zendesk][position]">
                                        <option value="bottom-right" {{ get_config('chatbot_providers.zendesk.position', 'bottom-right') === 'bottom-right' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_right') }}</option>
                                        <option value="bottom-left" {{ get_config('chatbot_providers.zendesk.position') === 'bottom-left' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_left') }}</option>
                                        <option value="top-right" {{ get_config('chatbot_providers.zendesk.position') === 'top-right' ? 'selected' : '' }}>{{ trans('chatbot::content.top_right') }}</option>
                                        <option value="top-left" {{ get_config('chatbot_providers.zendesk.position') === 'top-left' ? 'selected' : '' }}>{{ trans('chatbot::content.top_left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.theme_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[zendesk][theme_color]" 
                                               value="{{ get_config('chatbot_providers.zendesk.theme_color', '#03363d') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[zendesk][theme_color]" 
                                               value="{{ get_config('chatbot_providers.zendesk.theme_color', '#03363d') }}"
                                               placeholder="#03363d">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.auto_show_delay') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="chatbot_providers[zendesk][auto_show_delay]" 
                                               value="{{ get_config('chatbot_providers.zendesk.auto_show_delay', 0) }}"
                                               min="0" max="60">
                                        <span class="input-group-text">{{ trans('chatbot::content.seconds') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.zendesk_department') }}</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[zendesk][department]" 
                                           value="{{ get_config('chatbot_providers.zendesk.department', '') }}"
                                           placeholder="Support">
                                    <div class="form-hint">{{ trans('chatbot::content.zendesk_department_help') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tawk.to -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="tawkto-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#tawkto-collapse" aria-expanded="false">
                             <img src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/svgs/solid/comment-dots.svg" 
                                class="me-2" width="20" height="20" alt="Crisp"
                                style="filter: invert(27%) sepia(98%) saturate(1352%) hue-rotate(204deg) brightness(95%) contrast(106%);">
                            <span class="fw-bold">{{ trans('chatbot::content.tawkto') }}</span>
                            <div class="ms-auto">
                                {{ Field::checkbox(trans('chatbot::content.enable'), 'chatbot_providers[tawkto][enabled]', [
                                    'checked' => get_config('chatbot_providers.tawkto.enabled', false),
                                    'class' => 'provider-toggle',
                                    'data-provider' => 'tawkto',
                                    'onclick' => 'event.stopPropagation();'
                                ]) }}
                            </div>
                        </button>
                    </h2>
                    <div id="tawkto-collapse" class="accordion-collapse collapse" data-bs-parent="#chatbotProvidersAccordion">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <label class="col-3 col-form-label required">
                                    {{ trans('chatbot::content.property_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[tawkto][property_id]" 
                                           value="{{ get_config('chatbot_providers.tawkto.property_id', '') }}"
                                           placeholder="5a7c31cfd84fea190d7ee8ac">
                                    <div class="form-hint">{{ trans('chatbot::content.tawkto_property_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">
                                    {{ trans('chatbot::content.widget_id') }}
                                </label>
                                <div class="col">
                                    <input type="text" class="form-control" name="chatbot_providers[tawkto][widget_id]" 
                                           value="{{ get_config('chatbot_providers.tawkto.widget_id', 'default') }}"
                                           placeholder="default">
                                    <div class="form-hint">{{ trans('chatbot::content.tawkto_widget_id_help') }}</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.position') }}</label>
                                <div class="col">
                                    <select class="form-select" name="chatbot_providers[tawkto][position]">
                                        <option value="br" {{ get_config('chatbot_providers.tawkto.position', 'br') === 'br' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_right') }}</option>
                                        <option value="bl" {{ get_config('chatbot_providers.tawkto.position') === 'bl' ? 'selected' : '' }}>{{ trans('chatbot::content.bottom_left') }}</option>
                                        <option value="tr" {{ get_config('chatbot_providers.tawkto.position') === 'tr' ? 'selected' : '' }}>{{ trans('chatbot::content.top_right') }}</option>
                                        <option value="tl" {{ get_config('chatbot_providers.tawkto.position') === 'tl' ? 'selected' : '' }}>{{ trans('chatbot::content.top_left') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.theme_color') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" name="chatbot_providers[tawkto][theme_color]" 
                                               value="{{ get_config('chatbot_providers.tawkto.theme_color', '#00a78f') }}">
                                        <input type="text" class="form-control" name="chatbot_providers[tawkto][theme_color]" 
                                               value="{{ get_config('chatbot_providers.tawkto.theme_color', '#00a78f') }}"
                                               placeholder="#00a78f">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-3 col-form-label">{{ trans('chatbot::content.auto_show_delay') }}</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="chatbot_providers[tawkto][auto_show_delay]" 
                                               value="{{ get_config('chatbot_providers.tawkto.auto_show_delay', 0) }}"
                                               min="0" max="60">
                                        <span class="input-group-text">{{ trans('chatbot::content.seconds') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{ Field::checkbox(trans('chatbot::content.hide_when_offline'), 'chatbot_providers[tawkto][hide_when_offline]', [
                                'checked' => get_config('chatbot_providers.tawkto.hide_when_offline', false),
                                'description' => trans('chatbot::content.hide_when_offline_description')
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-transparent mt-auto">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="text-muted small">
                        {{ trans('chatbot::content.save_note') }}
                    </div>
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
        </div>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle provider toggle changes for validation
    document.querySelectorAll('.provider-toggle').forEach(function(toggle) {
        const provider = toggle.dataset.provider;
        const accordionItem = toggle.closest('.accordion-item');
        const requiredFields = accordionItem.querySelectorAll('input[required], select[required], textarea[required]');
        
        function updateValidation() {
            const isEnabled = toggle.checked;
            requiredFields.forEach(function(field) {
                if (isEnabled) {
                    field.setAttribute('required', 'required');
                } else {
                    field.removeAttribute('required');
                }
            });
        }
        
        // Initial validation update
        updateValidation();
        
        // Update validation on toggle change
        toggle.addEventListener('change', updateValidation);
    });

    // Form submission validation
    document.querySelector('.form-ajax').addEventListener('submit', function(e) {
        let hasErrors = false;
        const errorMessages = [];

        // Check each enabled provider for required fields
        document.querySelectorAll('.provider-toggle:checked').forEach(function(toggle) {
            const provider = toggle.dataset.provider;
            const accordionItem = toggle.closest('.accordion-item');
            const requiredFields = accordionItem.querySelectorAll('input[required], select[required], textarea[required]');
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    hasErrors = true;
                    const label = field.closest('.row').querySelector('label').textContent.trim();
                    const providerName = accordionItem.querySelector('.fw-bold').textContent.trim();
                    errorMessages.push(`${providerName}: ${label} is required`);
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
        });

        if (hasErrors) {
            e.preventDefault();
            alert('Please fix the following errors:\n\n' + errorMessages.join('\n'));
            return false;
        }
    });

    // Clear validation errors on input
    document.querySelectorAll('input, select, textarea').forEach(function(field) {
        field.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });

    // Color input synchronization
    document.querySelectorAll('input[type="color"]').forEach(function(colorInput) {
        const textInput = colorInput.nextElementSibling;
        
        colorInput.addEventListener('input', function() {
            textInput.value = this.value;
        });
        
        textInput.addEventListener('input', function() {
            if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
                colorInput.value = this.value;
            }
        });
    });
});
</script>

<style>
.accordion-button {
    padding: 1rem 1.25rem;
}

.accordion-button .form-check {
    margin-bottom: 0;
}

.form-check-input:focus {
    box-shadow: none;
}

.provider-toggle {
    pointer-events: all !important;
}

.col-form-label.required:after {
    content: " *";
    color: #e74c3c;
}

.is-invalid {
    border-color: #e74c3c;
}

.form-hint {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.25rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.accordion-item {
    border: 1px solid #dee2e6;
}

.accordion-item + .accordion-item {
    border-top: 0;
}

.form-control-color {
    width: 50px;
    height: 38px;
}
</style>
