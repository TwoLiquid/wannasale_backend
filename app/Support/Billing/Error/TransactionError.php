<?php

namespace App\Support\Billing\Error;

use CloudPayments\Model\Transaction;

class TransactionError extends Transaction
{
    /** @var string */
    protected $errorMessage;

    /**
     * TransactionError constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->errorMessage = $message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setErrorMessage(string $message)
    {
        $this->errorMessage = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}