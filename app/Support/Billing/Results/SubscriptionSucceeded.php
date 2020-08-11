<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\SubscriptionSucceeded as SubscriptionSucceededContract;

class SubscriptionSucceeded extends BillingResult implements SubscriptionSucceededContract
{
    public function __construct($message = null)
    {
        parent::__construct(false, null, $message);
    }
}
