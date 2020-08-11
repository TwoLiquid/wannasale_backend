<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use App\Support\Billing\TransactionInfo;

class TransactionService {

    /**
     * @param Subscription $subscription
     * @param TransactionInfo $transactionInfo
     * @param int $type
     * @return Transaction|null
     */
    public function createFromInfo(
        Subscription $subscription,
        TransactionInfo $transactionInfo,
        int $type
    ) : ?Transaction
    {
        $transactionRepo = app(TransactionRepository::class);

        $transaction = $transactionRepo->create(
            $subscription,
            $type,
            $transactionInfo->getId(),
            $transactionInfo->getAmount(),
            config('currency.default.code'),
            $transactionInfo->getCardType(),
            $transactionInfo->getCardLastDigits(),
            $transactionInfo->getCardExpMonth(),
            $transactionInfo->getCardExpYear(),
            $transactionInfo->getCardToken(),
            $transactionInfo->getStatusCode(),
            $transactionInfo->getStatus(),
            $transactionInfo->getReason(),
            $transactionInfo->getMessage()
        );

        return $transaction;
    }

}