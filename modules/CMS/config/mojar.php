<?php

use MojarCMS\CMS\Facades\Facades;

return [
    /**
     * Admin url prefix
     *
     * Default: app
     */
    'admin_prefix' => env('ADMIN_PREFIX', 'app'),


    'adminbar' => [
        /**
         * Show admin-bar in frontend
         *
         * Default: true
         */
        'enable' => (bool) env('ADMINBAR_ENDABLE', true),
    ],

    'frontend' => [
        'enable' => env('MC_FRONTEND_ENABLE', true),
    ],

    'payment_methods' => [
        'cod' => 'Cash on delivery',
        'paypal' => 'Paypal',
        'custom' => 'Custom',
        'razorpay' => 'Razorpay',
        'stripe' => 'Stripe',
        'bank_transfer' => 'Bank Transfer',
        'paystack' => 'Paystack',
        'flutterwave' => 'Flutterwave',
        'instamojo' => 'Instamojo',
        'paymongo' => 'Paymongo',
        '2checkout' => '2checkout',
        'twocheckout' => '2Checkout',
        'mollie' => 'Mollie',

    ],

    /**
     * Cache prefix
     *
     * Default: Your Clean Team_
     */
    'cache_prefix' => 'Your Clean Team_',

    /**
     * Show logs in admin page
     */
    'logs_viewer' => env('MC_LOGS_VIEWER', true),

    'translation' => [
        /**
         * Enable translation CMS/Plugins/Themes
         */
        'enable' => env('MC_ENABLE_TRANSLATE', true)
    ],

    'email' => [
        /**
         * Method send email
         *
         * Support: sync, queue, cron
         * Default: sync
         */
        'method' => env('MC_MAIL_METHOD', 'sync'),

        'default' => [
            'driver' => env('MAIL_MAILER'),
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_HOST'),
            'from_address' => env('MAIL_FROM_ADDRESS'),
            'from_name' => env('MAIL_FROM_NAME'),
            'encryption' => env('MAIL_ENCRYPTION'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
        ],
    ],

    'notification' => [
        /**
         * Method send notification
         *
         * Support: sync, queue, cron
         * Default: sync
         */
        'method' => env('MC_NOTIFICATION_METHOD', 'sync'),

        /**
         * Send mail via
         *
         * Support: database, mail
         */
        'via' => [
            'database' => [
                'enable' => true,
            ],
            'mail' => [
                'enable' => true,
                'connection' => 'default',
            ]
        ]
    ],

    'theme' => [
        /**
         * Enable upload themes
         *
         * Default: true
         */
        'enable_upload' => true,

        /**
         * Themes path
         *
         * This path used for save the generated theme. This path also will added
         * automatically to list of scanned folders.
         */
        'path' => defined('MC_THEME_PATH') ? MC_THEME_PATH : base_path('themes'),
    ],

    'plugin' => [
        /**
         * Enable upload plugins
         *
         * Default: true
         */
        'enable_upload' => true,

        /**
         * Path plugins folder
         *
         * Default: plugins
         */
        'path' => defined('MC_PLUGIN_PATH') ? MC_PLUGIN_PATH : base_path('plugins'),

        /**
         * Plugins assets path
         *
         * Path for assets when it was published
         * Default: plugins
         */
        'assets' => public_path('plugins'),
    ],

    'performance' => [
        /**
         * Minify views when compile
         *
         * Default: true
         */
        'minify_views' => true,

        /**
         * Deny iframe to website
         *
         * Default: true
         */
        'deny_iframe' => (bool) env('MC_DENY_IFRAME', true),

        'query_cache' => [
            /**
             * Enable query cache (Only frontend)
             *
             * Default: true
             */
            'enable' => env('MC_QUERY_CACHE', true),

            /**
             * Query cache driver
             *
             * Default: file
             */
            'driver' => env('MC_QUERY_CACHE_DRIVER', 'file'),

            /**
             * Query cache lifetime
             *
             * Default: 3600 (1 hour)
             */
            'lifetime' => env('MC_QUERY_CACHE_LIFETIME', 3600),
        ],
    ],

    /**
     * File management setting
     */
    'filemanager' => [
        /**
         * FileSystem disk
         *
         * Default: public
         */
        'disk' => 'public',

        /**
         * Enable upload from url
         *
         * Default: true
         */
        'upload_from_url' => (bool) env('UPLOAD_FROM_URL', true),

        /**
         * Optimizer image after upload
         *
         * @see https://Your Clean Team.com/documentation/start/image-optimizer
         */
        'image-optimizer' => (bool) env('IMAGE_OPTIMIZER', false),

        'svg_mimetypes' => [
            ...Facades::defaultSVGMimetypes(),
            //
        ],

        /**
         * Server Side Image Resizer
         *
         * Default: true
         */
        'image_resizer' => env('MC_IMAGE_RESIZER', false),

        /**
         * File type
         *
         * Default: file, image
         */
        'types' => [
            'file'  => [
                /**
                 * Max file size upload
                 *
                 * Default: 50 (MB)
                 */
                'max_size' => env('MC_MEDIA_FILE_MAX_SIZE', 50),
                'valid_mime' => [
                    ...Facades::defaultFileMimetypes(),
                    //
                ],
                'extensions' => [
                    ...Facades::defaultFileExtensions(),
                    //
                ],
            ],
            'image' => [
                /**
                 * Max image size upload
                 *
                 * Default: 5 (MB)
                 */
                'max_size' => env('MC_MEDIA_IMAGE_MAX_SIZE', 5),

                'valid_mime' => [
                    ...Facades::defaultImageMimetypes(),
                    //
                ],
                'extensions' => [
                    ...Facades::defaultImageExtensions(),
                    //
                ],
            ],
        ],
    ],

    'api' => [
        'enable' => env('MC_ALLOW_API', true),
        'external-service' => env('MC_ALLOW_EXTERNAL_SERVICE', true),
        /**
         * Frontend API configs
         */
        'frontend' => [
            'enable' => env('MC_ALLOW_FRONTEND_API', env('MC_ALLOW_API', true)),
        ],
        /**
         * API URL for update system
         */
        'url' => env('MC_API_URL', 'https://cms.Your Clean Teamsoft.com/api'),
    ],

    /**
     * Default database config
     */
    'config' => array_merge(
        Facades::defaultConfigs(),
        [
            //
        ]
    ),
];
