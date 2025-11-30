<?php

return [

    'default' => 'zarinpal',

    'drivers' => [

        'zarinpal' => [
            'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
            'default' => 'sandbox',  // sandbox || payment
            'routes' => [
                'sandbox' => [
                    'request_url' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
                    'verify_url' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',
                    'startPay_url' => 'https://sandbox.zarinpal.com/pg/StartPay/',
                ],
                'payment' => [
                    'request_url' => 'https://payment.zarinpal.com/pg/v4/payment/request.json',
                    'verify_url' => 'https://payment.zarinpal.com/pg/v4/payment/verify.json',
                    'startPay_url' => 'https://payment.zarinpal.com/pg/StartPay/',
                ]
            ]
        ],

        'zibal' => [
            'merchant_id' => env('ZIBAL_MERCHANT_ID'),
            'routes' => [
                'request_url' => 'https://gateway.zibal.ir/v1/request',
                'verify_url' => 'https://gateway.zibal.ir/v1/verify',
                'startPay_url' => 'https://gateway.zibal.ir/start/',
            ],
        ]
    ],

];
