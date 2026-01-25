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
                                   value="{{ old('session_name', $model->session_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Opening Balance</label>
                            <input type="number" 
                                   name="opening_balance" 
                                   class="form-control" 
                                   value="{{ old('opening_balance', $model->opening_balance) }}" 
                                   step="0.01" 
                                   min="0" 
                                   {{ $model->status === 'closed' ? 'readonly' : '' }}>
                        </div>
                    </div>
                </div>

                @if($model->status === 'closed')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Closing Balance</label>
                            <input type="number" 
                                   name="closing_balance" 
                                   class="form-control" 
                                   value="{{ old('closing_balance', $model->closing_balance) }}" 
                                   step="0.01" 
                                   min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Expected Balance</label>
                            <input type="number" 
                                   class="form-control" 
                                   value="{{ $model->expected_balance }}" 
                                   readonly>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $model->status) == $key ? 'selected' : '' }}>
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
                              placeholder="Optional notes about this session">{{ old('notes', $model->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Session Statistics</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Transactions</label>
                    <p class="mb-0">{{ $model->total_transactions }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Cash Sales</label>
                    <p class="mb-0">{{ pos_format_price($model->total_cash_sales) }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Card Sales</label>
                    <p class="mb-0">{{ pos_format_price($model->total_card_sales) }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Digital Sales</label>
                    <p class="mb-0">{{ pos_format_price($model->total_digital_sales) }}</p>
                </div>
                
                @if($model->status === 'closed')
                <hr>
                <div class="mb-3">
                    <label class="form-label fw-bold">Cash Difference</label>
                    <p class="mb-0 {{ $model->getCashDifference() >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ pos_format_price($model->getCashDifference()) }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div> 