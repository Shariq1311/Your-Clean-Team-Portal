<!-- Vendor Products Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('ecomm::content.products_summary') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-status-top bg-primary"></div>
                        <div class="card-body text-center">
                            <div class="h3">{{ $vendorDashboard['total_products'] }}</div>
                            <div class="text-muted">{{ trans('ecomm::content.total_products') }}</div>
                            <div class="mt-3">
                                <a href="{{ route('admin.posts.index', ['type' => 'products']) }}" class="btn btn-primary">
                                    {{ trans('ecomm::content.manage_products') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-status-top bg-green"></div>
                        <div class="card-body text-center">
                            <div class="h3">{{ trans('ecomm::content.manage_order_items') }}</div>
                            <div class="text-muted mb-3">{{ trans('ecomm::content.update_product_stock') }}</div>
                            <div class="mt-3">
                                <a href="{{ route('admin.order_items.index') }}" class="btn btn-green">
                                    {{ trans('ecomm::content.check_order_items') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('ecomm::content.quick_actions') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <a href="{{ route('admin.posts.create', ['type' => 'products']) }}" class="btn btn-outline-primary w-100">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-library-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" /><path d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" /><path d="M11 10h6" /><path d="M14 7v6" /></svg>
                                        {{ trans('ecomm::content.add_product') }}
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.order_items.index') }}" class="btn btn-outline-danger w-100">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 19h-7.5a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                                        {{ trans('ecomm::content.check_order_items') }}
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.vendor_earnings.index') }}" class="btn btn-outline-success w-100">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-moneybag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5" /><path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4" /></svg>
                                        {{ trans('ecomm::content.manage_earnings') }}
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.vendor_withdrawals.index') }}" class="btn btn-outline-info w-100">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405" /><path d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1" /><path d="M18 12l.01 0" /><path d="M6 12l.01 0" /><path d="M3 3l18 18" /></svg>
                                        {{ trans('ecomm::content.manage_withdrawals') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
