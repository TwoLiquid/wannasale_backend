<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyUserOfNewMessage extends Notification
{
    use Queueable;

    protected $request;

    /**
     *
     * Create a new notification instance.
     *
     * NotifyUserOfNewMessage constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
                    ->from(config('imap.accounts.default.username'), $this->request->site->name)
                    ->subject('Новое сообщение от клиента')
                    ->greeting('Вы получили новое сообщение!')
                    ->line('Получено новое сообщение от клиента по запросу. Вы можете перейти сразу к переписке, воспользовавшись ссылкой в письме.')
                    ->action('Перейти к переписке', route('dashboard.requests.messages', ['vendorSlug' => $this->request->vendor->slug, 'uuid' => $this->request->id]))
                    ->line('Спасибо!');
    }
}
