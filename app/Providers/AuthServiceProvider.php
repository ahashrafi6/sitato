<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('تایید حساب کاربری | Subwp.ir')
                ->line($notifiable->name . ' عزیز، خرسندیم که به جمع اشتراک وردپرسی ها پیوستی، برای تایید حساب کاربری خود، روی دکمه تایید حساب کلیک کنید')
                ->action('تایید حساب', $url)
                ->line('اگر شما درخواست ثبت نام در سایت اشتراک وردپرس را نداشتید، لطفا این ایمیل را نادیده بگیرید');
        });
    }
}
