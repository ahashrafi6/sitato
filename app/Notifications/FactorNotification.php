<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FactorNotification extends Notification implements ShouldQueue
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

        $notifications['server_factor_sms']  && ($notifiable->phone && $notifiable->phone_verified_at) ? array_push($via, SmsChannel::class) : '';
        $notifications['server_factor_email'] ? array_push($via, 'mail') : '';
        $notifications['server_factor_database'] ? array_push($via, 'database') : '';

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
            ->subject('صورتحساب جدید | Subwp.ir')
            ->line($notifiable->name . ' عزیز صورتحساب ' . $this->factor['resNumber'] . 'ایجاد شد، حداکثر مهلت پرداخت (تاریخ سررسید) ' . f_date($this->factor->expire_at) . ' می باشد. جهت جلوگیری از مسدودی و حذف برنامه خود اقدام به پرداخت نمایید، باتشکر از شما')
            ->action(
                'مشاهده صورتحساب',
                route('invoice' , ['factor' => $this->factor['resNumber']])
            )
            ->line('این ایمیل صرفا جهت اطلاع رسانی می باشد، اگر شما خریدی از سایت سایتاتو نداشتید، لطفا این ایمیل را نادیده بگیرید');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'صورتحساب جدید',
            'description' => $notifiable->name . ' عزیز صورتحساب ' . $this->factor['resNumber'] . ' ایجاد شد، حداکثر مهلت پرداخت ' . f_date($this->factor->expire_at) . ' می باشد جهت جلوگیری از مسدودی و حذف برنامه خود اقدام به پرداخت نمایید',
            'type' => 'factor',
            'url' =>  route('invoice' , ['factor' => $this->factor['resNumber']])
        ];
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
            'pattern' => 'nzxw3ucuj3pq2wd',
        ];
    }

}
