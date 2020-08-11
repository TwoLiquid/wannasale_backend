<?php

namespace App\Console\Commands;

use App\Services\Billing\CloudPaymentsService;
use App\Services\MailService;
use Illuminate\Console\Command;

class SubscriptionsPaymentCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions-payment:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cloudPaymentsService = app(CloudPaymentsService::class);
        $cloudPaymentsService->chargeOutOfPayment();
    }
}
