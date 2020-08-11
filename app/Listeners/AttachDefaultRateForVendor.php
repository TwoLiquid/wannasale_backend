<?php

namespace App\Listeners;

use App\Events\VendorCreated;
use App\Models\User;
use App\Notifications\NotifyOfNewVendorRegistered;
use App\Notifications\SendUserEmailConfirmMessage;
use App\Repositories\RateRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class AttachDefaultRateForVendor
{
    /**
     * Handle the event.
     *
     * @param  VendorCreated  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof VendorCreated) {

            /** @var RateRepository  $rateRepo */
            $rateRepo = app(RateRepository::class);

            /** @var VendorRepository  $vendorRepo */
            $vendorRepo = app(VendorRepository::class);

            /** @var SubscriptionRepository  $subscriptionRepo */
            $subscriptionRepo = app(SubscriptionRepository::class);
            $rate = $rateRepo->getDefault();
            $vendor = $event->getVendor();
            $user = $event->getUser();

            $subscriptionRepo->create(
                $vendor,
                $rate,
                null,
                $rate->price,
                config('currency.default.code'),
                true,
                Carbon::now(),
                Carbon::now()->addDays(config('subscription.trial.days'))
            );

            Notification::route('mail', config('mail.notification.vendor.create_email'))->notify(new NotifyOfNewVendorRegistered($user, $vendor));

            $user->notify(new SendUserEmailConfirmMessage($vendor));
        }
    }
}