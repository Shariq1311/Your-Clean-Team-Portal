<style>
    .auto-close-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.auto_close_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Auto Close', 'enable_auto_close', [
                        'checked' => get_config('enable_auto_close', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Auto Close Days', 'auto_close_days', [
                    'type' => 'number',
                    'value' => get_config('auto_close_days', 30),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 365,
                    'help' => trans('sticket::content.auto_close_days_description'),
                ]) }}

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Notify Before Close', 'notify_before_close', [
                        'checked' => get_config('notify_before_close', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Notify Days Before', 'notify_days_before', [
                    'type' => 'number',
                    'value' => get_config('notify_days_before', 3),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 30,
                ]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.escalation_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Escalation', 'enable_escalation', [
                        'checked' => get_config('enable_escalation', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                {{ Field::text('Escalation Hours', 'escalation_hours', [
                    'type' => 'number',
                    'value' => get_config('escalation_hours', 24),
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 168,
                    'help' => trans('sticket::content.escalation_hours_description'),
                ]) }}

                {{ Field::select('Escalation Level', 'escalation_level', [
                    'value' => get_config('escalation_level', 'supervisor'),
                    'options' => [
                        'supervisor' => trans('sticket::content.supervisor'),
                        'manager' => trans('sticket::content.manager'),
                        'admin' => trans('sticket::content.admin')
                    ],
                    'class' => 'form-select',
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.auto_assignment') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check form-switch mb-3">
                            {{ Field::checkbox('Enable Auto Assignment', 'enable_auto_assignment', [
                                'checked' => get_config('enable_auto_assignment', 0) == 1,
                                'class' => 'form-check-input',
                            ]) }}
                        </div>

                        {{ Field::select('Assignment Method', 'assignment_method', [
                            'value' => get_config('assignment_method', 'round_robin'),
                            'options' => [
                                'round_robin' => trans('sticket::content.round_robin'),
                                'least_busy' => trans('sticket::content.least_busy'),
                                'specialist' => trans('sticket::content.specialist')
                            ],
                            'class' => 'form-select',
                        ]) }}
                    </div>
                    <div class="col-md-6">
                        {{ Field::textarea('Auto Assignment Rules', 'auto_assignment_rules', [
                            'value' => get_config('auto_assignment_rules', ''),
                            'class' => 'form-control',
                            'rows' => 4,
                            'help' => trans('sticket::content.auto_assignment_rules_description'),
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>