<style>
    .notification-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.email_notifications') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify New Ticket', 'notify_new_ticket', [
                        'checked' => get_config('notify_new_ticket', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Ticket Reply', 'notify_ticket_reply', [
                        'checked' => get_config('notify_ticket_reply', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Status Change', 'notify_status_change', [
                        'checked' => get_config('notify_status_change', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Assignment', 'notify_assignment', [
                        'checked' => get_config('notify_assignment', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Escalation', 'notify_escalation', [
                        'checked' => get_config('notify_escalation', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify SLA Breach', 'notify_sla_breach', [
                        'checked' => get_config('notify_sla_breach', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.staff_notifications') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Staff Dashboard', 'notify_staff_dashboard', [
                        'checked' => get_config('notify_staff_dashboard', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Staff Email', 'notify_staff_email', [
                        'checked' => get_config('notify_staff_email', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Staff SMS', 'notify_staff_sms', [
                        'checked' => get_config('notify_staff_sms', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Notification Interval (Minutes)', 'notification_interval', [
                    'type' => 'number',
                    'value' => get_config('notification_interval', 15),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 1440,
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.sms_notifications') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable SMS Notifications', 'enable_sms_notifications', [
                        'checked' => get_config('enable_sms_notifications', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::select('SMS Provider', 'sms_provider', [
                    'value' => get_config('sms_provider', 'twilio'),
                    'options' => [
                        'twilio' => 'Twilio',
                        'nexmo' => 'Vonage (Nexmo)',
                        'aws_sns' => 'AWS SNS',
                        'custom' => 'Custom Provider'
                    ],
                    'class' => 'form-select',
                ]) }}

                @component('cms::components.form_input', [
                    'name' => 'sms_api_key',
                    'label' => trans('sticket::content.sms_api_key'),
                    'value' => get_config('sms_api_key', ''),
                    'type' => 'password',
                ])
                @endcomponent

                @component('cms::components.form_input', [
                    'name' => 'sms_api_secret',
                    'label' => trans('sticket::content.sms_api_secret'),
                    'value' => get_config('sms_api_secret', ''),
                    'type' => 'password',
                ])
                @endcomponent

                {{ Field::text('SMS From Number', 'sms_from_number', [
                    'value' => get_config('sms_from_number', ''),
                    'class' => 'form-control',
                    'placeholder' => '+1234567890',
                ]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.report_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Reports', 'enable_reports', [
                        'checked' => get_config('enable_reports', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Report Retention Days', 'report_retention_days', [
                    'type' => 'number',
                    'value' => get_config('report_retention_days', 365),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 3650,
                ]) }}

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Auto Generate Reports', 'auto_generate_reports', [
                        'checked' => get_config('auto_generate_reports', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::select('Report Frequency', 'report_frequency', [
                    'value' => get_config('report_frequency', 'weekly'),
                    'options' => [
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly'
                    ],
                    'class' => 'form-select',
                ]) }}

                {{ Field::textarea('Report Recipients', 'report_recipients', [
                    'value' => get_config('report_recipients', ''),
                    'class' => 'form-control',
                    'rows' => 2,
                    'placeholder' => 'email1@example.com, email2@example.com',
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.notification_templates') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ Field::textarea('New Ticket Template', 'new_ticket_template', [
                            'value' => get_config('new_ticket_template', 'New ticket #{ticket_id} has been created by {customer_name}. Subject: {ticket_subject}'),
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) }}

                        {{ Field::textarea('Ticket Reply Template', 'ticket_reply_template', [
                            'value' => get_config('ticket_reply_template', 'Ticket #{ticket_id} has received a new reply from {replier_name}.'),
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) }}

                        {{ Field::textarea('Ticket Closed Template', 'ticket_closed_template', [
                            'value' => get_config('ticket_closed_template', 'Ticket #{ticket_id} has been closed by {closed_by}.'),
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Field::textarea('Ticket Assigned Template', 'ticket_assigned_template', [
                            'value' => get_config('ticket_assigned_template', 'Ticket #{ticket_id} has been assigned to you. Subject: {ticket_subject}'),
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) }}

                        {{ Field::textarea('SLA Breach Template', 'sla_breach_template', [
                            'value' => get_config('sla_breach_template', 'SLA breach alert: Ticket #{ticket_id} has exceeded the response time limit.'),
                            'class' => 'form-control',
                            'rows' => 3,
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>