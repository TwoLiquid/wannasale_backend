<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\SubscriptionFailed as SubscriptionFailedContract;

class SubscriptionFailed extends BillingResult implements SubscriptionFailedContract
{
    public function __construct($message = null)
    {
        parent::__construct(false, null, $message);
    }
}
