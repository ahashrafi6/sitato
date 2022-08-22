<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    const UPDATED_AT = null;

    protected $guarded = [];

    public static function GenerateCode($phone)
    {
        $code = self::makeUniqueCode($phone);
        return self::create(['phone' => $phone, 'code' => $code]);
    }

    private static function makeUniqueCode($phone)
    {
        do {
            $code = rand(1234 , 9999);
            $found = self::where(['phone' => $phone, 'code' => $code])->first();
        } while (!is_null($found));
        return $code;
    }
}
