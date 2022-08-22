<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    protected $casts = [
        'files' => 'array',
    ];

    const DEPARTMENT = [
        'product' => 'پشتیبانی محصول',
        'subwp' => 'ارتباط با سایتاتو',
        'admin' => 'مدیریت',
    ];

    const TYPE = [
        'product-help' => [
            'department' => 'product',
            'title' => 'راهنمایی در مورد برنامه',
            'product' => true
        ],
        'product-install' => [
            'department' => 'product',
            'title' => 'نصب و راه اندازی برنامه',
            'product' => true
        ],
        'product-customize' => [
            'department' => 'product',
            'title' => 'سفارشی سازی برنامه',
            'product' => true
        ],
        'product-update' => [
            'department' => 'product',
            'title' => 'درخواست بروزرسانی برنامه',
            'product' => true
        ],
  /*       'product-domain' => [
            'department' => 'product',
            'title' => 'لایسنس و تغییر دامنه',
            'product' => false
        ], */

        'subwp-buy' => [
            'department' => 'subwp',
            'title' => 'مشاوره خرید برنامه',
            'product' => false
        ],
        'subwp-download' => [
            'department' => 'subwp',
            'title' => 'گزارش مشکل در فرآیند خرید',
            'product' => true
        ],
  /*       'subwp-author' => [
            'department' => 'subwp',
            'title' => 'گزارش مشکل در پشتیبانی فروشنده',
            'product' => true
        ], */
        'subwp-back' => [
            'department' => 'subwp',
            'title' => 'درخواست استرداد برنامه',
            'product' => true
        ],
      /*   'subwp-ownership' => [
            'department' => 'subwp',
            'title' => 'گزارش مالکیت محصول',
            'product' => true
        ], */
        'subwp-other' => [
            'department' => 'subwp',
            'title' => 'سایر موارد',
            'product' => false
        ],

        /* 'author-income' => [
            'department' => 'author',
            'title' => 'گزارش مشکل مالی',
            'product' => false
        ],
        'author-account' => [
            'department' => 'author',
            'title' => 'پیگیری تایید حساب کاربری',
            'product' => false
        ],
        'author-product' => [
            'department' => 'author',
            'title' => 'درخواست مرتبط با محصول',
            'product' => true
        ],
        'author-other' => [
            'department' => 'author',
            'title' => 'سایر امور فروشندگان',
            'product' => false,
        ], */

        'admin-ticket' => [
            'department' => 'admin',
            'title' => 'از طرف مدیریت',
            'product' => false,
        ],
    ];

    const STATUS = [
        'waiting' => 'منتظر پاسخ',
        'pending' => 'در حال رسیدگی',
        'answer' => 'پاسخ داده شده',
        'close' => 'بسته شده',
        'admin' => 'از طرف مدیریت',
       // 'product-install' => 'نصب محصول',
    ];

    public function getRouteKeyName()
    {
        return 'tracking';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->tracking = self::makeUniqueTracking();
        });
    }

    private static function makeUniqueTracking()
    {
        do {
            $tracking = rand(pow(10, 7 - 1), pow(10, 7) - 1);
            $found = self::where('tracking', $tracking)->first();
        } while (!is_null($found));
        return $tracking;
    }

    public function path()
    {
        return route('ticket' , ['ticket' => $this->tracking]);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeCustomers($query , $products)
    {
        return $query->whereIn('product_id' , $products);
    }

    public function scopeFilter($query , $tracking , $status, $product , $department , $type)
    {
        if ($tracking){
            $query->where('tracking', $tracking);
        }
        if (isset($status) && trim($status) != 'all'){
            $query->where('status', $status);
        }
        if (isset($product) && trim($product) != 'all'){
            $query->where('project_id', $product);
        }
        if (isset($department) && trim($department) != 'all'){
            $query->where('department', $department);
        }
        if (isset($type) && trim($type) != 'all'){
            $query->where('type', $type);
        }

        return $query;
    }
}
