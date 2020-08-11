<?php

namespace App\Services\Billing;

use App\Models\Card;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\SubscriptionRepository;
use App\Services\Billing\CloudPaymentsService;
use App\Services\CardService;
use App\Services\TransactionService;
use App\Support\Billing\Contracts\ChargeResult;
use App\Support\Billing\Error\Required3DSError;
use App\Support\Billing\Error\TransactionError;
use App\Support\Billing\Results\ChargeFailed;
use App\Support\Billing\Results\ChargeSucceeded;
use App\Support\Billing\Results\Need3DSecure;
use App\Support\Billing\TransactionInfo;
use App\Models\Transaction as PaymentTransaction;
use Carbon\Carbon;

class BillingService {

    /**
     * @param Vendor $vendor
     * @param Subscription $subscription
     * @param string $ip
     * @param string $name
     * @param string $cryptogram
     * @param bool $requireConfirmation
     * @return ChargeResult
     */
    public function attachCard(
        Vendor $vendor,
        Subscription $subscription,
        string $ip,
        string $name,
        string $cryptogram,
        bool $requireConfirmation = false
    ) : ChargeResult
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);

        $transaction = $cloudPaymentsService->chargeByCryptogram(
            $vendor,
            config('subscription.card.attach.amount'),
            config('currency.default.code'),
            $ip,
            $name,
            $cryptogram,
            $requireConfirmation
        );

        if ($transaction instanceof ChargeFailed) {
            return new ChargeFailed(
                null,
                $transaction->getMessage()
            );
        } else {
            return $transaction;
        }
    }

    /**
     * @param string $md
     * @param string $paRes
     * @return ChargeResult
     */
    public function confirmCard3DS(
        string $md,
        string $paRes
    ) : ChargeResult
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);

        $transaction = $cloudPaymentsService->confirm3DSecure(
            $md,
            $paRes
        );

        if ($transaction instanceof TransactionError) {
            return new ChargeFailed(
                null,
                $transaction->getErrorMessage()
            );
        } elseif ($transaction instanceof ChargeSucceeded) {
            return $transaction;
        }
    }

    /**
     * @param Subscription $subscription
     * @param TransactionInfo $transactionInfo
     * @return bool
     */
    public function voidAttachPayment(
        Subscription $subscription,
        TransactionInfo $transactionInfo
    ) : bool
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);
        $transactionService = app(TransactionService::class);

        $voidResult = $cloudPaymentsService->voidPayment(
            $transactionInfo->getId()
        );

        $transactionService->createFromInfo(
            $subscription,
            $transactionInfo,
            PaymentTransaction::TYPE_CARD_ATTACH
        );

        return $voidResult;
    }

    /**
     * @param Vendor $vendor
     * @param Subscription $subscription
     * @param Card $card
     * @param int $months
     * @return ChargeResult
     */
    public function subscriptionPayment(
        Vendor $vendor,
        Subscription $subscription,
        Card $card,
        int $months
    ) : ChargeResult
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);
        $transactionService = app(TransactionService::class);

        $totalAmount = $subscription->price * $months;

        if ($months >= 6) {
            $totalAmount = config('subscription.discount.amount') * $months;
        }

        $transaction = $cloudPaymentsService->chargeByToken(
            $vendor,
            $card,
            $totalAmount,
            config('currency.default.code')
        );

        if ($transaction instanceof ChargeFailed) {

            return new ChargeFailed(
                null,
                $transaction->getMessage()
            );
        } elseif ($transaction instanceof ChargeSucceeded) {

            $transactionInfo = $transaction->getTransaction();

            $transactionService->createFromInfo(
                $subscription,
                $transactionInfo,
                PaymentTransaction::TYPE_SUBSCRIPTION_PAYMENT
            );

            return new ChargeSucceeded($transactionInfo);
        }
    }

    /**
     * @param Vendor $vendor
     * @param Subscription $subscription
     * @param User $user
     * @param Card $card
     * @param int $months
     * @return bool
     */
    public function createSubscription(
        Vendor $vendor,
        Subscription $subscription,
        User $user,
        Card $card,
        int $months
    ) : bool
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);
        $subscriptionRepo = app(SubscriptionRepository::class);

        $nextTransactionAt = $subscription->next_transaction_at->addMonth($months);

        $subscriptionData = $cloudPaymentsService->createSubscription(
            $subscription,
            $vendor,
            $user,
            $card,
            $nextTransactionAt,
            $months
        );

        if ($subscriptionData instanceof TransactionError) {
            return false;
        } elseif (isset($subscriptionData['Id'])) {

            $subscriptionRepo->setExternalId(
                $subscription,
                $subscriptionData['Id']
            );

            $subscriptionRepo->updateTransactionDate(
                $subscription,
                $nextTransactionAt
            );

            return true;
        }
    }

}