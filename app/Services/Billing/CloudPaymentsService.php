<?php

namespace App\Services\Billing;

use App\Models\Card;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\User;
use App\Support\Billing\CloudPaymentsManager as Manager;
use App\Models\Vendor;
use App\Repositories\SubscriptionRepository;
use App\Support\Billing\Contracts\ChargeResult;
use App\Support\Billing\Error\Required3DSError;
use App\Support\Billing\Error\TransactionError;
use App\Support\Billing\Results\ChargeFailed;
use App\Support\Billing\Results\ChargeSucceeded;
use App\Support\Billing\Results\Need3DSecure;
use App\Support\Billing\TransactionInfo;
use Carbon\Carbon;
use CloudPayments\Exception\PaymentException;
use CloudPayments\Model\Required3DS;
use CloudPayments\Model\Transaction;
use Request;

class CloudPaymentsService
{
    /** @var Manager */
    protected $cloudPayments;

    /**
     * CloudPaymentsService constructor.
     */
    public function __construct()
    {
        $this->cloudPayments = new Manager(
            config('services.cloudpayments.public'),
            config('services.cloudpayments.private')
        );

        $this->cloudPayments->setLocale('ru-RU');
    }

    /**
     * @param Vendor $vendor
     * @param int $amount
     * @param string $currency
     * @param string $ip
     * @param string $name
     * @param string $cryptogram
     * @param bool $requireConfirmation
     * @return ChargeResult
     */
    public function chargeByCryptogram(
        Vendor $vendor,
        int $amount,
        string $currency,
        string $ip,
        string $name,
        string $cryptogram,
        bool $requireConfirmation = false
    ) : ChargeResult
    {
        try {
            $transaction = $this->cloudPayments->chargeCard(
                $amount, $currency, $ip, $name, $cryptogram, [
                'AccountId' => $this->getVendorAccountId($vendor)
            ], $requireConfirmation);

        } catch (PaymentException $e) {
            return new ChargeFailed(
                null,
                $e->getCardHolderMessage()
            );
        } catch (\Exception $e) {
            return new ChargeFailed(
                null,
                $e->getMessage()
            );
        }

        if ($transaction instanceof Required3DS) {
            $transactionInfo = new TransactionInfo();
            $transactionInfo->setId($transaction->getTransactionId());
            $transactionInfo->setCardToken($transaction->getToken());
            $transactionInfo->setUrl($transaction->getUrl());

            return new Need3DSecure($transactionInfo);
        }

        $transactionInfo = new TransactionInfo();
        $transactionInfo->setId($transaction->getId());
        $transactionInfo->setAmount($transaction->getAmount());
        $transactionInfo->setCurrency($transaction->getCurrency());
        $transactionInfo->setCardType($transaction->getCardType());
        $transactionInfo->setCardLastDigits($transaction->getCardLastFour());
        $transactionInfo->setCardExpMonth($transaction->getCardExpiredMonth());
        $transactionInfo->setCardExpYear($transaction->getCardExpiredYear());
        $transactionInfo->setCardToken($transaction->getToken());
        $transactionInfo->setStatusCode($transaction->getStatusCode());
        $transactionInfo->setStatus($transaction->getStatus());
        $transactionInfo->setReason($transaction->getReason());
        $transactionInfo->setMessage($transaction->getCardHolderMessage());

        return new ChargeSucceeded($transactionInfo);
    }

    public function chargeByToken(
        Vendor $vendor,
        Card $card,
        int $amount,
        string $currency,
        bool $requireConfirmation = false
    ) : ChargeResult
    {
        try {
            $transaction = $this->cloudPayments->chargeToken(
                $amount,
                $currency,
                $this->getVendorAccountId($vendor),
                $card->token, [],
                $requireConfirmation);

        } catch (PaymentException $e) {
            return new ChargeFailed(
                null,
                $e->getCardHolderMessage()
            );
        } catch (\Exception $e) {
            return new ChargeFailed(
                null,
                $e->getMessage()
            );
        }

        $transactionInfo = new TransactionInfo();
        $transactionInfo->setId($transaction->getId());
        $transactionInfo->setAmount($transaction->getAmount());
        $transactionInfo->setCurrency($transaction->getCurrency());
        $transactionInfo->setCardType($transaction->getCardType());
        $transactionInfo->setCardLastDigits($transaction->getCardLastFour());
        $transactionInfo->setCardExpMonth($transaction->getCardExpiredMonth());
        $transactionInfo->setCardExpYear($transaction->getCardExpiredYear());
        $transactionInfo->setCardToken($transaction->getToken());
        $transactionInfo->setStatusCode($transaction->getStatusCode());
        $transactionInfo->setStatus($transaction->getStatus());
        $transactionInfo->setReason($transaction->getReason());
        $transactionInfo->setMessage($transaction->getCardHolderMessage());

        return new ChargeSucceeded($transactionInfo);
    }

    /**
     * @param int $transactionId
     * @param string $paRes
     * @return ChargeSucceeded
     */
    public function confirm3DSecure(
        int $transactionId,
        string $paRes
    ) : ChargeSucceeded
    {
        try {
            $transaction = $this->cloudPayments->confirm3DS(
                $transactionId,
                $paRes
            );

        } catch (PaymentException $e) {
            return new ChargeFailed(
                null,
                $e->getCardHolderMessage()
            );
        } catch (\Exception $e) {
            return new ChargeFailed(
                null,
                $e->getMessage()
            );
        }

        $transactionInfo = new TransactionInfo();
        $transactionInfo->setId($transaction->getId());
        $transactionInfo->setAmount($transaction->getAmount());
        $transactionInfo->setCurrency($transaction->getCurrency());
        $transactionInfo->setCardType($transaction->getCardType());
        $transactionInfo->setCardLastDigits($transaction->getCardLastFour());
        $transactionInfo->setCardExpMonth($transaction->getCardExpiredMonth());
        $transactionInfo->setCardExpYear($transaction->getCardExpiredYear());
        $transactionInfo->setCardToken($transaction->getToken());
        $transactionInfo->setStatusCode($transaction->getStatusCode());
        $transactionInfo->setStatus($transaction->getStatus());
        $transactionInfo->setReason($transaction->getReason());
        $transactionInfo->setMessage($transaction->getCardHolderMessage());

        return new ChargeSucceeded($transactionInfo);
    }

    /**
     * @param int $transactionId
     * @return bool
     */
    public function voidPayment(
        int $transactionId
    ) : bool
    {
        try {
            $this->cloudPayments->voidPayment($transactionId);

        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @param Subscription $subscription
     * @param Vendor $vendor
     * @param User $user
     * @param Card $card
     * @param Carbon $startDate
     * @param int $period
     * @return TransactionError|mixed
     */
    public function createSubscription(
        Subscription $subscription,
        Vendor $vendor,
        User $user,
        Card $card,
        Carbon $startDate,
        int $period
    )
    {
        try {
            $response = $this->cloudPayments->createSubscription(
                $subscription->price,
                $subscription->currency,
                $this->getVendorAccountId($vendor),
                $card->token,
                'Ежемесячная подписка на сервис ' . config('app.name'),
                $user->email,
                $startDate->format('Y-m-d\TH:i:s\Z'),
                'Month',
                '1'
            );

            return $response;
        } catch (\Exception $e) {

            return new TransactionError($e->getMessage());
        }
    }

    /**
     * @param Vendor $vendor
     * @return string
     */
    private function getVendorAccountId(
        Vendor $vendor
    ) : string
    {
        return 'vendor_id' . $vendor->id;
    }

}