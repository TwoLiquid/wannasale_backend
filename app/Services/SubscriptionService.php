<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\SubscriptionRepository;
use App\Repositories\VendorRepository;
use App\Services\Billing\BillingService;
use App\Support\Billing\Contracts\SubscriptionResult;
use App\Support\Billing\Error\TransactionError;
use App\Support\Billing\Results\ChargeFailed;
use App\Support\Billing\Results\ChargeSucceeded;
use App\Support\Billing\Results\SubscriptionFailed;
use App\Support\Billing\Results\SubscriptionSucceeded;
use Carbon\Carbon;

class SubscriptionService
{
    /**
     * @param Vendor $vendor
     * @param Rate $rate
     * @param Card|null $card
     * @param bool $trial
     * @param bool $active
     * @return Subscription|null
     */
    public function create(
        Vendor $vendor,
        Rate $rate,
        ?Card $card,
        bool $trial = true,
        bool $active = true
    ): ?Subscription
    {
        $vendorRepo = app(VendorRepository::class);
        $subscriptionRepo = app(SubscriptionRepository::class);

        $currency = config('currency.default.code');
        $trialDays = config('subscription.trial.days');

        $startedAt = Carbon::now();
        $nextTransactionAt = Carbon::now()->addDay($trialDays);

        $subscription = $subscriptionRepo->create(
            $vendor,
            $rate,
            $card,
            $rate->price,
            $currency,
            $active,
            $startedAt,
            $nextTransactionAt
        );

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function outOfPayment(
        Subscription $subscription
    ): bool
    {
        return $subscription->finish_at->lt(Carbon::now());
    }

    /**
     * @param Vendor $vendor
     * @param User $user
     * @param Card $card
     * @param Subscription $subscription
     * @param int $months
     * @return SubscriptionResult
     */
    public function payAndSubscribe(
        Vendor $vendor,
        User $user,
        Card $card,
        Subscription $subscription,
        int $months
    ) : SubscriptionResult
    {
        $billingService = app(BillingService::class);

        $paymentResult = $billingService->subscriptionPayment(
            $vendor,
            $subscription,
            $card,
            $months
        );

        if ($paymentResult instanceof ChargeFailed) {
            return new SubscriptionFailed(
                $paymentResult->getMessage()
            );
        } elseif ($paymentResult instanceof ChargeSucceeded) {

            $subscriptionResult = $billingService->createSubscription(
                $vendor,
                $subscription,
                $user,
                $card,
                $months
            );

            if ($subscriptionResult === false) {
                return new SubscriptionFailed(
                    'Не удалось создать подписку.'
                );
            }

            return new SubscriptionSucceeded(
                'Вы успешно создали и оплатили подписку.'
            );
        }
    }
}