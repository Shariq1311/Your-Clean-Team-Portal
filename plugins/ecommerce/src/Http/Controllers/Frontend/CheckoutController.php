<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use MojarCMS\Backend\Events\RegisterSuccessful;
use MojarCMS\CMS\Events\EmailHook;
use MojarCMS\CMS\Http\Controllers\FrontendController;
use MojarCMS\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Events\OrderSuccess;
use Mojahid\Ecommerce\Events\PaymentSuccess;
use Mojahid\Ecommerce\Http\Requests\CheckoutRequest;
use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Http\Resources\CartResource;

class CheckoutController extends FrontendController
{
    protected CartManagerContract $cartManager;

    protected OrderManagerContract $orderManager;

    public function __construct(
        CartManagerContract $cartManager,
        OrderManagerContract $orderManager
    ) {
        $this->cartManager = $cartManager;
        $this->orderManager = $orderManager;
    }

    /**
     * @throws \Throwable
     */
    public function checkout(Request $request): JsonResponse|RedirectResponse
    {
        // Manual validation to avoid content field issues
        $validationRules = [
            'payment_method_id' => 'required|integer|exists:payment_methods,id',
        ];

        global $mc_user;
        if (empty($mc_user)) {
            $validationRules['email'] = 'required|email|max:150';
            $validationRules['name'] = 'required|max:150';
        }

        $request->validate($validationRules);

        $cart = $this->cartManager->find();

        if ($cart->isEmpty()) {
            return $this->error(
                [
                    'message' => __('Cart is empty.'),
                ]
            );
        }

        DB::beginTransaction();
        try {
            $user = $this->getOrderUser($request);

            $newOrder = $this->orderManager->createByCart(
                $cart,
                $request->all(),
                $user
            );

            $cart->remove();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        event(new OrderSuccess($newOrder, $user));

        $params = apply_filters(
            'ecom_checkout_success_email_params',
            [
                'name' => $user->name,
                'email' => $user->email,
                'order_code' => $newOrder->getOrder()->code,
            ],
            $user,
            $newOrder->getOrder()
        );

        event(
            new EmailHook(
                'checkout_success',
                [
                    'to' => $user->email,
                    'params' => $params,
                ]
            )
        );

        try {
            $purchase = $newOrder->purchase();

            $redirect = $purchase->isRedirect() ?
                $purchase->getRedirectURL() :
                    $this->getThanksPageURL($newOrder->getOrder());
            return $this->success(
                [
                    'redirect' => $redirect,
                    'message' => trans('ecomm::content.order_thanks'),
                ]
            );


        } catch (\Exception $e) {
            report($e);

            return $this->error(
                [
                    'redirect' => $this->getThanksPageURL($newOrder->getOrder()),
                    'message' => 'Cannot get payment url.',
                ]
            );
        }
    }

    public function cancel(Request $request): RedirectResponse
    {
        $order = Order::findByCode($request->input('order'));

        return redirect()->to($this->getThanksPageURL($order));
    }

    public function completed(Request $request): RedirectResponse
    {
        $helper = $this->orderManager->find($request->input('order'));
        $order = $helper->getOrder();

        if ($order->isPaymentCompleted()) {
            return redirect()->to($this->getThanksPageURL($order));
        }

        if ($helper?->completed($request->all())) {
            $params = apply_filters(
                'ecom_payment_success_email_params',
                [
                    'name' => $helper->getOrder()?->user->name,
                    'email' => $helper->getOrder()?->user->email,
                    'order_code' => $helper->getOrder()->code,
                ],
                $order?->user,
                $order
            );

            if ($order?->user->email) {
                event(
                    new EmailHook(
                        'payment_success',
                        [
                            'to' => $order->user->email,
                            'params' => $params,
                        ]
                    )
                );
            }

            event(new PaymentSuccess($order));
            
            // Handle commission for vendor products  this is managed in Order class
        }

        return redirect()->to($this->getThanksPageURL($order));
    }

    protected function getOrderUser(Request $request): User
    {
        global $mc_user;

        if ($mc_user) {
            return $mc_user;
        }

        $email = $request->input('email');
        if ($user = User::whereEmail($email)->first()) {
            return $user;
        }

        $password = Hash::make(Str::random());
        $user = new User();
        $user->fill(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]
        );

        $user->setAttribute('password', $password);
        $user->save();

        event(new RegisterSuccessful($user));

        return $user;
    }

    protected function getThanksPageURL(Order $order): string
    {
        if (!$thanksPage = get_config('_thanks_page')) {
            return '/';
        }

        $thanksPage = get_page_url($thanksPage);

        if (empty($thanksPage)) {
            return '/';
        }

        return "{$thanksPage}/{$order->token}";
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

    public function index()
    {
        $cart = $this->cartManager->find();

        if ($cart->isEmpty()) {
            return redirect()->route('ecomm.cart');
        }

        $methods = PaymentMethod::active()->get();
        $cartResource = new CartResource($cart);
        $cartData = $cartResource->toArray(request());

        return view('ecomm::frontend.checkout.index', [
            'cart' => $cart,
            'cart_data' => $cartData,
            'requires_shipping' => true,
            'user' => auth()->user(),
            'guest' => !auth()->check(),
            'auth' => auth()->check(),
            'countrys' => $this->getCountries(),
            'provinces' => $this->getProvinces(),
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

    public function store(Request $request): JsonResponse
    {
        try {
            $cart = $this->cartManager->find();

            if ($cart->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => trans('ecomm::content.cart_empty')
                ], 422);
            }

            DB::beginTransaction();
            try {
                $user = $this->getOrderUser($request);

                $orderSupport = $this->orderManager->createByCart(
                    $cart,
                    $request->all(),
                    $user
                );

                $order = $orderSupport->getOrder();

                $cart->remove();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => trans('ecomm::content.order_placed_successfully'),
                    'redirect' => $this->getThanksPageURL($order)
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            // Handle address/shipping updates here
            return response()->json([
                'status' => 'success',
                'data' => [
                    'shipping_fee' => 0,
                    'shipping_fee_formatted' => ecom_price_with_unit(0),
                    'total_formatted' => ecom_price_with_unit(0)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function getShipping(Request $request): JsonResponse
    {
        try {
            $provinceId = $request->input('provinceId', 0);
            $districtId = $request->input('districtId', 0);
            $code = $request->input('code');
            $shippingMethod = $request->input('shippingMethod');
            $email = $request->input('email');
            
            // Calculate shipping fee based on location
            $shippingFee = $this->calculateShippingFee($provinceId, $districtId);
            
            // Example shipping methods - you should get these from your database
            $shippingMethods = [
                [
                    'id' => 'standard',
                    'name' => 'Standard Shipping',
                    'value' => 'standard',
                    'fee' => $shippingFee,
                    'fee_formatted' => number_format($shippingFee) . ' ₫'
                ],
                [
                    'id' => 'express',
                    'name' => 'Express Shipping', 
                    'value' => 'express',
                    'fee' => $shippingFee + 50000,
                    'fee_formatted' => number_format($shippingFee + 50000) . ' ₫'
                ]
            ];
            
            // Calculate totals
            $totalLineItemPrice = $this->calculateCartTotal();
            $discount = $this->calculateDiscount($code);
            $totalPrice = $totalLineItemPrice + $shippingFee - $discount;
            
            return response()->json([
                // Required by frontend - these fields are accessed directly
                'error' => false, // CRITICAL: prevents empty shippingMethods array
                
                // Promotion/discount related
                'exist_code' => !empty($code) ? $this->validatePromotionCode($code) : false,
                'apply_with_promotion' => true,
                'free_shipping' => $shippingFee == 0,
                'discount' => $discount,
                'discount_shipping' => 0, // Additional shipping discount
                
                // Price calculations
                'total_line_item_price' => $totalLineItemPrice,
                'total_price' => $totalPrice,
                
                // CRITICAL: Shipping methods array - frontend loops through this
                'shipping_methods' => $shippingMethods,
                
                // Selected shipping method (should match one of the values above)
                'shipping_method' => $shippingMethod ?: 'standard',
                
                // Status
                'status' => 'success',
                'message' => 'Shipping calculated successfully'
            ]);
            
        } catch (\Exception $e) {
            // Error response structure
            return response()->json([
                'error' => true, // CRITICAL: prevents frontend from processing
                'status' => 'error',
                'message' => $e->getMessage(),
                
                // Still provide empty arrays to prevent undefined errors
                'shipping_methods' => [],
                'exist_code' => false,
                'apply_with_promotion' => false,
                'free_shipping' => false,
                'discount' => 0,
                'total_line_item_price' => 0,
                'total_price' => 0,
                'discount_shipping' => 0,
                'shipping_method' => 'standard'
            ], 422);
        }
    }

    // Helper methods you'll need to implement
    private function calculateShippingFee($provinceId, $districtId)
    {
        // Implement your shipping calculation logic
        if ($provinceId == 0 || $districtId == 0) {
            return 0; // Free shipping for invalid locations or international
        }
        
        // Example logic - replace with your actual calculation
        return 25000; // 25,000 VND base shipping fee
    }

    private function validatePromotionCode($code)
    {
        if (empty($code)) return false;
        
        // Implement your promotion code validation
        // Return true if code exists and is valid
        return true; // Placeholder
    }

    private function calculateDiscount($code)
    {
        if (empty($code)) return 0;
        
        // Implement discount calculation based on promotion code
        return 0; // Placeholder
    }

    private function calculateCartTotal()
    {
        // Calculate cart/line items total
        // This should be the sum of all products in cart before shipping/discount
        return 100000; // Placeholder - 100,000 VND
    }

    public function updateAddress(Request $request): JsonResponse
    {
        try {
            // Handle address update logic here
            return response()->json([
                'status' => 'success',
                'message' => 'Address updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function applyDiscount(Request $request): JsonResponse
    {
        try {
            $code = strtoupper(trim($request->input('code')));
            
            if (empty($code)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a coupon code'
                ], 400);
            }

            $cart = $this->cartManager->find();
            
            if ($cart->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ], 400);
            }

            DB::beginTransaction();
            try {
                $result = $cart->applyDiscount($code);
                DB::commit();

                $cartResource = new CartResource($cart);
                
                return response()->json([
                    'success' => $result['success'],
                    'message' => $result['message'],
                    'cart' => [
                        'data' => $cartResource->toArray($request)
                    ]
                ])->withCookie(Cookie::make('mc_cart', $cart->getCode(), 43200));

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function removeDiscount(Request $request): JsonResponse
    {
        try {
            $code = trim($request->input('code'));
            
            if (empty($code)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon code is required'
                ], 400);
            }

            $cart = $this->cartManager->find();

            DB::beginTransaction();
            try {
                $result = $cart->removeDiscount($code);
                DB::commit();

                $cartResource = new CartResource($cart);
                
                return response()->json([
                    'success' => $result['success'],
                    'message' => $result['message'],
                    'cart' => [
                        'data' => $cartResource->toArray($request)
                    ]
                ])->withCookie(Cookie::make('mc_cart', $cart->getCode(), 43200));

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function getCountries(): array
    {
        // Implement your country fetching logic
        return [];
    }

    protected function getProvinces(): array
    {
        // Implement your province fetching logic
        return [];
    }
}
