<?php

namespace App\Notifications;

use App\Support\Notifications\ClientMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMessageToClient extends Notification
{
    use Queueable;

    protected $clientMessage;

    /**
     * SendMessageToClient constructor.
     * @param ClientMessage $clientMessage
     */
    public function __construct(ClientMessage $clientMessage)
    {
        $this->clientMessage = $clientMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from(config('imap.accounts.default.username'), $this->clientMessage->getFromName())
                    ->subject($this->clientMessage->getTitle())
                    ->greeting($this->clientMessage->getTitle())
                    ->line($this->clientMessage->getText());
    }
}
