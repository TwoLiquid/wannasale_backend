<?php

namespace App\Support\Billing\Results;

use App\Support\Billing\Contracts\BillingResult as BillingResultContract;
use App\Support\Billing\TransactionInfo;

abstract class BillingResult implements BillingResultContract
{
    /** @var bool */
    protected $success = false;

    /** @var string|null */
    protected $message = null;

    /** @var TransactionInfo|null */
    protected $transaction = null;

    public function __construct(bool $success, TransactionInfo $transaction = null, string $message = null)
    {
        $this->success = $success;
        if (is_string($message)) {
            $this->message = $message;
        }
        $this->transaction = $transaction;
    }

    /**
     * @return bool
     */
    public function isSuccessful() : bool
    {
        return (bool) $this->success;
    }

    /**
     * @return bool
     */
    public function isUnsuccessful() : bool
    {
        return !((bool) $this->success);
    }

    /**
     * @return string|null
     */
    public function getMessage() : ?string
    {
        $message = $this->message;
        if ($message && !ends_with($message, '.')) {
            $message = $message . '.';
        }

        return $message;
    }

    /**
     * @param string $message
     * @return self
     */
    public function setMessage($message) : self
    {
        if (is_string($message)) {
            $this->message = $message;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasTransaction() : bool
    {
        return $this->transaction !== null;
    }

    /**
     * @return TransactionInfo|null
     */
    public function getTransaction() : ?TransactionInfo
    {
        return $this->transaction;
    }
}
