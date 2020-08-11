<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Project subscriptions settings
    |--------------------------------------------------------------------------
    */

    'trial' => [
        'days' => env('SUBSCRIPTION_TRIAL_DAYS', 14)
    ],

    'discount' => [
        'amount' => env('SUBSCRIPTION_DISCOUNT_AMOUNT', 1249)
    ],

    'card' => [
        'attach' => [
            'amount' => env('CARD_ATTACH_AMOUNT', 1)
        ]
    ]

];
