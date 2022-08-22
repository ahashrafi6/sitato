<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthorTicketReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $ticket;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
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

        $notifications['ticket_reply_sms']  && ($notifiable->phone && $notifiable->phone_verified_at) ? array_push($via, SmsChannel::class) : '';
        $notifications['ticket_reply_email'] ? array_push($via, 'mail') : '';
        $notifications['ticket_reply_database'] ? array_push($via, 'database') : '';

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
            ->subject('پاسخ به تیکت | Subwp.ir')
            ->line($notifiable->name . ' عزیز پاسخ جدیدی برای تیکت شما با شناسه ' . $this->ticket->tracking . ' در سایتاتو ارسال شده است،')
            ->action(
                'مشاهده تیکت',
                route('ticket' , ['ticket' => $this->ticket->tracking])
            )
            ->line('این ایمیل صرفا جهت اطلاع رسانی می باشد، اگر به شما ارتباطی نداشت، لطفا این ایمیل را نادیده بگیرید');
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
            'title' => 'پاسخ به تیکت',
            'description' => 'پاسخ جدیدی برای تیکت شما با شناسه ' . $this->ticket->tracking . ' ارسال شده است',
            'type' => 'ticket',
            'url' =>  route('ticket' , ['ticket' => $this->ticket->tracking])
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
                'tracking' => $this->ticket->tracking,
            ],
            'pattern' => 'byef2y1950s1fxr',
        ];
    }

}
