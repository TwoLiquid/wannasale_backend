<?php

namespace App\Console\Commands;

use App\Services\MailService;
use Illuminate\Console\Command;

class UpdateRequestMailbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailbox:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks and updates new clients email messages from opened requests';

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
        $mailService = app(MailService::class);
        $mailService->updateRequestsMessages();
    }
}
