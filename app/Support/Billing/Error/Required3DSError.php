<?php

namespace App\Support\Billing\Error;

use CloudPayments\Model\Required3DS;

class Required3DSError extends Required3DS
{
    /** @var string */
    protected $errorMessage;

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