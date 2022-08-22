<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LastDeleteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($project)
    {
        $this->project = $project;
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

        //$notifications['server_factor_sms']  && ($notifiable->phone && $notifiable->phone_verified_at) ? array_push($via, SmsChannel::class) : '';
        ($notifiable->phone && $notifiable->phone_verified_at) ? array_push($via, SmsChannel::class) : '';
       //$notifications['server_factor_email'] ? array_push($via, 'mail') : '';
        array_push($via, 'mail');
        //$notifications['server_factor_database'] ? array_push($via, 'database') : '';
        array_push($via, 'database');

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
            ->subject('اخطار حذف برنامه | Subwp.ir')
            ->line($notifiable->name . ' عزیز برنامه شما با شناسه ' . $this->project->username . ' تا ۲۴ ساعت آینده حذف خواهد شد و اطلاعات آن به هیچ عنوان قابل بازیابی نخواهد بود، لزا هرچه سریعتر نسبت به تمدید اقدام نمایید')
            ->action(
                'مشاهده برنامه ها',
                route('projects')
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
            'title' => 'اخطار حذف برنامه',
            'description' => $notifiable->name . ' عزیز برنامه شما با شناسه ' . $this->project->username . ' تا ۲۴ ساعت آینده حذف خواهد شد و اطلاعات آن به هیچ عنوان قابل بازیابی نخواهد بود، لزا هرچه سریعتر نسبت به تمدید اقدام نمایید',
            'type' => 'factor',
            'url' => route('projects')
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
                'username' => $this->project->username
            ],
            'pattern' => '8gdhzhilxou83sn',
        ];
    }

}