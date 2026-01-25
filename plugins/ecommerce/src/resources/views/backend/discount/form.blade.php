@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model,
    ])
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.basic_information') }}</h4>
                    </div>
                    <div class="card-body">
                        {{ Field::text($model, 'title', [
                            'required' => true,
                            'label' => trans('ecomm::content.title'),
                        ]) }}

                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::text($model, 'code', [
                                    'required' => true,
                                    'label' => trans('ecomm::content.coupon_code'),
                                    'placeholder' => 'e.g., SAVE20, WELCOME10',
                                    'help' => 'Use letters, numbers, dashes and underscores only',
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::select($model, 'type', [
                                    'required' => true,
                                    'label' => trans('ecomm::content.discount_type'),
                                    'options' => $discountTypes,
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label" for="value">
                                        {{ trans('ecomm::content.discount_value') }} *
                                        <span id="value-label"></span>
                                    </label>
                                    <input type="number" name="value" id="value" class="form-control"
                                        value="{{ old('value', $model->value) }}" step="0.01" min="0" required>
                                    <small class="form-text text-muted" id="value-help"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{ Field::text($model, 'minimum_amount', [
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'min' => '0',
                                    'label' => trans('ecomm::content.minimum_amount'),
                                    'help' => 'Minimum cart amount required for this discount',
                                ]) }}
                            </div>
                        </div>

                        <div class="row" id="maximum-discount-row" style="display: none;">
                            <div class="col-md-6">
                                {{ Field::text($model, 'maximum_discount', [
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'min' => '0',
                                    'label' => trans('ecomm::content.maximum_discount'),
                                    'help' => 'Maximum discount amount (for percentage discounts)',
                                ]) }}
                            </div>
                        </div>

                        {{ Field::textarea($model, 'description', [
                            'label' => trans('ecomm::content.description'),
                            'rows' => 3,
                        ]) }}
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.usage_restrictions') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::text($model, 'usage_limit', [
                                    'type' => 'number',
                                    'min' => '1',
                                    'label' => trans('ecomm::content.usage_limit'),
                                    'help' => 'How many times this coupon can be used in total',
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::text($model, 'usage_limit_per_customer', [
                                    'type' => 'number',
                                    'min' => '1',
                                    'label' => trans('ecomm::content.usage_limit_per_customer'),
                                    'help' => 'How many times a single customer can use this coupon',
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::text($model, 'start_date', [
                                    'type' => 'date',
                                    'label' => trans('ecomm::content.start_date'),
                                    'help' => 'When the discount becomes active',
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::text($model, 'end_date', [
                                    'type' => 'date',
                                    'label' => trans('ecomm::content.end_date'),
                                    'help' => 'When the discount expires',
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.applicable_products') }}</h4>
                        <p class="text-muted">Leave empty to apply to all products</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.applicable_products') }}</label>
                            <select name="applicable_products[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Select products this discount applies to">
                                @foreach ($products as $id => $title)
                                    <option value="{{ $id }}" @if (is_array($model->applicable_products) && in_array($id, $model->applicable_products)) selected @endif>
                                        {{ $title }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">If specified, discount will only apply to these products</small>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.applicable_categories') }}</label>
                            <select name="applicable_categories[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Select categories this discount applies to">
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" @if (is_array($model->applicable_categories) && in_array($id, $model->applicable_categories)) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">If specified, discount will only apply to products in these
                                categories</small>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.excluded_products') }}</h4>
                        <p class="text-muted">Products and categories to exclude from this discount</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.excluded_products') }}</label>
                            <select name="excluded_products[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Select products to exclude">
                                @foreach ($products as $id => $title)
                                    <option value="{{ $id }}" @if (is_array($model->excluded_products) && in_array($id, $model->excluded_products)) selected @endif>
                                        {{ $title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.excluded_categories') }}</label>
                            <select name="excluded_categories[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Select categories to exclude">
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" @if (is_array($model->excluded_categories) && in_array($id, $model->excluded_categories)) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('cms::app.status') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-check form-switch">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" class="form-check-input"
                                    @if (old('is_active', $model->is_active)) checked @endif>
                                <span class="form-check-label">{{ trans('cms::app.active') }}</span>
                            </label>
                            <small class="form-text text-muted">Enable or disable this discount</small>
                        </div>

                        <div class="form-group">
                            <label class="form-check form-switch">
                                <input type="hidden" name="free_shipping" value="0">
                                <input type="checkbox" name="free_shipping" value="1" class="form-check-input"
                                    @if (old('free_shipping', $model->free_shipping)) checked @endif>
                                <span class="form-check-label">{{ trans('ecomm::content.free_shipping') }}</span>
                            </label>
                            <small class="form-text text-muted">Also grant free shipping with this discount</small>
                        </div>
                    </div>
                </div>

                @if ($model->id)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('ecomm::content.usage_statistics') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <div class="stat-widget">
                                        <h3 class="text-primary">{{ $model->used_count }}</h3>
                                        <small class="text-muted">{{ trans('ecomm::content.times_used') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-widget">
                                        <h3 class="text-info">{{ $model->usage_limit ?: '∞' }}</h3>
                                        <small class="text-muted">{{ trans('ecomm::content.usage_limit') }}</small>
                                    </div>
                                </div>
                            </div>

                            @if ($model->used_count > 0)
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-warning w-100"
                                        onclick="resetUsage({{ $model->id }})">
                                        {{ trans('ecomm::content.reset_usage_count') }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.preview') }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="discount-preview">
                            <div class="alert alert-info">
                                <strong id="preview-title">{{ $model->title ?: 'Preview will appear here' }}</strong>
                                <div id="preview-details" class="mt-2">
                                    <!-- Preview content will be generated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="id" value="{{ $model->id }}">
    @endcomponent

    <script>
        $(document).ready(function() {
            // Update value field based on discount type
            function updateValueField() {
                const type = $('#type').val();
                const valueField = $('#value');
                const valueLabel = $('#value-label');
                const valueHelp = $('#value-help');
                const maxDiscountRow = $('#maximum-discount-row');

                if (type === 'percentage') {
                    valueLabel.text('(%)');
                    valueHelp.text('Enter percentage (0-100)');
                    valueField.attr('max', '100');
                    maxDiscountRow.show();
                } else {
                    valueLabel.text('($)');
                    valueHelp.text('Enter fixed amount');
                    valueField.removeAttr('max');
                    maxDiscountRow.hide();
                }
                updatePreview();
            }

            // Update preview
            function updatePreview() {
                const title = $('#title').val() || 'Discount Preview';
                const code = $('#code').val() || 'CODE';
                const type = $('#type').val();
                const value = $('#value').val() || '0';
                const minAmount = $('#minimum_amount').val();

                $('#preview-title').text(title);

                let details = '<div class="mb-2">';
                details += '<span class="badge badge-primary">' + code + '</span>';
                details += '</div>';

                if (type === 'percentage') {
                    details += '<div>Get <strong>' + value + '%</strong> off your order</div>';
                } else {
                    details += '<div>Get <strong>$' + value + '</strong> off your order</div>';
                }

                if (minAmount && minAmount > 0) {
                    details += '<div class="text-muted small">Minimum order: $' + minAmount + '</div>';
                }

                $('#preview-details').html(details);
            }

            // Event listeners
            $('#type').change(updateValueField);
            $('#title, #code, #value, #minimum_amount').on('input', updatePreview);

            // Initialize
            updateValueField();

            // Code validation
            $('#code').on('blur', function() {
                const code = $(this).val();
                const excludeId = $('input[name="id"]').val();

                if (code) {
                    $.ajax({
                        url: '{{ route('admin.discounts.validate-code') }}',
                        method: 'POST',
                        data: {
                            code: code,
                            exclude_id: excludeId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (!response.valid) {
                                $('#code').addClass('is-invalid');
                                $('#code').after('<div class="invalid-feedback">' + response
                                    .message + '</div>');
                            } else {
                                $('#code').removeClass('is-invalid').addClass('is-valid');
                                $('#code').siblings('.invalid-feedback').remove();
                            }
                        }
                    });
                }
            });
        });

        function resetUsage(id) {
            if (confirm('Are you sure you want to reset the usage count for this discount?')) {
                $.ajax({
                    url: '/admin/discounts/' + id + '/reset-usage',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
@endsection
