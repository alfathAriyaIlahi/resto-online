<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | File ini menyimpan kredensial untuk layanan pihak ketiga seperti Midtrans,
    | Mailgun, dan lainnya. Data diambil dari file .env untuk keamanan.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'midtrans' => [
        'merchantId' => env('MIDTRANS_MERCHANT_ID', 'M913762921'),
        'clientKey' => env('MIDTRANS_CLIENT_KEY', 'Mid-client-h-KwbUaKg0MnFgFa'),
        'serverKey' => env('MIDTRANS_SERVER_KEY', 'Mid-server-ZWoX5aswGs1Z3cjqtgQk_VC4'),
        'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
        'isSanitized' => true,
        'is3ds' => true,
    ],

];
