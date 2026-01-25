<!-- Vendor Balance Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.vendor_balance') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row row-cards">
                        <div class="col-md-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary text-white avatar">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-scale-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 20h10" /><path d="M9.452 5.425l2.548 -.425l6 1" /><path d="M12 3v5m0 4v8" /><path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0" /><path d="M18.873 14.871a3 3 0 0 0 2.127 -2.871l-3 -6l-2.677 5.355" /><path d="M3 3l18 18" /></svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ trans('ecomm::content.available_balance') }}
                                            </div>
                                            <div class="text-muted">
                                                {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($vendorDashboard['balance']['available'], $vendorDashboard['balance']['currency']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-yellow text-white avatar">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-replace"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M15 15m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" /><path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" /></svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ trans('ecomm::content.pending_balance') }}
                                            </div>
                                            <div class="text-muted">
                                                {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($vendorDashboard['balance']['pending'], $vendorDashboard['balance']['currency']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-green text-white avatar">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5" /><path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4" /></svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ trans('ecomm::content.total_earnings') }}
                                            </div>
                                            <div class="text-muted">
                                                {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($vendorDashboard['balance']['total_earnings'], $vendorDashboard['balance']['currency']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-red text-white avatar">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405" /><path d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1" /><path d="M18 12l.01 0" /><path d="M6 12l.01 0" /><path d="M3 3l18 18" /></svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ trans('ecomm::content.total_withdrawals') }}
                                            </div>
                                            <div class="text-muted">
                                                {{ \Mojahid\Ecommerce\Support\DashboardWidgetHelper::formatMoney($vendorDashboard['balance']['total_withdrawals'], $vendorDashboard['balance']['currency']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-auto">
                                    <h3 class="card-title">{{ trans('ecomm::content.earnings_trend') }}</h3>
                                </div>
                                <div class="ms-2">
                                    <a href="{{ route('admin.vendor_earnings.index') }}" class="btn btn-sm btn-primary">{{ trans('ecomm::content.view_details') }}</a>
                                </div>
                            </div>
                            <div id="earnings-chart" style="height: 180px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.vendor_withdrawals.create') }}" class="btn btn-success">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M3 8a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M18 12h.01" /><path d="M6 12h.01" /></svg>
                    {{ trans('ecomm::content.request_withdrawal') }}
                </a>
                <a href="{{ route('admin.vendor_withdrawals.index') }}" class="btn btn-outline-primary">
                    {{ trans('ecomm::content.view_withdrawals') }}
                    @if ($vendorDashboard['pending_withdrawals'] > 0)
                        <span class="badge bg-red ms-2">{{ $vendorDashboard['pending_withdrawals'] }}</span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (window.ApexCharts) {
        new ApexCharts(document.getElementById('earnings-chart'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 180,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: true
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: .16,
                type: 'solid'
            },
            stroke: {
                width: 2,
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "{{ trans('ecomm::content.earnings') }}",
                data: @json($vendorDashboard['earnings_data']['amounts'])
            }],
            grid: {
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0
                },
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                },
                categories: @json($vendorDashboard['earnings_data']['dates']),
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
            tooltip: {
                theme: 'dark'
            }
        }).render();
    }
});
</script>
