<?php


namespace App\Classes;


use Illuminate\Support\Facades\Http;

class Farazsms
{

    public static function send($phone, $data, $pattern)
    {
        $url = "https://ippanel.com/patterns/pattern?username=". '09114121131'
            . '&password=' . urldecode('09380906415*1376*Ah')
            . '&from=' . '5000125475'
            . '&to=' . $phone
            . '&input_data=' . urlencode(json_encode($data))
            . '&pattern_code=' . $pattern;
        $response = Http::post($url, $data);

        return $response;
    }

}
