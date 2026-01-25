<?php

namespace Mojahid\Ecommerce\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Http\Resources\PaymentMethodCollectionResource;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController as FrontendCartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController as FrontendCheckoutController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\WishlistController as FrontendWishlistController;
use Mojahid\Ecommerce\Models\Currency;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EcommerceAction extends Action
{
    private const HOOK_PRIORITY = 20;
    private const HOOK_PARAMS_COUNT = 2;
    
    public function handle(): void
    {
        $this->registerInitActions();
        $this->registerThemeFilters();
        $this->registerFrontendActions();
        $this->registerSettingActions();
        
        $this->registerVendorActions();
    }

    private function registerInitActions(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerConfigs']);
    }

    private function registerThemeFilters(): void
    {
        $this->addFilter(
            'theme.get_view_page',
            [$this, 'addCheckoutPage'],
            self::HOOK_PRIORITY,
            self::HOOK_PARAMS_COUNT
        );

        $this->addFilter(
            'theme.get_params_page',
            [$this, 'addCheckoutParams'],
            self::HOOK_PRIORITY,
            self::HOOK_PARAMS_COUNT
        );

        $this->addFilter(
            'ecommerce.format_price',
            [$this, 'convertAndFormatPrice'],
            self::HOOK_PRIORITY,
            self::HOOK_PARAMS_COUNT
        );
    }

    private function registerFrontendActions(): void
    {
        $this->addAction(Action::FRONTEND_CALL_ACTION, [$this, 'registerFrontendAjaxs']);
    }

    private function registerSettingActions(): void
    {
        $this->addAction('Mojarcms.setting.save', [$this, 'saveSetting']);
    }

    private function registerVendorActions(): void
    {
        $this->addAction('vendor.status.approved', [$this, 'handleVendorApproval']);
        $this->addAction('vendor.status.rejected', [$this, 'handleVendorRejection']);
        $this->addAction('vendor.status.suspended', [$this, 'handleVendorSuspension']);
        
        $this->addAction('user.after_save', [$this, 'handleUserAfterSave'], 20, 2);
        
        // Handle commission when payment is completed
        $this->addAction('order.update_status', [$this, 'handleOrderStatusUpdate']);
    }

    public function registerConfigs(): void
    {
        HookAction::registerConfig([
            '_checkout_page', 
            '_thanks_page',
            'ecomm_default_commission_rate',
            'ecomm_withdrawal_fee_type',
            'ecomm_withdrawal_fee_amount'
        ]);
    }

    public function addCheckoutPage($view, $page): string
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');


        if ($checkoutPage == $page->id) {
            return 'ecomm::frontend.checkout.index';
        }

        if ($thanksPage == $page->id) {
            return 'ecomm::frontend.checkout.thankyou';
        }

        return $view;
    }

    public function addCheckoutParams($params, $page)
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');
        if ($checkoutPage == $page->id) {
            $methods = PaymentMethod::active()->get();
            return array_merge($params, [
                'payment_methods' => $methods->map(function($method) {
                    return [
                        'id' => $method->id,
                        'type' => $method->type,
                        'name' => $method->name,
                        'description' => $method->description,
                        'image' => $method->image
                    ];
                })->toArray()
            ]);
        }
        // add title
        if ($thanksPage == $page->id) {
            $params['title'] = 'Thank you';
            $orderToken = request()?->segment(2);

            abort_if($orderToken === null, 404);

            $order = Order::findByToken($orderToken);

            abort_if($order === null, 404);

            $order->load(['orderItems', 'paymentMethod']);
            // $order->loadExists(['downloadableProducts']);
            $params['order'] = OrderResource::make($order)->toArray(request());
        }

        return $params;
    }

    public function convertAndFormatPrice(string $formatted = '', ?float $basePrice = null): string
    {
        $currencyManager = app(CurrencyManager::class);
        
        return $currencyManager->formatPrice(
            $currencyManager->convertPrice($basePrice)
        );
    }
    
    public function registerFrontendAjaxs(): void
    {
          // Checkout specific AJAX routes
          HookAction::registerFrontendAjax(
            'checkout.apply-discount',
            [
                'callback' => [FrontendCheckoutController::class, 'applyDiscount'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'checkout.remove-discount',
            [
                'callback' => [FrontendCheckoutController::class, 'removeDiscount'],
                'method' => 'POST',
            ]
        );


        HookAction::registerFrontendAjax(
            'checkout.update-address',
            [
                'callback' => [FrontendCheckoutController::class, 'updateAddress'],
                'method' => 'POST',
            ]
        );


        HookAction::registerFrontendAjax(
            'checkout',
            [
                'callback' => [FrontendCheckoutController::class, 'checkout'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.add-to-cart',
            [
                'callback' => [FrontendCartController::class, 'addToCart'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.get-items',
            [
                'callback' => [FrontendCartController::class, 'getCartItems'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.remove-item',
            [
                'callback' => [FrontendCartController::class, 'removeItem'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.update',
            [
                'callback' => [FrontendCartController::class, 'update'],
                'method' => 'POST',
                'name' => 'cart.update'
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.apply-discount',
            [
                'callback' => [FrontendCartController::class, 'applyDiscount'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.remove-discount',
            [
                'callback' => [FrontendCartController::class, 'removeDiscount'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.add',
            [
                'callback' => [FrontendWishlistController::class, 'addToWishlist'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.get-items',
            [
                'callback' => [FrontendWishlistController::class, 'getWishlistItems'],
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.remove',
            [
                'callback' => [FrontendWishlistController::class, 'removeItem'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.move-to-cart',
            [
                'callback' => [FrontendWishlistController::class, 'moveToCart'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.move-all-to-cart',
            [
                'callback' => [FrontendWishlistController::class, 'moveAllToCart'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'wishlist.clear',
            [
                'callback' => [FrontendWishlistController::class, 'remove'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.cancel',
            [
                'callback' => [FrontendCheckoutController::class, 'cancel'],
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.completed',
            [
                'callback' => [FrontendCheckoutController::class, 'completed'],
            ]
        );

      
    }
  

    public function handleVendorApproval($user): void
    {
        $this->sendVendorStatusEmail($user, 'approved', 'ecomm::emails.vendor.approved');
    }

    public function handleVendorRejection($user): void
    {
        $this->sendVendorStatusEmail($user, 'rejected', 'ecomm::emails.vendor.rejected');
    }

    public function handleVendorSuspension($user): void
    {
        $this->sendVendorStatusEmail($user, 'suspended', 'ecomm::emails.vendor.suspended');
    }
    
    public function handleOrderStatusUpdate($order, $status, $type): void
    {
        // Handle commission when payment is completed
        if ($type === 'payment' && $status === 'completed') {
            $this->handleCommissionForOrder($order);
        }
    }
    
    protected function handleCommissionForOrder($order): void
    {
        $commissionRate = (float) get_config('ecomm_default_commission_rate', 10); // Default 10%
        
        foreach ($order->orderItems as $orderItem) {
            $post = $orderItem->post;
            if (!$post) continue;
            
            $vendorId = $post->getMeta('vendor_id');
            if (!$vendorId) continue;
            
            // Calculate commission amounts
            $totalAmount = $orderItem->line_price;
            $commissionAmount = ($totalAmount * $commissionRate) / 100;
            $vendorAmount = $totalAmount - $commissionAmount;
            
            // Create vendor earning record
            \Mojahid\Ecommerce\Models\VendorEarning::create([
                'vendor_id' => $vendorId,
                'order_id' => $order->id,
                'order_item_id' => $orderItem->id,
                'post_id' => $orderItem->post_id,
                'total_amount' => $totalAmount,
                'commission_rate' => $commissionRate,
                'commission_amount' => $commissionAmount,
                'vendor_amount' => $vendorAmount,
                'status' => 'pending',
                'currency' => get_config('ecom_currency', 'USD'),
            ]);
            
            // Update vendor balance
            $vendorBalance = \Mojahid\Ecommerce\Models\VendorBalance::findOrCreateForVendor($vendorId);
            $vendorBalance->addPendingEarning($vendorAmount);
        }
    }

    public function handleUserAfterSave($data, $user): void
    {
        // Check if vendor status changed
        if (isset($data['vendor_status'])) {
            $userType = $user->getMeta('user_type');
            if ($userType === 'vendor') {
                $vendorStatus = $data['vendor_status'];
                
                // Log for debugging
                Log::info('Vendor status change detected in hook', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'vendor_status' => $vendorStatus,
                    'user_type' => $userType
                ]);
                
                // Make sure role is properly assigned/removed
                $vendorRole = \MojarCMS\CMS\Models\Role::where('name', 'vendor')->first();
                if ($vendorRole) {
                    // Ensure user model is refreshed
                    $user->refresh();
                    
                    if (in_array($vendorStatus, ['approved', 'active'])) {
                        // Assign vendor role
                        $user->syncRoles('vendor');
                        
                        // Verify role assignment
                        $userRoles = $user->roles()->pluck('name')->toArray();
                        
                        // Log for debugging
                        Log::info('Vendor role assigned in hook', [
                            'user_id' => $user->id,
                            'user_email' => $user->email,
                            'vendor_status' => $vendorStatus,
                            'vendor_role_id' => $vendorRole->id,
                            'user_roles' => $userRoles
                        ]);
                    } else {
                        // Remove vendor role if status is not approved/active
                        $user->removeRole('vendor');
                        
                        // Verify role removal
                        $userRoles = $user->roles()->pluck('name')->toArray();
                        
                        // Log for debugging
                        Log::info('Vendor role removed in hook', [
                            'user_id' => $user->id,
                            'user_email' => $user->email,
                            'vendor_status' => $vendorStatus,
                            'user_roles' => $userRoles
                        ]);
                    }
                }
                
                // Send appropriate email based on status change
                switch ($vendorStatus) {
                    case 'approved':
                        $this->sendVendorStatusEmail($user, 'approved', 'ecomm::emails.vendor.approved');
                        break;
                    case 'rejected':
                        $this->sendVendorStatusEmail($user, 'rejected', 'ecomm::emails.vendor.rejected');
                        break;
                    case 'suspended':
                        $this->sendVendorStatusEmail($user, 'suspended', 'ecomm::emails.vendor.suspended');
                        break;
                }
            }
        }
    }

    private function sendVendorStatusEmail($user, $status, $template): void
    {
        try {
            Log::info('Sending vendor status email', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'status' => $status,
                'template' => $template
            ]);
            
            $emailData = [
                'user' => $user,
                'status' => $status,
                'shop_name' => $user->getMeta('shop_name'),
            ];
            
            $body = view($template, $emailData)->render();
            
            Mail::send('cms::backend.email.layouts.default', [
                'body' => $body
            ], function ($message) use ($user, $status) {
                $message->to($user->email)
                    ->subject(trans('ecomm::content.emails.status_subject', ['status' => trans('ecomm::content.' . $status)]));
            });
            
            Log::info('Vendor status email sent successfully', [
                'user_id' => $user->id,
                'status' => $status
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the flow
            Log::error('Failed to send vendor status email: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'status' => $status,
                'template' => $template,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function saveSetting(Request $request)
    {
        // Handle currency deletion first
        $deleteCurrencyId = $request->input('delete_currency_id');
        if ($deleteCurrencyId) {
            $currency = Currency::find($deleteCurrencyId);
            if ($currency && !$currency->is_default) {
                $currency->delete();
                return redirect()->back()->with('success', __('Currency deleted successfully.'));
            } else {
                return redirect()->back()->with('error', __('Cannot delete default currency.'));
            }
        }

        $this->saveCurrencySettings($request);
        $this->processCurrencies($request);
        
        return redirect()->back()->with('success', __('Settings saved.'));
    }

    private function saveCurrencySettings(Request $request): void
    {
        $settings = [
            'ecomm_enable_multi_currency' => $request->input('ecomm_enable_multi_currency', 0),
            'ecomm_allow_currency_switcher' => $request->input('ecomm_allow_currency_switcher', 1),
            'ecomm_auto_detect_currency' => $request->input('ecomm_auto_detect_currency', 0),
            'ecomm_force_checkout_currency' => $request->input('ecomm_force_checkout_currency'),
            'ecomm_exchange_rate_api' => $request->input('ecomm_exchange_rate_api'),
            'ecomm_exchange_rate_api_key' => $request->input('ecomm_exchange_rate_api_key'),
            'ecomm_auto_update_exchange' => $request->input('ecomm_auto_update_exchange', 0),
        ];

        foreach ($settings as $key => $value) {
            set_config($key, $value);
        }
    }

    private function processCurrencies(Request $request): void
    {
        $currenciesData = $request->input('currencies', []);
        $defaultId = $request->input('default_currency_id');

        // Reset old defaults
        Currency::where('is_default', true)->update(['is_default' => false]);

        foreach ($currenciesData as $rowId => $data) {
            if (is_numeric($rowId)) {
                $this->updateExistingCurrency($rowId, $data);
            } else {
                $this->createNewCurrency($data);
            }
        }

        $this->setDefaultCurrency($defaultId);
    }

    private function updateExistingCurrency(int $id, array $data): void
    {
        $currency = Currency::find($id);
        
        if (!$currency) {
            return;
        }

        $currency->update([
            'code' => $data['code'] ?? $currency->code,
            'name' => $data['name'] ?? $currency->name,
            'symbol' => $data['symbol'] ?? $currency->symbol,
            'exchange_rate' => floatval($data['exchange_rate'] ?? 1),
            'is_enabled' => isset($data['is_enabled']),
            'is_default' => false,
        ]);
    }

    private function createNewCurrency(array $data): void
    {
        Currency::create([
            'code' => $data['code'] ?? '',
            'name' => $data['name'] ?? '',
            'symbol' => $data['symbol'] ?? '',
            'exchange_rate' => floatval($data['exchange_rate'] ?? 1),
            'is_enabled' => isset($data['is_enabled']),
            'is_default' => false,
        ]);
    }

    private function setDefaultCurrency(?int $defaultId): void
    {
        if (!$defaultId) {
            return;
        }

        $currency = Currency::find($defaultId);
        
        if ($currency) {
            $currency->update(['is_default' => true]);
        }
    }
}