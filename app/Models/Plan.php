<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    const STATUS = [
        'draft' => 'پیش نویس',
        'coming' => 'بزودی',
        'published' => 'منتشر شده',
        'stop' => 'توقف فروش',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isOff()
    {
        $now = now();
        return $this->isOff &&
            $this->start_at < $now->toDateTimeString() &&
            $this->expire_at > $now->toDateTimeString() &&
            ($this->capacity ? ($this->capacity > $this->consumed ? true : false) : true);
    }

    public function scopeSpecial($query)
    {
        return $query->where('isSpecial', true);
    }

    public function scopeFilter($query, $status)
    {
        if (isset($status) && trim($status) != 'all') {
            $query->where('status', $status);
        }

        return $query;
    }
    
}
