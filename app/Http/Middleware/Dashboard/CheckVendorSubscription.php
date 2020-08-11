<?php

namespace App\Http\Middleware\Dashboard;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\SubscriptionRepository;
use App\Repositories\VendorRepository;
use App\Services\SubscriptionService;
use App\Support\Response\GeneralResponseTrait;
use Closure;

class CheckVendorSubscription
{
    use GeneralResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $vendorSlug = get_url_default('vendorSlug');
        if ($vendorSlug !== null) {

            /** @var User|null $user */
            $user = auth(GUARD_DASHBOARD)->user();
            if ($user !== null) {

                /** @var VendorRepository $vendorRepo */
                $vendorRepo = app(VendorRepository::class);

                /** @var SubscriptionRepository $subscriptionRepo */
                $subscriptionRepo = app(SubscriptionRepository::class);

                /** @var SubscriptionService $subscriptionService */
                $subscriptionService = app(SubscriptionService::class);

                $vendor = $vendorRepo->findActiveBySlug($vendorSlug);

                /** @var Subscription $vendorSubscription */
                $vendorSubscription = $subscriptionRepo->getActiveByVendor($vendor);

                if ($vendorSubscription === null) {
                    return redirect()->route('dashboard.subscription');
                }

                if ($vendorSubscription->active === false) {
                    return redirect()->route('dashboard.subscription.disabled');
                }

                if ($subscriptionService->outOfPayment($vendorSubscription) === true) {
                    return redirect()->route('dashboard.subscription');
                }
            }
        }

        return $next($request);
    }
}
