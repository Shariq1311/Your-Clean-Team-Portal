<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Order Number <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="order_number" 
                                   class="form-control" 
                                   value="{{ old('order_number', pos_generate_order_number()) }}" 
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="customer_name" 
                                   class="form-control" 
                                   value="{{ old('customer_name', pos_get_default_customer()) }}" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Phone</label>
                            <input type="text" 
                                   name="customer_phone" 
                                   class="form-control" 
                                   value="{{ old('customer_phone') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" 
                                   name="customer_email" 
                                   class="form-control" 
                                   value="{{ old('customer_email') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <select name="payment_method" class="form-control" required>
                                @foreach($payment_methods as $key => $label)
                                    <option value="{{ $key }}" {{ old('payment_method', 'cash') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', 'pending') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" 
                              class="form-control" 
                              rows="3" 
                              placeholder="Optional order notes">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Totals</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Subtotal <span class="text-danger">*</span></label>
                    <input type="number" 
                           name="subtotal" 
                           class="form-control" 
                           value="{{ old('subtotal', '0.00') }}" 
                           step="0.01" 
                           min="0" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tax Amount</label>
                    <input type="number" 
                           name="tax_amount" 
                           class="form-control" 
                           value="{{ old('tax_amount', '0.00') }}" 
                           step="0.01" 
                           min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Discount Amount</label>
                    <input type="number" 
                           name="discount_amount" 
                           class="form-control" 
                           value="{{ old('discount_amount', '0.00') }}" 
                           step="0.01" 
                           min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Amount <span class="text-danger">*</span></label>
                    <input type="number" 
                           name="total_amount" 
                           class="form-control" 
                           value="{{ old('total_amount', '0.00') }}" 
                           step="0.01" 
                           min="0" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Paid Amount</label>
                    <input type="number" 
                           name="paid_amount" 
                           class="form-control" 
                           value="{{ old('paid_amount', '0.00') }}" 
                           step="0.01" 
                           min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Amount</label>
                    <input type="number" 
                           name="change_amount" 
                           class="form-control" 
                           value="{{ old('change_amount', '0.00') }}" 
                           step="0.01" 
                           min="0" 
                           readonly>
                </div>
            </div>
        </div>
    </div>
</div> 