<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'payment_at' => 'datetime',
        'bank_card' => 'array'
    ];

    const CATE = [
        'income' => 'درآمد',
        'affiliate' => 'همکاری در فروش',
    ];

    const TYPE = [
        'sheba' => 'شبا',
    ];

    const STATUS = [
        'pending' => 'در انتظار',
        'completed' => 'انجام شده',
        'failed' => 'رد شده'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query , $cate , $status)
    {
        if (isset($cate) && trim($cate) != 'all') {
            $query->where('cate', $cate);
        }

        if (isset($status) && trim($status) != 'all') {
            $query->where('status', $status);
        }

        return $query;
    }
}
