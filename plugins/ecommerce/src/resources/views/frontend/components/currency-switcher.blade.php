{% set currencies = ecom_get_available_currencies() %}
{% set currentCurrency = ecom_get_current_currency_code() %}

{% if get_config('ecomm_enable_multi_currency', false) and get_config('ecomm_allow_currency_switcher', true) and currencies|length > 1 %}
    <div class="currency-switcher">
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="currencyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="currency-symbol">{{ ecom_currency_symbol() }}</span>
                <span class="currency-code">{{ currentCurrency }}</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="currencyDropdown">
                {% for currency in currencies %}
                    <li>
                        <a class="dropdown-item {{ currency.is_current ? 'active' : '' }}" 
                           href="#" 
                           data-currency="{{ currency.code }}"
                           onclick="switchCurrency('{{ currency.code }}')">
                            <span class="currency-symbol">{{ currency.symbol }}</span>
                            <span class="currency-name">{{ currency.name }}</span>
                        </a>
                    </li>
                {% endfor %}
            </ul>
        </div>
    </div>

    <script>
        function switchCurrency(currencyCode) {
            // Send AJAX request to switch currency
            fetch('{{ route("ecomm.switch-currency") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    currency: currencyCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to reflect new currency
                    window.location.reload();
                } else {
                    console.error('Failed to switch currency:', data.message);
                }
            })
            .catch(error => {
                console.error('Error switching currency:', error);
            });
        }
    </script>

    <style>
        .currency-switcher .dropdown-toggle {
            min-width: 80px;
        }
        .currency-switcher .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .currency-switcher .dropdown-item.active {
            background-color: #e9ecef;
        }
        .currency-symbol {
            font-weight: bold;
        }
        .currency-name {
            color: #6c757d;
        }
    </style>
{% endif %} 