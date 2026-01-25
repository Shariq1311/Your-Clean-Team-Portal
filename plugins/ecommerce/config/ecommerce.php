<?php

return [
    /**
     * Cart Helper class support
     */
    'cart' => \Mojahid\Ecommerce\Supports\DBCart::class,

    /**
     * Wishlist Helper class support
     */
    'wishlist' => \Mojahid\Ecommerce\Supports\DBWishlist::class,

    /**
     * Payment method supported
     */
    'payment_methods' => [
        'cod' => 'Cash on delivery',
        'paypal' => 'PayPal',
        'stripe' => 'Stripe',
        'mollie' => 'Mollie',
        'razorpay' => 'Razorpay',
        'flutterwave' => 'Flutterwave', 
        'paystack' => 'Paystack',
        'instamojo' => 'Instamojo',
        'paymongo' => 'PayMongo',
        '2checkout' => '2Checkout',
        'twocheckout' => 'twocheckout',
        'coinbase' => 'Coinbase Commerce',
        'payos' => 'PayOS',
        'square' => 'Square',
        'authorizenet' => 'Authorize.Net',
        'braintree' => 'Braintree',
        'adyen' => 'Adyen',
        'bank_transfer' => 'Bank Transfer',
        'custom' => 'Custom',
    ],
];
