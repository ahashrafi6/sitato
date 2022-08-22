<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\VerifyCode;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerifyPhone extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmsChannel::class];
    }


    /**
     * Get the voice representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string[]
     */
    public function toSms($notifiable)
    {
        $code = VerifyCode::GenerateCode($notifiable->phone);

        return [
            'data' => [
                'code' => $code->code,
            ],
            'pattern' => 'ha43vqjtzm9vu29',
        ];
    }
}
