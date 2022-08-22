<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];

    protected $casts = [
        'products' => 'array',
        'users' => 'array',
    ];

    const TYPE = [
        'cash' => 'تخفیف سبد خرید',
        'subscribe' => 'تخفیف اشتراک'
    ];
}
