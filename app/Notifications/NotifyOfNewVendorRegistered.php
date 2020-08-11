<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyOfNewVendorRegistered extends Notification
{
    use Queueable;

    protected $user;
    protected $vendor;

    /**
     * NotifyOfNewVendorRegistered constructor.
     * @param User $user
     * @param Vendor $vendor
     */
    public function __construct(User $user, Vendor $vendor)
    {
        $this->user = $user;
        $this->vendor = $vendor;
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
                    ->from(config('imap.accounts.default.username'), config('app.name'))
                    ->subject('Новая компания - ' . $this->vendor->name)
                    ->greeting('В системе wanna.sale зарегистрировалась новая компания.')
                    ->line('Название компании - ' . $this->vendor->name)
                    ->line('Имя пользователя - ' . $this->user->name)
                    ->line('E-mail пользователя - ' . $this->user->email)
                    ->line('Домен компании в системе - ' . $this->vendor->slug . '.wanna.sale')
                    ->action('Перейти к домену компании', route('dashboard.login', ['vendorSlug' => $this->vendor->slug]))
                    ->line('Спасибо!');
    }
}
