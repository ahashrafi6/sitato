<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CartNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $factor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($factor)
    {
        $this->factor = $factor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $notifications = $notifiable->notifications;

        $via = [];

        $notifications['cart_sms']  && ($notifiable->phone && $notifiable->phone_verified_at) ? array_push($via, SmsChannel::class) : '';
        $notifications['cart_email'] ? array_push($via, 'mail') : '';

        return $via;
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
            ->subject('پرداخت موفق | Sitato.ir')
            ->line($notifiable->name . ' عزیز فاکتور ' . $this->factor->resNumber . ' با موفقیت پرداخت گردید و لایسنس برنامه ها خریداری شده برایتان صادر شد، با تشکر از اعتماد شما')
            ->action(
                'مشاهده برنامه ها',
                route('projects')
            )
            ->line('این ایمیل صرفا جهت اطلاع رسانی می باشد، اگر شما خریدی از سایت سایتاتو نداشتید، لطفا این ایمیل را نادیده بگیرید');
    }


    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string[]
     */
    public function toSms($notifiable)
    {
        return [
            'data' => [
                'resnumber' => $this->factor->resNumber
            ],
            'pattern' => '64jkbbxtfs3t5nb',
        ];
    }

}
