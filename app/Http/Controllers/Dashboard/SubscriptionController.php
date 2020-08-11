<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Subscription\SubscriptionCreateRequest;
use App\Repositories\RateRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TransactionRepository;
use App\Services\Billing\BillingService;
use App\Services\Billing\CloudPaymentsService;
use App\Services\SubscriptionService;
use App\Services\TransactionService;
use App\Support\Billing\Error\TransactionError;
use App\Support\Billing\Results\ChargeFailed;
use App\Support\Billing\Results\SubscriptionFailed;
use Carbon\Carbon;
use CloudPayments\Model\Transaction;
use App\Models\Transaction as PaymentTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends BaseController
{
    public function index(
        SubscriptionRepository $subscriptionRepo,
        RateRepository $rateRepo
    )
    {
        $vendor = $this->getVendor();
        $subscription = $subscriptionRepo->getActiveByVendor($vendor);
        $rates = $rateRepo->getAll();

        return view('dashboard.subscription.index', [
            'vendor' => $vendor,
            'subscription' => $subscription,
            'rates' => $rates
        ]);
    }

    public function subscribe(
        SubscriptionCreateRequest $request,
        RateRepository $rateRepo,
        SubscriptionService $subscriptionService
    )
    {
        $vendor = $this->getVendor();
        $rate = $rateRepo->findById($request->input('rate'));

        $subscription = $subscriptionService->create(
            $vendor,
            $rate,
            null
        );

        if ($subscription === null) {
            return $this->error('Не удалось оформить подписку на тариф.');
        }

        return $this->success('Подписка успешно оформлена. У вас ' . config('subscription.trial.days') . ' бесплатных дней пробного доступа');
    }

    public function create()
    {
        return view('dashboard.subscription.create');
    }

    public function store(
        Request $request,
        SubscriptionRepository $subscriptionRepo,
        SubscriptionService $subscriptionService
    )
    {
        $user = $this->getUser();
        $vendor = $this->getVendor();
        $subscription = $subscriptionRepo->getActiveByVendor($vendor);
        $card = $subscription->card;
        $months = $request->input('months');

        if ($card === null) {
            return $this->error(
                'Необходимо привязать карту, чтобы оплатить подписку',
                route('dashboard.subscription')
            );
        }

        $subscriptionResult = $subscriptionService->payAndSubscribe(
            $vendor,
            $user,
            $card,
            $subscription,
            $months
        );

        if ($subscriptionResult instanceof SubscriptionFailed) {
            return $this->error(
                $subscriptionResult->getMessage(),
                route('dashboard.subscription')
            );
        }

        return $this->success(
            'Вы успешно оформили подписку.',
            route('dashboard.subscription')
        );
    }

    public function disabled(
        SubscriptionRepository $subscriptionRepo
    )
    {
        return view('dashboard.subscription.disabled');
    }
}
