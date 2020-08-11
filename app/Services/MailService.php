<?php

namespace App\Services;

use App\Models\Request;
use App\Models\Site;
use App\Notifications\NotifyUserOfNewMessage;
use App\Notifications\NotifyUserOfNewRequest;
use App\Notifications\SendMessageToClient;
use App\Repositories\RequestMessageRepository;
use App\Repositories\RequestRepository;
use App\Repositories\UserRepository;
use App\Support\Notifications\ClientMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;
use Webklex\IMAP\Client;

class MailService
{
    public $client;

    /**
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     */
    public function initConnection()
    {
        $this->client = new Client([
            'host'          => config('imap.accounts.default.host'),
            'port'          => config('imap.accounts.default.port'),
            'encryption'    => config('imap.accounts.default.encryption'),
            'validate_cert' => config('imap.accounts.default.validate_cert'),
            'username'      => config('imap.accounts.default.username'),
            'password'      => config('imap.accounts.default.password'),
            'protocol'      => config('imap.accounts.default.protocol')
        ]);

        // Connect to the IMAP Server
        $this->client->connect();
    }

    public function updateRequestsMessages()
    {
        $requestRepo = app(RequestRepository::class);
        $requestMessageRepo = app(RequestMessageRepository::class);
        $userRepo = app(UserRepository::class);

        $this->initConnection();

        /** @var \Webklex\IMAP\Support\FolderCollection $folders */
        $folders = $this->client->getFolders();

        /** @var \Webklex\IMAP\Folder $oFolder */
        foreach($folders as $folder) {

            /** @var \Webklex\IMAP\Support\MessageCollection $messages */
            $messages = $folder->query()->unseen()
                ->get();

            /** @var \Webklex\IMAP\Message $message */
            foreach ($messages as $message) {

                $mailBody = $message->getHTMLBody(false);
                $mailFrom = $message->getFrom()[0]->mail;
                $mailText = $this->parseMailBody($mailBody);

                $request = $requestRepo->getRequestByClientEmail($mailFrom);

                if ($request !== null) {
                    $requestMessageRepo->createForRequest(
                        $request,
                        true,
                        $message->getSubject(),
                        strip_tags($mailText),
                        null
                    );

                    $message->delete();

                    $requestRepo->improveStatus(
                        $request,
                        Request::STATUS_WAITING_FOR_OPERATOR);

                    $users = $request->vendor->users;
                    Notification::send($users, new NotifyUserOfNewMessage($request));
                }
            }
        }
    }


    /**
     * @param Site $site
     * @param \App\Models\Client $client
     * @param string $title
     * @param string $text
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     */
    public function sendMailToClient(
        Site $site,
        \App\Models\Client $client,
        string $title,
        string $text
    )
    {
        $this->initConnection($client);

        $clientMessage = new ClientMessage(
            $site->name,
            $title,
            $text
        );

        Notification::send($client, new SendMessageToClient($clientMessage));
    }

    /**
     * @param \App\Models\Client $client
     * @return string
     */
    public function getVirtualMail(
        \App\Models\Client $client
    ) : string
    {
        $originalMail = config('imap.accounts.default.username');
        $mailPatterns = explode('@', $originalMail);
        $virtualMail = $mailPatterns[0] . '+' . $client->id . '@' . $mailPatterns[1];

        return $virtualMail;
    }

    /**
     * @param string $mailBody
     * @return string
     */
    protected function parseMailBody(string $mailBody) : string
    {
        $messageParsedText = '';
        $patterns = explode('<div><br />', $mailBody);
        if (count($patterns) > 1) {
            return $patterns[0];
        } else {
            $patterns = explode('<br>', $mailBody);
            if (count($patterns) > 1) {
                return $patterns[0];
            }
        }
    }
}
