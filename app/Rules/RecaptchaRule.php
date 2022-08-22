<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class RecaptchaRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (request()->exists('g-recaptcha-response')){
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify' , [
                'secret' => config('services.recaptcha.key'),
                'response' => $value,
                'remoteip' => request()->ip,
            ]);

            return json_decode($response->getBody())->success;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'گزینه امنیتی من ربات نیستنم خاموش است! از روشن بودن آن اطمینان حاصل کنید';
    }
}
