<?php

namespace Mojahid\Ecommerce\Supports;

use Mojahid\Ecommerce\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Payments\Paypal;
use Mojahid\Ecommerce\Supports\Payments\Cod;
use Mojahid\Ecommerce\Contracts\Payment\PaymentMethodInterface;
use Mojahid\Ecommerce\Supports\Payments\Stripe;
use Mojahid\Ecommerce\Supports\Payments\Mollie;
use Mojahid\Ecommerce\Supports\Payments\Razorpay;
use Mojahid\Ecommerce\Supports\Payments\Flutterwave;
use Mojahid\Ecommerce\Supports\Payments\Paystack;
use Mojahid\Ecommerce\Supports\Payments\Instamojo;
use Mojahid\Ecommerce\Supports\Payments\PayMongo;
use Mojahid\Ecommerce\Supports\Payments\TwoCheckout;
use Mojahid\Ecommerce\Supports\Payments\CoinbaseCommerce;
use Mojahid\Ecommerce\Supports\Payments\Payos;
use Mojahid\Ecommerce\Supports\Payments\Square;
use Mojahid\Ecommerce\Supports\Payments\AuthorizeNet;
use Mojahid\Ecommerce\Supports\Payments\Braintree;
use Mojahid\Ecommerce\Supports\Payments\Adyen;

class Payment
{
    public function make(PaymentMethod $paymentMethod): PaymentMethodInterface
    {
        return match ($paymentMethod->type) {
            'paypal' => new Paypal($paymentMethod),
            'cod' => new Cod($paymentMethod),
            'stripe' => new Stripe($paymentMethod),
            'mollie' => new Mollie($paymentMethod),
            'razorpay' => new Razorpay($paymentMethod),
            'flutterwave' => new Flutterwave($paymentMethod),
            'paystack' => new Paystack($paymentMethod),
            'instamojo' => new Instamojo($paymentMethod),
            'paymongo' => new PayMongo($paymentMethod),
            'twocheckout' => new TwoCheckout($paymentMethod),
            default => new Cod($paymentMethod),
        };
    }

    public function purchase(PaymentMethod $paymentMethod, array $params = []): PaymentMethodInterface
    {
        return $this->make($paymentMethod)->purchase($params);
    }

    public function completed(PaymentMethod $paymentMethod, array $params): PaymentMethodInterface
    {
        return $this->make($paymentMethod)->completed($params);
    }
}
