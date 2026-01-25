<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.rating_settings') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Enable Rating', 'enable_rating', [
                    'checked' => get_config('enable_rating', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.enable_rating'),
                ]) }}
                </div>

                {{ Field::select('Rating Scale', 'rating_scale', [
                    'value' => get_config('rating_scale', 5),
                    'options' => [
                        3 => '1-3 Stars',
                        5 => '1-5 Stars',
                        10 => '1-10 Points',
                    ],
                    'class' => 'form-select',
                    'label' => trans('sticket::content.rating_scale'),
                ]) }}
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Require Rating', 'require_rating', [
                    'checked' => get_config('require_rating', 0),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.require_rating'),
                ]) }}
                </div>                    
                {{ Field::text('Rating Reminder Days', 'rating_reminder_days', [  
                    'value' => get_config('rating_reminder_days', 1),
                    'type' => 'number',
                    'min' => 1,
                    'max' => 30,
                    'class' => 'form-control',
                    'label' => trans('sticket::content.rating_reminder_days'),
                ]) }}
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.rating_categories') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Rate Response Time', 'rate_response_time', [
                    'checked' => get_config('rate_response_time', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.rate_response_time'),
                ]) }}
                </div>
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Rate Solution Quality', 'rate_solution_quality', [
                    'checked' => get_config('rate_solution_quality', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.rate_solution_quality'),
                ]) }}
                </div>
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Rate Staff Courtesy', 'rate_staff_courtesy', [
                    'checked' => get_config('rate_staff_courtesy', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.rate_staff_courtesy'),
                ]) }}
                </div>
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Rate Overall Satisfaction', 'rate_overall_satisfaction', [
                    'checked' => get_config('rate_overall_satisfaction', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.rate_overall_satisfaction'),
                ]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.rating_feedback') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox('Enable Feedback', 'enable_feedback', [
                    'checked' => get_config('enable_feedback', 1),
                    'class' => 'form-check-input',
                    'description' => trans('sticket::content.enable_feedback'),
                ]) }}
                </div>
                {{ Field::textarea('Rating Thank You Message', 'rating_thank_you_message', [
                    'value' => get_config('rating_thank_you_message', 'Thank you for your feedback! Your rating helps us improve our support service.'),
                    'rows' => 3,
                    'class' => 'form-control',
                    'label' => trans('sticket::content.rating_thank_you_message'),
                ]) }}

                {{ Field::textarea('Low Rating Message', 'low_rating_message', [
                    'value' => get_config('low_rating_message', 'We apologize for not meeting your expectations. Please let us know how we can improve.'),
                    'rows' => 3,
                    'class' => 'form-control',
                    'label' => trans('sticket::content.low_rating_message'),
                ]) }}
            </div>
        </div>
    </div>
</div>
