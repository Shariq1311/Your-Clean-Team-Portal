<style>
    .support-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.general_settings') }}</h3>
            </div>
            <div class="card-body">
                @component('cms::components.form_input', [
                    'name' => 'support_email',
                    'label' => trans('sticket::content.support_email'),
                    'value' => get_config('support_email', 'support@example.com'),
                    'type' => 'email',
                    'required' => true,
                ])
                @endcomponent

                {{ Field::text('Support Phone', 'support_phone', [
                    'value' => get_config('support_phone', ''),
                    'class' => 'form-control',
                ]) }}

                {{ Field::text('Working Hours', 'support_working_hours', [
                    'value' => get_config('support_working_hours', 'Monday - Friday, 9:00 AM - 6:00 PM'),
                    'class' => 'form-control',
                ]) }}

                {{ Field::textarea('Welcome Message', 'support_welcome_message', [
                    'value' => get_config('support_welcome_message', 'Welcome to our support system. How can we help you today?'),
                    'class' => 'form-control',
                    'rows' => 3,
                ]) }}

                {{ Field::text('Timezone', 'support_timezone', [
                    'value' => get_config('support_timezone', 'UTC'),
                    'class' => 'form-control',
                    'placeholder' => 'UTC, America/New_York, Europe/London',
                ]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.display_settings') }}</h3>
            </div>
            <div class="card-body">
                {{ Field::select('Tickets Per Page', 'tickets_per_page', [
                    'value' => get_config('tickets_per_page', 20),
                    'options' => [
                        10 => '10',
                        20 => '20',
                        50 => '50',
                        100 => '100'
                    ],
                    'class' => 'form-select',
                ]) }}

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Attachments', 'enable_attachments', [
                        'checked' => get_config('enable_attachments', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Max Attachment Size (MB)', 'max_attachment_size', [
                    'type' => 'number',
                    'value' => get_config('max_attachment_size', 10),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 100,
                ]) }}

                {{ Field::select('Allowed Attachment Types', 'allowed_attachment_types', [
                    'value' => get_config('allowed_attachment_types', 'jpg,jpeg,png,gif,pdf,doc,docx,txt'),
                    'options' => [
                        'jpg,jpeg,png,gif,pdf,doc,docx,txt' => 'Images, PDF, Documents, Text',
                        'jpg,jpeg,png,pdf' => 'Images and PDF only',
                        'pdf,doc,docx' => 'Documents only',
                        'jpg,jpeg,png,gif' => 'Images only'
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.sla_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable SLA', 'enable_sla', [
                        'checked' => get_config('enable_sla', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('SLA Response Time (Hours)', 'sla_response_time', [
                    'type' => 'number',
                    'value' => get_config('sla_response_time', 4),
                    'class' => 'form-control',
                    'min' => 1,
                ]) }}

                {{ Field::text('SLA Resolution Time (Hours)', 'sla_resolution_time', [
                    'type' => 'number',
                    'value' => get_config('sla_resolution_time', 24),
                    'class' => 'form-control',
                    'min' => 1,
                ]) }}

                {{ Field::text('SLA Escalation Time (Hours)', 'sla_escalation_time', [
                    'type' => 'number',
                    'value' => get_config('sla_escalation_time', 8),
                    'class' => 'form-control',
                    'min' => 1,
                ]) }}

                {{ Field::textarea('SLA Working Hours', 'sla_working_hours', [
                    'value' => get_config('sla_working_hours', 'Monday-Friday 9:00-18:00'),
                    'class' => 'form-control',
                    'rows' => 2,
                ]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.integration_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable API', 'enable_api', [
                        'checked' => get_config('enable_api', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('API Rate Limit', 'api_rate_limit', [
                    'type' => 'number',
                    'value' => get_config('api_rate_limit', 100),
                    'class' => 'form-control',
                    'min' => 1,
                ]) }}

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Webhook', 'enable_webhook', [
                        'checked' => get_config('enable_webhook', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Webhook URL', 'webhook_url', [
                    'value' => get_config('webhook_url', ''),
                    'class' => 'form-control',
                    'placeholder' => 'https://your-domain.com/webhook',
                ]) }}

                @component('cms::components.form_input', [
                    'name' => 'webhook_secret',
                    'label' => trans('sticket::content.webhook_secret'),
                    'value' => get_config('webhook_secret', ''),
                    'type' => 'password',
                ])
                @endcomponent
            </div>
        </div>
    </div>
</div>