<?php


namespace App\Channels;

use App\Classes\Farazsms;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    private $gate;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->gate = new Farazsms();
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        $this->gate->send($notifiable->phone ,$message['data'], $message['pattern']);

    }
}
