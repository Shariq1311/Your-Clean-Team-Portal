<?php

namespace Mojahid\Ecommerce\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderResource;
use Mojahid\Ecommerce\Models\Product;

class MenuAction extends Action

{
    public function handle(): void
    {
        $this->addAction(
            Action::BACKEND_INIT,
            [$this, 'addAdminMenus']
        );

        $this->addAction(
            Action::FRONTEND_INIT,
            [$this, 'addProfilePages']
        );

        // // Register additional dashboard views
        $this->addAction(
            'backend.dashboard.view',
            [$this, 'registerDashboardView']
        );
    }

    public function addAdminMenus(): void
    {
        HookAction::registerAdminPage(
            'ecommerce',
            [
                'title' => trans('ecomm::content.ecommerce'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-shopee"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l.867 12.143a2 2 0 0 0 2 1.857h10.276a2 2 0 0 0 2 -1.857l.867 -12.143h-16z" /><path d="M8.5 7c0 -1.653 1.5 -4 3.5 -4s3.5 2.347 3.5 4" /><path d="M9.5 17c.413 .462 1 1 2.5 1s2.5 -.897 2.5 -2s-1 -1.5 -2.5 -2s-2 -1.47 -2 -2c0 -1.104 1 -2 2 -2s1.5 0 2.5 1" /></svg>',
                    'position' => 12,
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.orders',
            [
                'title' => trans('ecomm::content.orders'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" /><path d="M3 9l4 0" /></svg>',
                    'position' => 5,
                    'parent' => 'ecommerce',
                    'permissions' => [
                        'orders.index',
                        'orders.create',
                        'orders.edit',
                        'orders.delete',
                    ]
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.order-items',
            [
                'title' => trans('ecomm::content.order_items'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>',
                    'position' => 6,
                    'parent' => 'ecommerce',
                    'permissions' => [
                        'order_items.index',
                    ]
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.customers',
            [
                'title' => trans('ecomm::content.customers'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-group"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" /><path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M17 10h2a2 2 0 0 1 2 2v1" /><path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M3 13v-1a2 2 0 0 1 2 -2h2" /></svg>',
                    'position' => 9,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.vendors',
            [
                'title' => trans('ecomm::content.vendors'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-building-store"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M3 7h1a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-1" /><path d="M9 21v-7a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v7" /><path d="M19 21v-9a2 2 0 0 0 -2 -2h-1" /><path d="M9 12h6" /><path d="M9 16h6" /></svg>',
                    'position' => 10,
                    'parent' => 'ecommerce',
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.unverified-vendors',
            [
                'title' => trans('ecomm::content.unverified_vendors'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-clock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>',
                    'position' => 11,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.payment-methods',
            [
                'title' => trans('ecomm::content.payment_methods'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M3 10l18 0" /><path d="M7 15h10" /></svg>',
                    'position' => 12,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.settings',
            [
                'title' => trans('ecomm::content.settings'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-settings"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>',
                    'position' => 50,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.discounts',
            [
                'title' => trans('ecomm::content.discounts'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-discount"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15v-6a3 3 0 1 1 6 0v6m-3 -3h0" /><path d="M12 21a9 9 0 1 1 0 -18a9 9 0 0 1 0 18z" /></svg>',
                    'position' => 13,
                    'parent' => 'ecommerce'
                ]
            ]
        );

        // Vendor Management Menu Items
        HookAction::registerAdminPage(
            'ecommerce.vendor-balances',
            [
                'title' => trans('ecomm::content.vendor_balances'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wallet"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h10a1 1 0 0 0 1 -1v-3" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>',
                    'position' => 14,
                    'parent' => 'ecommerce',
                    'hide_from_admin' => true,
                    'permissions' => [
                        'vendor_balances.index',
                        'vendor_balances.create',
                        'vendor_balances.edit',
                        'vendor_balances.delete',
                    ]
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.vendor-earnings',
            [
                'title' => trans('ecomm::content.vendor_earnings'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-cash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M14 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-2" /></svg>',
                    'position' => 15,
                    'parent' => 'ecommerce',
                    'hide_from_admin' => true,
                    'permissions' => [
                        'vendor_earnings.index',
                        'vendor_earnings.create',
                        'vendor_earnings.edit',
                        'vendor_earnings.delete',
                    ]
                ]
            ]
        );

        HookAction::registerAdminPage(
            'ecommerce.vendor-withdrawals',
            [
                'title' => trans('ecomm::content.vendor_withdrawals'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3l18 18" /><path d="M9 5h9a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-9a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3z" /><path d="M18 12l-6 -6" /><path d="M12 6l-6 6" /></svg>',
                    'position' => 16,
                    'parent' => 'ecommerce',
                    'hide_from_admin' => true,
                    'permissions' => [
                        'vendor_withdrawals.index',
                        'vendor_withdrawals.create',
                        'vendor_withdrawals.edit',
                        'vendor_withdrawals.delete',
                    ]
                ]
            ]
        );

        // --- Custom: My Orders, My Cart, My Wishlist ---
        HookAction::registerAdminPage(
            'ecommerce.my-orders',
            [
                'title' => trans('ecomm::content.my_orders'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" /><path d="M9 11v-5a3 3 0 0 1 6 0v5" /></svg>',
                    'position' => 200,
                    'menu_header' => 'Customer',
                    'hide_from_admin' => true,
                    'permissions' => [
                        'customer.my_orders',
                    ]
                ]
            ]
        );
        
        HookAction::registerAdminPage(
            'ecommerce.my-cart',
            [
                'title' => trans('ecomm::content.my_cart'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>',
                    'position' => 210,
                    'hide_from_admin' => true,
                    'permissions' => [
                        'customer.my_cart',
                    ]
                ]
            ]
        );
        HookAction::registerAdminPage(
            'ecommerce.my-wishlist',
            [
                'title' => trans('ecomm::content.my_wishlist'),
                'menu' => [
                    'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 20l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.96 6.053" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>',
                    'position' => 220,
                     'hide_from_admin' => true,
                    'permissions' => [
                        'customer.my_wishlist',
                    ]
                ]
            ]
        );
        
        HookAction::registerAdminPage(
            'ecommerce.my-reviews',
            [
                'title' => trans('ecomm::content.my_reviews'),
                'menu' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 9h8" /><path d="M8 13h4.5" /><path d="M10.325 19.605l-2.325 1.395v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" /><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>',
                    'position' => 230,
                    'hide_from_admin' => true,
                    'permissions' => [
                        'customer.my_reviews',
                    ]
                ]
            ]
        );
    }

    public function addProfilePages(): void
    {
        // Dashboard
        HookAction::registerProfilePage(
            'dashboard',
            [
                'title' => trans('ecomm::content.dashboard'),
                'key' => 'dashboard',
                'contents' => view()->exists('theme::profile.dashboard.index') ? 'theme::profile.dashboard.index' : 'ecomm::frontend.profile.dashboard.index',
                'icon' => 'far fa-home',
                'position' => 1
            ]
        );

        HookAction::registerProfilePage(
            'orders',
            [
                'title' => trans('ecomm::content.orders'),
                'key' => 'orders',
                'contents' => view()->exists('theme::profile.orders.index') ? 'theme::profile.orders.index' : 'ecomm::frontend.profile.orders.index',
                'icon' => 'far fa-shopping-basket',
                'position' => 10,
                'data' => [
                    'orders' => OrderResource::collection(
                        Order::with(['paymentMethod'])->where('user_id', auth()?->user()?->id)
                            ->paginate(10)
                    )->response()->getData(true),
                    'thank_page' => get_config('_thanks_page')
                        ? get_page_url(get_config('_thanks_page'))
                        : null
                ]
            ]
        );

        // Account
        HookAction::registerProfilePage(
            'account',
            [
                'title' => trans('ecomm::content.account'),
                'key' => 'account',
                'contents' => view()->exists('theme::profile.account.index') ? 'theme::profile.account.index' : 'ecomm::frontend.profile.account.index',
                'icon' => 'far fa-user',
                'position' => 10,
                'data' => [
                    'user' => auth()->user()
                ]
            ]
        );

        HookAction::registerProfilePage(
            'change-password',
            [
                'title' => trans('ecomm::content.change_password'),
                'key' => 'change-password',
                // 'contents' => view()->exists('theme::profile.change-password.index') ? 'theme::profile.change-password.index' : 'ecomm::frontend.profile.change-password.index',
                'icon' => 'far fa-lock',
                'position' => 10,
                'data' => [
                    'user' => auth()->user()
                ]
            ]
        );

        HookAction::registerProfilePage(
            'logout',
            [
                'title' => trans('ecomm::content.logout'),
                'key' => 'logout',
                'icon' => 'far fa-sign-out',
            ]
        );
    }

    public function registerDashboardView(): void
    {
        // Only registered users can see dashboard widgets
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return;
        }
        
        // Admin users see all widgets
        if (\Mojahid\Ecommerce\Support\DashboardWidgetHelper::isAdmin()) {
            // Show admin widgets
            echo view('ecomm::backend.dashboard.chart-list')->render();
            echo view('ecomm::backend.dashboard.orders')->render();
            echo view('ecomm::backend.dashboard.revenue-chart')->render();
            return;
        }
        
        // Vendor users see vendor-specific widgets
        if (\Mojahid\Ecommerce\Support\DashboardWidgetHelper::isVendor()) {
            // Get vendor dashboard data
            $vendorDashboard = \Mojahid\Ecommerce\Support\DashboardWidgetHelper::getVendorDashboardSummary();
            
            // Show vendor widgets
            echo view('ecomm::backend.dashboard.vendor-balance', [
                'vendorDashboard' => $vendorDashboard
            ])->render();
            
            echo view('ecomm::backend.dashboard.vendor-orders', [
                'vendorDashboard' => $vendorDashboard
            ])->render();
            
            echo view('ecomm::backend.dashboard.vendor-products', [
                'vendorDashboard' => $vendorDashboard
            ])->render();
            
            return;
        }
        
        // Customer users see customer-specific widgets
        if (\Mojahid\Ecommerce\Support\DashboardWidgetHelper::isCustomer()) {
            // Get customer dashboard data
            $customerDashboard = \Mojahid\Ecommerce\Support\DashboardWidgetHelper::getCustomerDashboardSummary();
            
            // Show customer widget
            echo view('ecomm::backend.dashboard.customer-dashboard', [
                'customerDashboard' => $customerDashboard
            ])->render();
            
            return;
        }
    }
}
