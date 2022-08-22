<?php

use App\Models\Discount;
use App\Models\WalletGift;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


if (!function_exists('get_bank_list')) {
    function get_bank_list(): array
    {
        return [
            'meli' => "بانک ملی",
            'sepah' => "بانک سپه",
            'tosea-saderat' => "بانک توسعه صادرات",
            'maadan' => "بانک صنعت و معدن",
            'keshavarzi' => "بانک کشاورزی",
            'maskan' => "بانک مسکن",
            'postbank' => "پست بانک",
            'taavon' => "بانک توسعه و تعاون",
            'novin' => "بانک اقتصاد نوین",
            'parsiyan' => "بانک پارسیان",
            'pasargad' => "بانک پاسارگاد",
            'zarinpal' => "بانک زرین پال",
            'karafarin' => "بانک کارآفرین",
            'saman' => "بانک سامان",
            'sina' => "بانک سینا",
            'sarmayeh' => "بانک سرمایه",
            'shahr' => "بانک شهر",
            'dey' => "بانک دی",
            'saderat' => "بانک صادرات",
            'mellat' => "بانک ملت",
            'tejarat' => "بانک تجارت",
            'refah' => "بانک رفا کارگران",
            'hekmat-iranian' => "بانک حکمت ایرانیان",
            'gardeshgari' => "بانک گردشگری",
            'iranzamin' => "بانک ایران زمین",
            'qavamin' => "بانک قوامین",
            'ansar' => "بانک انصار",
            'khavarmiyaneh' => "بانک خاورمیانه",
            'venezuela' => "بانک ایران و ونزوئلا",
            'ayanadeh' => "بانک آینده",
            'mehr-iran' => "قرض الحسنه مهر ایران",
            'resalat' => "موسسه اعتباری رسالت",
            'tosea' => "موسسه اعتباری توسعه",
            'melal' => "موسسه اعتباری ملل",
            'noor' => "موسسه اعتباری نور",
            'kosar' => "موسسه اعتباری کوثر",
        ];
    }
}
if (!function_exists('get_ticket_expire_hour')) {
    function get_ticket_expire_hour(): array
    {
        // بازه 9 صبح تا 10 شب
        // میزان ساعت مهلت پاسخدهی تیکت ها
        return [
            0 => 9,
            1 => 8,
            2 => 7,
            3 => 6,
            4 => 5,
            5 => 4,
            6 => 3,
            7 => 2,
            8 => 2,
            9 => 2,
            10 => 2,
            11 => 2,
            12 => 2,
            13 => 2,
            14 => 2,
            15 => 2,
            16 => 2,
            17 => 2,
            18 => 2,
            19 => 2,
            20 => 13,
            21 => 12,
            22 => 11,
            23 => 10,
        ];
    }
}
if (!function_exists('get_ticket_expire_at')) {
    function get_ticket_expire_at(): \Illuminate\Support\Carbon
    {
        $now = now();
        $current_hour = $now->hour;
        $add_hour = get_ticket_expire_hour()[$current_hour];

        /*$diff = 0;
        if ($current_hour == 20 || $current_hour == 21){
            $diff = $now->diffInMinutes($now->hour(22)->minute(0));
        }
        if ($current_hour == 7 || $current_hour == 8){
            $diff = $now->diffInMinutes($now->hour(9)->minute(0));
        }*/

        //$now->addHours($add_hour)->addMinutes($diff);
        return $now->addHours($add_hour);
    }
}
if (!function_exists('sanitize_domain')) {
    function sanitize_domain($domain)
    {
        // remove port
        $domain = preg_replace('/:\d+$/', '', $domain);
        // remove www
        //$domain = str_ireplace('www.', '', $domain);
        // remove http://
        $domain = str_ireplace('http://', '', $domain);
        // remove https://
        $domain = str_ireplace('https://', '', $domain);
        // remove /
        $domain = str_ireplace('/', '', $domain);

        return trim($domain);
    }
}
if (!function_exists('default_user_notifications')) {
    function default_user_notifications()
    {
        return [
            'login_sms' => false,
            'login_database' => false,

            'cart_sms' => true,
            'cart_email' => true,

            'ticket_reply_sms' => true,
            'ticket_reply_email' => false,
            'ticket_reply_database' => true,

            'server_factor_sms' => true,
            'server_factor_email' => true,
            'server_factor_database' => true,

            'server_factor_sms' => true,
            'server_factor_email' => true,
            'server_factor_database' => true,

        ];
    }
}


if (!function_exists('except')) {
    function except($text, $limit = 100)
    {
        return Str::limit(strip_tags($text), $limit);
    }
}
if (!function_exists('img_url')) {
    function img_url($path)
    {
        return env('IMAGE_SERVER_URL') . '/' . $path;
    }
}
if (!function_exists('download_s3')) {
    function download_s3($key)
    {
        $arr = explode('/', $key);
        return route('download_s3', ['folder' => $arr[0] , 'sub_folder' => $arr[1]]);
    }
}
if (!function_exists('small_price')) {
    function small_price($price)
    {
        if ($price == 0) {
            return 0;
        }

        $price = (string)$price;
        $length = Str::length($price);

        if ($length <= 4) {
            // 7000
            $little = Str::substr(Str::substr($price, 1, 3), 0, 1);
            if ($little == '0') {
                return number_format($price / 1000);
            } else {
                return Str::substr($price, 0, 1) . ',' . $little;
            }
        } elseif ($length <= 5) {
            // 79000
            $little = Str::substr(Str::substr($price, 2, 4), 0, 1);
            if ($little == '0') {
                return number_format($price / 1000);
            } else {
                return Str::substr($price, 0, 2) . ',' . $little;
            }
        } elseif ($length <= 6) {
            // 399000
            $little = Str::substr(Str::substr($price, 3, 5), 0, 1);
            if ($little == '0') {
                return number_format($price / 1000);
            } else {
                return Str::substr($price, 0, 3) . ',' . $little;
            }
        } else {
            // 1333000
            $little = Str::substr(Str::substr($price, 4, 6), 0, 1);
            if ($little == '0') {
                return number_format($price / 1000);
            } else {
                return Str::substr($price, 0, 4) . ',' . $little;
            }
        }
    }
}
if (!function_exists('get_discount_percent')) {
    function get_discount_percent($price, $offPrice)
    {
        $number = ($price - $offPrice);
        return (int) round(($number * 100) / $price);
    }
}

// date
if (!function_exists('v_date')) {
    function v_date($date)
    {
        return verta($date)->format('Y/n/j');
    }
}
if (!function_exists('p_date')) {
    function p_date($date)
    {
        return verta($date)->format('%d %B %Y');
    }
}
if (!function_exists('fp_date')) {
    function fp_date($date)
    {
        return verta($date)->format('%d %B %Y H:i');
    }
}
if (!function_exists('f_date')) {
    function f_date($date)
    {
        return verta($date)->format('Y/n/j H:i');
    }
}
if (!function_exists('d_date')) {
    function d_date($date)
    {
        return verta($date)->formatDifference();
    }
}



// obj
if (!function_exists('cart_obj')) {
    function cart_obj($price)
    {
        $total = $price - session()->get('cart.total.discount');

        // affiliate
        $aff_user_id = null;
        if (auth()->check()) {
            $affiliate = \Illuminate\Support\Facades\Cookie::get('subwp-aff');
            if ($affiliate && auth()->user()->affid != $affiliate) {
                $aff_user_id = \App\Models\User::where('affid', $affiliate)->select('id')->first()->id;
            }
        }

        return [
            'total_price' => $total,
            'aff_user_id' => $aff_user_id,
        ];
    }
}


if (!function_exists('affiliate_cookie')) {
    function affiliate_cookie()
    {
        if (request()->has('affid')) {
            $cookie = request()->cookie('subwp-aff');
            if (!$cookie) {
                $affid = \request('affid');
                $user = \App\Models\User::where('affid', $affid)->first();
                if ($user) {
                    Cookie::queue('subwp-aff', $affid, env('AFFILIATE_EXPIRE_MINUTE'));
                }
            }
        }
    }
}
