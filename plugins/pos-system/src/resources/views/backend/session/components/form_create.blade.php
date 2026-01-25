<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Session Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Session Name</label>
                            <input type="text" 
                                   name="session_name" 
                                   class="form-control" 
                                   value="{{ old('session_name', 'Session ' . now()->format('Y-m-d H:i')) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Opening Balance <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="opening_balance" 
                                   class="form-control" 
                                   value="{{ old('opening_balance', '0.00') }}" 
                                   step="0.01" 
                                   min="0" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 'active') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" 
                              class="form-control" 
                              rows="3" 
                              placeholder="Optional notes about this session">{{ old('notes') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Expected Balance</label>
                            <input type="number" 
                                   name="expected_balance" 
                                   class="form-control" 
                                   value="{{ old('expected_balance') }}" 
                                   step="0.01" 
                                   min="0"
                                   placeholder="Expected closing balance">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Opened At</label>
                            <input type="datetime-local" 
                                   name="opened_at" 
                                   class="form-control" 
                                   value="{{ old('opened_at', now()->format('Y-m-d\TH:i')) }}">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Total Cash Sales</label>
                            <input type="number" 
                                   name="total_cash_sales" 
                                   class="form-control" 
                                   value="{{ old('total_cash_sales', '0.00') }}" 
                                   step="0.01" 
                                   min="0" 
                                   readonly>
                            <small class="text-muted">Auto-calculated</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Total Card Sales</label>
                            <input type="number" 
                                   name="total_card_sales" 
                                   class="form-control" 
                                   value="{{ old('total_card_sales', '0.00') }}" 
                                   step="0.01" 
                                   min="0" 
                                   readonly>
                            <small class="text-muted">Auto-calculated</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Total Digital Sales</label>
                            <input type="number" 
                                   name="total_digital_sales" 
                                   class="form-control" 
                                   value="{{ old('total_digital_sales', '0.00') }}" 
                                   step="0.01" 
                                   min="0" 
                                   readonly>
                            <small class="text-muted">Auto-calculated</small>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Total Transactions</label>
                    <input type="number" 
                           name="total_transactions" 
                           class="form-control" 
                           value="{{ old('total_transactions', '0') }}" 
                           min="0" 
                           readonly>
                    <small class="text-muted">Auto-calculated during session</small>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Session Settings</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    Starting a new cash register session. Make sure the opening balance reflects the actual cash in the register.
                </p>
                
                <div class="alert alert-info">
                    <strong>Note:</strong> Only one session can be active per cashier at a time.
                </div>
            </div>
        </div>
    </div>
</div> 