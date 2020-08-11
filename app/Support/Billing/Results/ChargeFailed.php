<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\ChargeResult;
use App\Support\Billing\TransactionInfo;

class ChargeFailed extends BillingResult implements ChargeResult
{
    public function __construct(TransactionInfo $transaction = null, $message = null)
    {
        parent::__construct(false, $transaction, $message);
    }
}
