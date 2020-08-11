<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyUserOfNewRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $request;

    /**
     *
     * Create a new notification instance.
     *
     * NotifyUserOfNewRequest constructor.
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
                    ->subject('Новый запрос от клиента')
                    ->greeting('Вы получили новый запрос!')
                    ->line('Получен новый запрос на предложение цены. Вы можете перейти сразу к нему, воспользовавшись ссылкой в письме.')
                    ->action('Перейти на сайт', route('dashboard.requests.view', $this->request->id))
                    ->line('Спасибо!');
    }
}
