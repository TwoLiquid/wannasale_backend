<?php

namespace App\Repositories;

use App\Models\Card;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class SubscriptionRepository
{
    /**
     * @param Vendor $vendor
     * @return Collection
     */
    public function getAllByVendor(Vendor $vendor) : Collection
    {
        return $vendor->subscriptions()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param Vendor $vendor
     * @return Subscription|null
     */
    public function getActiveByVendor(
        Vendor $vendor
    ) : ?Subscription
    {
        return $vendor->subscriptions()
            ->orderBy('created_at', 'asc')
            ->where('active', '=', true)
            ->first();
    }

    /**
     * @param Subscription $subscription
     * @param Card $card
     * @return bool
     */
    public function updateCard(
        Subscription $subscription,
        Card $card
    )
    {
        return $subscription->update([
            'card_id' => $card->id
        ]);
    }

    /**
     * @param Subscription $subscription
     * @return bool
     */
    public function isOutOfPayment(
        Subscription $subscription
    ) : bool
    {
        if ($subscription->finish_at < Carbon::now()->toDateString()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Vendor $vendor
     * @param Rate $rate
     * @param Card|null $card
     * @param int $price
     * @param string $currency
     * @param bool $active
     * @param Carbon $startedAt
     * @param Carbon $nextTransactionAt
     * @return Subscription
     */
    public function create(
        Vendor $vendor,
        Rate $rate,
        ?Card $card,
        int $price,
        string $currency,
        bool $active,
        Carbon $startedAt,
        Carbon $nextTransactionAt
    ) : Subscription {

        return Subscription::create([
            'vendor_id'             => $vendor->id,
            'rate_id'               => $rate->id,
            'card_id'               => !is_null($card) ? $card->id : null,
            'price'                 => $price,
            'currency'              => $currency,
            'active'                => $active,
            'started_at'            => $startedAt->toDateString(),
            'trial'                 => true,
            'next_transaction_at'   => $nextTransactionAt->toDateString(),
            'finish_at'             => $nextTransactionAt->toDateString()
        ]);
    }

    /**
     * @param Subscription $subscription
     * @param Rate $rate
     * @param Card|null $card
     * @return Subscription
     */
    public function update(
        Subscription $subscription,
        Rate $rate,
        ?Card $card
    ) : Subscription {

        /** @var Subscription $subscription */
        $subscription->update([
            'rate_id'          => $rate->id,
            'card_id'          => !is_null($card) ? $card->id : null
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @param string $externalId
     * @return Subscription
     */
    public function setExternalId(
        Subscription $subscription,
        string $externalId
    ) : Subscription
    {
        $subscription->update([
            'ext_id'    => $externalId
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @param Carbon $nextTransactionAt
     * @return Subscription
     */
    public function updateTransactionDate(
        Subscription $subscription,
        Carbon $nextTransactionAt
    ) : Subscription
    {
        $subscription->update([
            'next_transaction_at'   => $nextTransactionAt->toDateString()
        ]);

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @throws \Exception
     */
    public function delete(Subscription $subscription) : void
    {
        $subscription->delete();
    }
}
