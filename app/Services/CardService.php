<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Subscription;
use App\Models\Vendor;
use App\Repositories\CardRepository;
use App\Repositories\SubscriptionRepository;
use App\Services\Billing\BillingService;
use App\Support\Billing\TransactionInfo;

class CardService {

    /**
     * @param Vendor $vendor
     * @param Subscription $subscription
     * @param TransactionInfo $transactionInfo
     * @return Card|null
     */
    public function create(
        Vendor $vendor,
        Subscription $subscription,
        TransactionInfo $transactionInfo
    ) : ?Card
    {
        $cardRepo = app(CardRepository::class);
        $subscriptionRepo = app(SubscriptionRepository::class);
        $billingService = app(BillingService::class);

        $card = $cardRepo->create(
            $vendor,
            $transactionInfo->getMessage(),
            $transactionInfo->getCardLastDigits(),
            $transactionInfo->getCardExpMonth(),
            $transactionInfo->getCardExpYear(),
            $transactionInfo->getCardToken()
        );

        if ($card !== null) {
            $cardRepo->activateCard($vendor, $card);

            $subscriptionRepo->updateCard(
                $subscription,
                $card
            );
        }

        $billingService->voidAttachPayment(
            $subscription,
            $transactionInfo
        );

        return $card;
    }

}