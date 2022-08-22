<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'paid_at' => 'datetime',
        'expire_at' => 'datetime',
        'items' => 'array',
        'discount' => 'array'
    ];


    /**
     *
     */
    const TYPE = [
        'factor' => 'فاکتور',
        'wallet' => 'افزایش اعتبار حساب',
        'support' => 'تمدید پشتیبانی',
        'plan' => 'ارتقا پلن',
        'server' => 'تمدید یا ارتقا سرور',
        'renew' => 'راه اندازی مجدد',
    ];

    /**
     *
     */
    const TERMINAL = [
        'zarin' => 'زرین پال',
        'wallet' => 'اعتبار حساب'
    ];


    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'resNumber';
    }

    /**
     * @return string
     */
    public function path()
    {
        return "/invoices/$this->resNumber";
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return bool
     */
    public function isExpire()
    {
        return $this->expire_at > now() ? false : true;
    }

    /**
     * Observe pattern to set tracking code.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->resNumber = self::makeUniqueTracking();
        });
    }

    /**
     * @return int
     */
    private static function makeUniqueTracking()
    {
        do {
            $resNumber = rand(pow(10, 6 - 1), pow(10, 6) - 1);
            $found = self::where('resNumber', $resNumber)->first();
        } while (!is_null($found));
        return $resNumber;
    }

}
