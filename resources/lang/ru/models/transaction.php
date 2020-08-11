<?php

use App\Models\Transaction;

return [

    /*
    |--------------------------------------------------------------------------
    | Transaction Language Lines
    |--------------------------------------------------------------------------
    */

    'type' => [
        Transaction::TYPE_CARD_ATTACH => 'Привязка карты',
        Transaction::TYPE_SUBSCRIPTION_PAYMENT => 'Оплата подписки',
        Transaction::TYPE_REGULAR_PAYMENT => 'Ежемесячная оплата'
    ]

];
