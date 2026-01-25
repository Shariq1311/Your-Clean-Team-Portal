<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojarcms.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Order as OrderModel;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Mojahid\Ecommerce\Supports\Payment;
use MojarCMS\CMS\Models\User;
use Illuminate\Support\Facades\Log;

class Order implements OrderInterface
{
    protected OrderModel $order;

    protected Payment $payment;

    public function __construct(
        OrderModel $order,
        Payment $payment
    ) {
        $this->order = $order;

        $this->payment = $payment;
    }

    public function purchase(): PaymentMethodInterface
    {
        return $this->payment->purchase(
            $this->order->paymentMethod,
            $this->getPurchaseParams()
        );
    }

    public function completed(?array $input): bool
    {
        $params = array_merge($this->getPurchaseParams(), $input);

        $completed = $this->payment->completed(
            $this->order->paymentMethod,
            $params
        );

        if ($completed->isSuccessful()) {
            $this->order->update(
                [
                    'payment_status' => OrderModel::PAYMENT_STATUS_COMPLETED
                ]
            );
            
            // Handle commission for vendor products
            $this->handleCommissionForOrder();

            return true;
        }

        return false;
    }

    public function getPaymentRedirectURL(): string
    {
        $response = $this->purchase();

        return $response->getRedirectURL();
    }

    public function getOrder(): OrderModel
    {
        return $this->order;
    }

    public function getItems(): Collection
    {
        return $this->order->orderItems;
    }

    public function getPurchaseParams(): array
    {
        return [
            'amount' => $this->order->total,
            'currency' => get_config('ecom_currency', 'USD'),
            'cancelUrl' => $this->getCancelURL(),
            'returnUrl' => $this->getReturnURL(),
        ];
    }

    protected function getReturnURL(): string
    {
        return route('ajax', ['payment/completed'])
            . $this->getOrderUrlQuery();
    }

    protected function getCancelURL(): string
    {
        return route('ajax', ['payment/cancel'])
            . $this->getOrderUrlQuery();
    }

    protected function getOrderUrlQuery(): string
    {
        return '?order=' . $this->order->code . '&method='. $this->order->payment_method_id;
    }
    
    protected function handleCommissionForOrder(): void
    {
        $commissionRate = (float) get_config('ecomm_default_commission_rate', 10); // Default 10%
        
        foreach ($this->order->orderItems as $orderItem) {
            $post = $orderItem->post;
            if (!$post) continue;

            Log::info($post, ['Post']);
            
            // Get the user who created the product (vendor)
            $vendorUser = User::find($post->created_by);
            if (!$vendorUser) continue;

            Log::info($vendorUser, ['Vendor user']);
            
            // Check if the product creator is not an admin (i.e., is a vendor)
            if (is_admin($vendorUser)) {
                // If admin created the product, no commission split needed
                continue;
            }

            
            // This is a vendor product, handle commission
            $vendorId = $vendorUser->id;
            
            
            // Calculate commission amounts
            $totalAmount = $orderItem->line_price;
            $commissionAmount = ($totalAmount * $commissionRate) / 100;
            $vendorAmount = $totalAmount - $commissionAmount;
            Log::info($vendorAmount, ['Vendor amount']);  
            // Create vendor earning record
            \Mojahid\Ecommerce\Models\VendorEarning::create([
                'vendor_id' => $vendorId,
                'order_id' => $this->order->id,
                'order_amount' => $totalAmount,
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

            Log::info($vendorBalance, ['Vendor balance']);
            
            // Add commission to admin wallet/balance
            $this->addCommissionToAdmin($commissionAmount);
        }
    }

    /**
     * Add commission amount to admin wallet/balance
     */
    protected function addCommissionToAdmin(float $commissionAmount): void
    {
        // You can implement this based on how you handle admin earnings
        // For example, you might have an AdminEarning model or update a config value
        
        // Option 1: Create an admin earning record
        // \Mojahid\Ecommerce\Models\AdminEarning::create([
        //     'order_id' => $this->order->id,
        //     'amount' => $commissionAmount,
        //     'type' => 'commission',
        //     'currency' => get_config('ecom_currency', 'USD'),
        // ]);
        
        // Option 2: Update admin balance if you have such a system
        // $adminBalance = \Mojahid\Ecommerce\Models\AdminBalance::first();
        // $adminBalance->addCommission($commissionAmount);
        
        // For now, you can log it or implement based on your system
        Log::info("Admin commission earned: {$commissionAmount} for order: {$this->order->id}");
    }
}
