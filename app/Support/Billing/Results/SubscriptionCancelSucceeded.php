<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\SubscriptionCancelResult;

class SubscriptionCancelSucceeded extends BillingResult implements SubscriptionCancelResult
{
    public function __construct()
    {
        parent::__construct(true);
    }
}
