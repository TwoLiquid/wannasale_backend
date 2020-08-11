<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\ChargeResult;
use App\Support\Billing\TransactionInfo;

class ChargeSucceeded extends BillingResult implements ChargeResult
{
    public function __construct(TransactionInfo $transaction = null)
    {
        parent::__construct(true, $transaction);
    }
}
