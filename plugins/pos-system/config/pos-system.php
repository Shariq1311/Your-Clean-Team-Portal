<?php

return [
    'name' => 'POS System',
    'version' => '1.0.0',
    
    // POS Settings
    'settings' => [
        'tax_rate' => 0, // Default tax rate
        'receipt_footer' => 'Thank you for your business!',
        'auto_print_receipt' => true,
        'hold_order_limit' => 50,
        'default_customer_name' => 'Walk-in Customer',
    ],
    
    // Receipt Settings
    'receipt' => [
        'width' => 58, // mm
        'font_size' => 12,
        'logo_height' => 60,
        'print_customer_info' => true,
        'print_date_time' => true,
        'print_cashier_info' => true,
    ],
    
    // Order Status
    'order_status' => [
        'pending' => 'Pending',
        'completed' => 'Completed',
        'hold' => 'Hold',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded',
    ],
    
    // Payment Methods
    'payment_methods' => [
        'cash' => 'Cash',
        'card' => 'Card',
        'digital' => 'Digital Wallet',
    ],
]; 