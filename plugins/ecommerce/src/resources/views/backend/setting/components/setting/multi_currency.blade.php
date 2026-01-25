@php
    use Mojahid\Ecommerce\Models\Currency;
    $currencies = Currency::orderBy('code')->get();
    $defaultCurrency = Currency::default()->first();
@endphp

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Multi-Currency Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure multi-currency options for your store.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Enable Multi-Currency'), 'ecomm_enable_multi_currency', [
                        'checked' => get_config('ecomm_enable_multi_currency', 0) == 1,
                        'class' => 'form-check-input',
                        'description' => __('Allow customers to switch between different currencies.'),
                    ]) }}
                    <small class="form-text text-muted">{{ __('Allow customers to switch between different currencies.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox(__('Allow Currency Switcher'), 'ecomm_allow_currency_switcher', [
                        'checked' => get_config('ecomm_allow_currency_switcher', 1) == 1,
                        'class' => 'form-check-input',
                        'description' => __('Show currency switcher on frontend.'),
                    ]) }}
                    <small class="form-text text-muted">{{ __('Show currency switcher on frontend.') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox(__('Auto-Detect Currency by IP'), 'ecomm_auto_detect_currency', [
                    'checked' => get_config('ecomm_auto_detect_currency', 0) == 1,
                    'class' => 'form-check-input',
                    'description' => __('Automatically detect user currency based on IP address.'),
                ]) }}
                <small class="form-text text-muted">{{ __('Automatically detect user currency based on IP address.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                {{ Field::select(__('Force Checkout Currency'), 'ecomm_force_checkout_currency', [
                    'value' => get_config('ecomm_force_checkout_currency'),
                    'options' => getAvailableCurrencyCodes(),
                    'class' => 'form-select',
                    'help' => __('Force checkout to use specific currency (leave empty to use user selected currency).'),
                ]) }}
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Exchange Rate Settings') }}</h5>
        <div class="card-subtitle">
            {{ __('Configure automatic exchange rate updates.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {{ Field::select(__('Exchange Rate API'), 'ecomm_exchange_rate_api', [
                    'value' => get_config('ecomm_exchange_rate_api'),
                    'options' => [
                        '' => __('None - Manual Updates'),
                        'api_layer' => 'API Layer (Fixer.io)',
                        'open_exchange' => 'Open Exchange Rates',
                    ],
                    'class' => 'form-select',
                    'help' => __('Select API for automatic exchange rate updates.'),
                ]) }}
            </div>
            <div class="col-md-6">
                {{ Field::text(__('Exchange Rate API Key'), 'ecomm_exchange_rate_api_key', [
                    'value' => get_config('ecomm_exchange_rate_api_key'),
                    'class' => 'form-control',
                    'help' => __('API key for automatic exchange rate updates.'),
                ]) }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-check form-switch mb-3">
                {{ Field::checkbox(__('Auto Update Exchange Rates'), 'ecomm_auto_update_exchange', [
                    'checked' => get_config('ecomm_auto_update_exchange', 0) == 1,
                    'class' => 'form-check-input',
                    'description' => __('Automatically update exchange rates daily.'),
                ]) }}
                <small class="form-text text-muted">{{ __('Automatically update exchange rates daily.') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                {{ Field::text(__('Last Updated'), 'ecomm_exchange_rate_last_updated', [
                    'value' => get_config('ecomm_exchange_rate_last_updated', date('Y-m-d')),
                    'class' => 'form-control',
                    'disabled' => 'disabled',
                    'help' => __('Date of last exchange rate update.'),
                ]) }}
            </div>
        </div>

        @if(get_config('ecomm_exchange_rate_api'))
            <div class="alert alert-info mt-3">
                <strong>{{ __('API Information:') }}</strong><br>
                @if(get_config('ecomm_exchange_rate_api') === 'api_layer')
                    {{ __('API Layer (Fixer.io) - Free tier: 100 requests/month') }}
                @elseif(get_config('ecomm_exchange_rate_api') === 'open_exchange')
                    {{ __('Open Exchange Rates - Free tier: 1000 requests/month') }}
                @endif
            </div>
        @endif
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Currency Management') }}</h5>
        <div class="card-subtitle">
            {{ __('Manage available currencies and their settings.') }}
        </div>
    </div>
    <div class="card-body">
        @if($currencies->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="currency-table">
                    <thead>
                        <tr>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Symbol') }}</th>
                            <th>{{ __('Exchange Rate') }}</th>
                            <th>{{ __('Enabled') }}</th>
                            <th>{{ __('Default') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencies as $currency)
                            <tr>
                                <td>
                                    <input type="text" name="currencies[{{ $currency->id }}][code]" 
                                           value="{{ $currency->code }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="currencies[{{ $currency->id }}][name]" 
                                           value="{{ $currency->name }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="currencies[{{ $currency->id }}][symbol]" 
                                           value="{{ $currency->symbol }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="currencies[{{ $currency->id }}][exchange_rate]" 
                                           value="{{ $currency->exchange_rate }}" class="form-control" 
                                           step="0.000001" min="0" required>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="currencies[{{ $currency->id }}][is_enabled]" 
                                           {{ $currency->is_enabled ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="default_currency_id" value="{{ $currency->id }}" 
                                           {{ $currency->is_default ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            data-action="delete-currency" data-id="{{ $currency->id }}"
                                            onclick="deleteCurrency({{ $currency->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                {{ __('No currencies configured. Please add at least one currency.') }}
            </div>
        @endif

        <div class="mt-3">
            <button type="button" id="add-new-currency" class="btn btn-secondary">
                <i class="fas fa-plus"></i> {{ __('Add New Currency') }}
            </button>
        </div>
    </div>
</div>

<!-- Currency Switcher Preview -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title">{{ __('Currency Switcher Preview') }}</h5>
        <div class="card-subtitle">
            {{ __('Preview of how the currency switcher will appear on frontend.') }}
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Current Currency:') }}</label>
                    <select id="currency-switcher-preview" class="form-select">
                        @foreach($currencies->where('is_enabled', true) as $currency)
                            <option value="{{ $currency->code }}" 
                                    data-symbol="{{ $currency->symbol }}"
                                    data-rate="{{ $currency->exchange_rate }}"
                                    {{ $currency->is_default ? 'selected' : '' }}>
                                {{ $currency->full_display_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Sample Price:') }}</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" id="sample-price" value="99.99" class="form-control" step="0.01">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-3">
            <label>{{ __('Formatted Price:') }}</label>
            <div class="alert alert-info" id="formatted-price">
                $99.99
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.querySelector('#currency-table tbody');
    const addBtn = document.getElementById('add-new-currency');
    const currencySwitcher = document.getElementById('currency-switcher-preview');
    const samplePrice = document.getElementById('sample-price');
    const formattedPrice = document.getElementById('formatted-price');

    // Add new currency row
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            const randomId = 'new_' + Date.now();
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" name="currencies[${randomId}][code]" class="form-control" required></td>
                <td><input type="text" name="currencies[${randomId}][name]" class="form-control" required></td>
                <td><input type="text" name="currencies[${randomId}][symbol]" class="form-control" required></td>
                <td><input type="number" name="currencies[${randomId}][exchange_rate]" value="1" class="form-control" step="0.000001" min="0" required></td>
                <td class="text-center">
                    <input type="checkbox" name="currencies[${randomId}][is_enabled]" checked>
                </td>
                <td class="text-center">
                    <input type="radio" name="default_currency_id" value="${randomId}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" data-action="remove-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Handle removing rows
    if (tableBody) {
        tableBody.addEventListener('click', function(e) {
            if (e.target.matches('[data-action="remove-row"]')) {
                e.target.closest('tr').remove();
            }
            if (e.target.matches('[data-action="delete-currency"]')) {
                if (confirm('{{ __("Are you sure you want to delete this currency?") }}')) {
                    e.target.closest('tr').remove();
                }
            }
        });
    }

    // Currency switcher preview
    function updateFormattedPrice() {
        const selectedOption = currencySwitcher.options[currencySwitcher.selectedIndex];
        const symbol = selectedOption.dataset.symbol || '$';
        const rate = parseFloat(selectedOption.dataset.rate) || 1;
        const price = parseFloat(samplePrice.value) || 0;
        const convertedPrice = price * rate;
        
        formattedPrice.textContent = symbol + convertedPrice.toFixed(2);
    }

    // Delete currency function
    function deleteCurrency(currencyId) {
        if (confirm('{{ __("Are you sure you want to delete this currency?") }}')) {
            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            // form.action = '{{ route("admin.ecommerce.settings.save") }}';
            form.action = '{{ url("admin/ecommerce/settings/save") }}';
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            // Add delete currency parameter
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'delete_currency_id';
            deleteInput.value = currencyId;
            form.appendChild(deleteInput);
            
            // Submit the form
            document.body.appendChild(form);
            form.submit();
        }
    }

    if (currencySwitcher && samplePrice) {
        currencySwitcher.addEventListener('change', updateFormattedPrice);
        samplePrice.addEventListener('input', updateFormattedPrice);
        updateFormattedPrice();
    }
});
</script>
