<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject('فراموشی رمز عبور | Subwp.ir')
            ->line($notifiable->name .' عزیز برای تغییر رمز عبور خود لطفا بر روی دکمه تغییر رمز عبور کلیک کنید')
            ->action(
                'تغییر رمز عبور',
                url('reset-password/' . $this->token . '?email=' . $notifiable->email)
            )
            ->line('اگر شما درخواست تغییر رمز عبور در سایت اشتراک وردپرس را نداشتید، لطفا این ایمیل را نادیده بگیرید');
    }
}
