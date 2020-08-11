<?php

namespace App\Support\Billing;

class TransactionInfo
{
    /** @var int */
    protected $id;

    /** @var string|null */
    protected $url = null;

    /** @var float|null */
    protected $amount = null;

    /** @var string|null */
    protected $currency = null;

    /** @var string|null */
    protected $cardType = null;

    /** @var string|null */
    protected $cardLastDigits;

    /** @var int|null */
    protected $cardExpMonth;

    /** @var int|null */
    protected $cardExpYear;

    /** @var string|null */
    protected $cardToken;

    /** @var int|null */
    protected $statusCode;

    /** @var string|null */
    protected $status;

    /** @var string|null */
    protected $reason;

    /** @var string|null */
    protected $message;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TransactionInfo|null
     */
    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return TransactionInfo
     */
    public function setUrl(string $url) : self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount() : int
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return TransactionInfo
     */
    public function setAmount(float $amount) : self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->id;
    }

    /**
     * @param string $currency
     * @return TransactionInfo
     */
    public function setCurrency(string $currency) : self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardType() : string
    {
        return $this->cardType;
    }

    /**
     * @param string $cardType
     * @return TransactionInfo
     */
    public function setCardType(string $cardType) : self
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardLastDigits() : ?string
    {
        return $this->cardLastDigits;
    }

    /**
     * @param string $cardLastDigits
     * @return TransactionInfo
     */
    public function setCardLastDigits(string $cardLastDigits) : self
    {
        $this->cardLastDigits = $cardLastDigits;

        return $this;
    }

    /**
     * @return int
     */
    public function getCardExpMonth() : ?int
    {
        return $this->cardExpMonth;
    }

    /**
     * @param int $cardExpMonth
     * @return TransactionInfo
     */
    public function setCardExpMonth(int $cardExpMonth) : self
    {
        $this->cardExpMonth = $cardExpMonth;

        return $this;
    }

    /**
     * @return int
     */
    public function getCardExpYear() : ?int
    {
        return $this->cardExpYear;
    }

    /**
     * @param int $cardExpYear
     * @return TransactionInfo
     */
    public function setCardExpYear(int $cardExpYear) : self
    {
        $this->cardExpYear = $cardExpYear;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardToken() : ?string
    {
        return $this->cardToken;
    }

    /**
     * @param null|string $token
     * @return TransactionInfo
     */
    public function setCardToken(?string $token) : self
    {
        $this->cardToken = $token;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return TransactionInfo
     */
    public function setStatusCode(int $statusCode) : self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStatus() : ?string
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     * @return TransactionInfo
     */
    public function setStatus(?string $status) : self
    {
        $this->status = $status;

        return $this;
    }

    public function getReason() : ?string
    {
        return $this->reason;
    }

    /**
     * @param null|string $reason
     * @return TransactionInfo
     */
    public function setReason(?string $reason) : self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage() : ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     * @return TransactionInfo
     */
    public function setMessage(?string $message) : self
    {
        $this->message = $message;

        return $this;
    }

}
