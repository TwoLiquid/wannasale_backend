<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends BaseController
{
    public function index(
        SubscriptionRepository $subscriptionRepo,
        TransactionRepository $transactionRepo
    )
    {
        $vendor = $this->getVendor();

        $subscriptions = $vendor->subscriptions;

        return view('dashboard.transactions.index', [
            'subscriptions' => $subscriptions
        ]);
    }
}
