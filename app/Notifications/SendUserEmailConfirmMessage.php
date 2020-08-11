<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendUserEmailConfirmMessage extends Notification
{
    use Queueable;

    protected $vendor;

    /**
     * SendUserEmailConfirmMessage constructor.
     * @param Vendor $vendor
     */
    public function __construct(Vendor $vendor)
    {
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
    public function toMail(User $notifiable)
    {
        return (new MailMessage)
                    ->from(config('imap.accounts.default.username'), config('app.name'))
                    ->subject('Подтверждение регистрации')
                    ->greeting('Вы зарегистрировались в системе wanna.sale!')
                    ->line('Пройдите по ссылке чтобы подтвердить регистрацию в системе.')
                    ->action('Подтвердить E-mail', route('dashboard.registration.confirm', ['vendorSlug' => $this->vendor->slug, 'email' => $notifiable->email, 'code' => $notifiable->email_confirmation_code]));
    }
}
