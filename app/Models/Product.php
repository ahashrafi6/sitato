<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable , SoftDeletes;

    protected $guarded = [];

    const STATUS = [
        'draft' => 'پیش نویس',
        'coming' => 'بزودی',
        'published' => 'منتشر شده',
        'stop' => 'توقف فروش',
    ];


    /**
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'en_title'
            ]
        ];
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function plans(){
        return $this->hasMany(Plan::class);
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
