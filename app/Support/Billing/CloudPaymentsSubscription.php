<?php

namespace App\Support\Billing;

class CloudPaymentsSubscription
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string|null
     */
    protected $startDateIso;

    /**
     * @var int|null
     */
    protected $statusCode;

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $successfulTransactionsNumber;

    /**
     * @var int|null
     */
    protected $failedTransactionsNumber;

    /**
     * @var string|null
     */
    protected $lastTransactionDateIso;

    /**
     * @var string|null
     */
    protected $nextTransactionDateIso;

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id) : void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getStartDateIso()
    {
        return $this->startDateIso;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string|null $startDateIso
     */
    public function setStartDateIso(string $startDateIso = null) : void
    {
        $this->startDateIso = $startDateIso;
    }

    /**
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int|null $statusCode
     */
    public function setStatusCode(int $statusCode = null) : void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(string $status = null) : void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getSuccessfulTransactionsNumber()
    {
        return $this->successfulTransactionsNumber;
    }

    /**
     * @param int|null $successfulTransactionsNumber
     */
    public function setSuccessfulTransactionsNumber(int $successfulTransactionsNumber = null) : void
    {
        $this->successfulTransactionsNumber = $successfulTransactionsNumber;
    }

    /**
     * @return int|null
     */
    public function getFailedTransactionsNumber()
    {
        return $this->failedTransactionsNumber;
    }

    /**
     * @param int|null $failedTransactionsNumber
     */
    public function setFailedTransactionsNumber(int $failedTransactionsNumber = null) : void
    {
        $this->failedTransactionsNumber = $failedTransactionsNumber;
    }

    /**
     * @return string|null
     */
    public function getLastTransactionDateIso()
    {
        return $this->lastTransactionDateIso;
    }

    /**
     * @param string|null $lastTransactionDateIso
     */
    public function setLastTransactionDateIso(string $lastTransactionDateIso = null) : void
    {
        $this->lastTransactionDateIso = $lastTransactionDateIso;
    }

    /**
     * @return string|null
     */
    public function getNextTransactionDateIso()
    {
        return $this->nextTransactionDateIso;
    }

    /**
     * @param string|null $nextTransactionDateIso
     */
    public function setNextTransactionDateIso(string $nextTransactionDateIso = null) : void
    {
        $this->nextTransactionDateIso = $nextTransactionDateIso;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param $params
     * @return CloudPaymentsSubscription
     */
    public static function fromArray($params)
    {
        $subscription = new self;

        $subscription->setId($params['Id']);
        $subscription->setAccountId($params['AccountId']);
        $subscription->setAmount((float)$params['Amount']);
        $subscription->setDescription($params['Description']);
        $subscription->setCurrency($params['Currency']);
        $subscription->setStartDateIso($params['StartDateIso']);
        $subscription->setStatusCode($params['StatusCode']);
        $subscription->setStatus($params['Status']);
        $subscription->setSuccessfulTransactionsNumber($params['SuccessfulTransactionsNumber']);
        $subscription->setFailedTransactionsNumber($params['FailedTransactionsNumber']);
        $subscription->setLastTransactionDateIso($params['LastTransactionDateIso']);
        $subscription->setNextTransactionDateIso($params['NextTransactionDateIso']);
        $subscription->setEmail($params['Email']);

        return $subscription;
    }
}
