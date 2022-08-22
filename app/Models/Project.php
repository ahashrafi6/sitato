<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'support_at' => 'datetime',
        'payment_at' => 'datetime',
    ];


    /**
     *
     */
    const STATUS = [
        'username' => 'در انتظار شناسه',
        'install' => 'در حال نصب',
        'active' => 'فعال',
        'disable' => 'خاموش',
        'freeze' => 'منجمد',
        'delete' => 'حذف شده'
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }


    public function url(){
        return 'http://' . $this->username . '.iran.liara.run';
    }

    public function Plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function Server()
    {
        return $this->belongsTo(Server::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
