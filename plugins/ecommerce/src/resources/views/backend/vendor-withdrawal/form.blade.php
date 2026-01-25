@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.withdrawal_request') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::text($model, 'amount', [
                                    'required' => true,
                                    'type' => 'number',
                                    'step' => '0.01',
                                    'min' => '0.01',
                                    'label' => trans('ecomm::content.amount'),
                                    'placeholder' => 'Enter withdrawal amount',
                                    'help' => 'Minimum withdrawal amount: $10.00'
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::select($model, 'currency_code', [
                                    'required' => true,
                                    'label' => trans('ecomm::content.currency_code'),
                                    'options' => $currencyOptions ?? ['USD' => 'USD - US Dollar'],
                                    'help' => 'Select the currency for withdrawal'
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::select($model, 'payment_method', [
                                    'required' => true,
                                    'label' => trans('ecomm::content.payment_method'),
                                    'options' => $paymentMethods ?? [
                                        'bank_transfer' => 'Bank Transfer',
                                        'paypal' => 'PayPal',
                                        'stripe' => 'Stripe',
                                        'check' => 'Check',
                                        'cash' => 'Cash',
                                        'other' => 'Other'
                                    ],
                                    'help' => 'Select your preferred payment method'
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::text($model, 'payment_details', [
                                    'label' => trans('ecomm::content.payment_details'),
                                    'placeholder' => 'e.g., PayPal email, bank account details',
                                    'help' => 'Provide payment details (email, account number, etc.)'
                                ]) }}
                            </div>
                        </div>

                        {{ Field::textarea($model, 'notes', [
                            'label' => trans('ecomm::content.notes'),
                            'rows' => 3,
                            'placeholder' => 'Any additional notes or instructions for this withdrawal request',
                            'help' => 'Optional notes about this withdrawal request'
                        ]) }}

                        @if(Auth::check() && Auth::user()->hasRole('vendor'))
                            <input type="hidden" name="vendor_id" value="{{ Auth::id() }}">
                        @else
                            <div class="form-group">
                                <label class="col-form-label">{{ trans('ecomm::content.vendor_id') }} *</label>
                                <select name="vendor_id" class="form-control" required>
                                    <option value="">{{ trans('cms::app.select') }}</option>
                                    @foreach($vendors ?? [] as $vendor)
                                        <option value="{{ $vendor->id }}" @if(old('vendor_id', $model->vendor_id) == $vendor->id) selected @endif>
                                            {{ $vendor->name }} ({{ $vendor->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if(Auth::check() && Auth::user()->hasRole('vendor'))
                            @php
                                $vendorBalance = \Mojahid\Ecommerce\Models\VendorBalance::findOrCreateForVendor(Auth::id());
                                $availableBalance = $vendorBalance->getAvailableBalance();
                            @endphp
                            <div class="alert alert-info">
                                <strong>{{ trans('ecomm::content.available_balance') }}:</strong> ${{ number_format($availableBalance, 2) }}
                                <br>
                                <small class="text-muted">{{ trans('ecomm::content.minimum_withdrawal') }}: $10.00</small>
                            </div>
                        @endif
                    </div>
                </div>

                @if($model->id)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('ecomm::content.withdrawal_information') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ trans('ecomm::content.requested_at') }}</label>
                                        <input type="text" class="form-control" value="{{ $model->created_at ? $model->created_at->format('M d, Y H:i') : 'N/A' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">{{ trans('ecomm::content.processed_at') }}</label>
                                        <input type="text" class="form-control" value="{{ $model->processed_at ? $model->processed_at->format('M d, Y H:i') : 'Not processed yet' }}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            @if($model->processed_by)
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('ecomm::content.processed_by') }}</label>
                                    <input type="text" class="form-control" value="{{ $model->processedBy->name ?? 'N/A' }}" readonly>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('cms::app.status') }}</h4>
                    </div>
                    <div class="card-body">
                        @if(Auth::check() && !Auth::user()->hasRole('vendor'))
                            {{ Field::select($model, 'status', [
                                'required' => true,
                                'label' => trans('ecomm::content.withdrawal_status'),
                                'options' => $statusOptions ?? [
                                    'pending' => 'Pending',
                                    'approved' => 'Approved',
                                    'rejected' => 'Rejected',
                                    'completed' => 'Completed'
                                ],
                                'help' => 'Current status of the withdrawal request'
                            ]) }}
                        @else
                            <div class="form-group">
                                <label class="col-form-label">{{ trans('ecomm::content.withdrawal_status') }}</label>
                                <input type="text" class="form-control" value="{{ ucfirst($model->status ?? 'pending') }}" readonly>
                                <small class="form-text text-muted">Status can only be changed by administrators</small>
                            </div>
                        @endif
                    </div>
                </div>

                @if(Auth::check() && Auth::user()->hasRole('vendor'))
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('ecomm::content.balance_information') }}</h4>
                        </div>
                        <div class="card-body">
                            @php
                                $vendorBalance = \Mojahid\Ecommerce\Models\VendorBalance::findOrCreateForVendor(Auth::id());
                            @endphp
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <div class="stat-widget">
                                        <h3 class="text-success">{{ $vendorBalance->getAvailableBalance() }}</h3>
                                        <small class="text-muted">{{ trans('ecomm::content.available_balance') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stat-widget">
                                        <h3 class="text-warning">{{ $vendorBalance->getPendingBalance() }}</h3>
                                        <small class="text-muted">{{ trans('ecomm::content.pending_earnings') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('ecomm::content.withdrawal_summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="withdrawal-summary">
                            <div class="alert alert-info">
                                <strong>{{ trans('ecomm::content.withdrawal_request') }}</strong>
                                <div class="mt-2">
                                    <div><strong>{{ trans('ecomm::content.amount') }}:</strong> <span id="summary-amount">$0.00</span></div>
                                    <div><strong>{{ trans('ecomm::content.payment_method') }}:</strong> <span id="summary-method">-</span></div>
                                    <div><strong>{{ trans('ecomm::content.currency') }}:</strong> <span id="summary-currency">USD</span></div>
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
            // Get available balance for validation
            const availableBalance = {{ Auth::check() && Auth::user()->hasRole('vendor') ? \Mojahid\Ecommerce\Models\VendorBalance::findOrCreateForVendor(Auth::id())->getAvailableBalance() : 0 }};
            const isVendor = {{ Auth::check() && Auth::user()->hasRole('vendor') ? 'true' : 'false' }};

            // Update withdrawal summary
            function updateSummary() {
                const amount = $('#amount').val() || '0';
                const method = $('#payment_method option:selected').text() || '-';
                const currency = $('#currency_code').val() || 'USD';
                
                $('#summary-amount').text(currency + ' ' + parseFloat(amount).toFixed(2));
                $('#summary-method').text(method);
                $('#summary-currency').text(currency);
            }

            // Event listeners for summary updates
            $('#amount, #payment_method, #currency_code').on('input change', updateSummary);
            
            // Initialize summary
            updateSummary();

            // Amount validation
            $('#amount').on('blur', function() {
                const amount = parseFloat($(this).val());
                
                // Remove previous validation messages
                $(this).removeClass('is-invalid is-valid');
                $(this).siblings('.invalid-feedback').remove();
                
                if (amount < 10) {
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">Minimum withdrawal amount is $10.00</div>');
                } else if (isVendor && amount > availableBalance) {
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">Insufficient balance. Available: $' + availableBalance.toFixed(2) + '</div>');
                } else {
                    $(this).addClass('is-valid');
                }
            });

            // Form submission validation
            $('form').on('submit', function(e) {
                const amount = parseFloat($('#amount').val());
                
                if (amount < 10) {
                    e.preventDefault();
                    alert('Minimum withdrawal amount is $10.00');
                    return false;
                }
                
                if (isVendor && amount > availableBalance) {
                    e.preventDefault();
                    alert('Insufficient balance. Available balance: $' + availableBalance.toFixed(2));
                    return false;
                }
            });
        });
    </script>
@endsection
