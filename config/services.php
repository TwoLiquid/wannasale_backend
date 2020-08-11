<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET')
    ],

    'cloudpayments' => [
        'public'  => env('CLOUDPAYMENTS_PUBLIC', 'pk_bb5d5c33f949e7eda2837e6ffb79b'),
        'private' => env('CLOUDPAYMENTS_PRIVATE', '360e2b655889c96c130a21558ddec990')
    ],

];
