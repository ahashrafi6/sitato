<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'family',
        'username',
        'email',
        'type',
        'phone',
        'avatar',
        'notifications',
        'affid',
        'password',
        'phone_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'phone',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'notifications' => 'array'
    ];

    const TYPE = [
        'user' => 'کاربر',
        'admin' => 'مدیر',
    ];


    public function makeUniqueAffid()
    {
        do {
            $affid = rand(pow(10, 7 - 1), pow(10, 7) - 1);
            $found = self::where('affid', $affid)->first();
        } while (!is_null($found));


        $this->update(['affid' => $affid]);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->notifications = default_user_notifications();
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function get_display_name()
    {
            return $this->name . ' ' . $this->family;
    }


    /**
     * @return bool
     */
    public function scopeIsAdmin()
    {
        return $this->type == 'admin';
    }

    public function scopeIsAff()
    {
        return $this->affid != null ? true : false;
    }

    /**
     * @return bool
     */
    public function scopeIsUser()
    {
        return $this->type == 'user';
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany(Session::class , 'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function factors(){
        return $this->hasMany(Factor::class);
    }


    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function scopeFilter($query , $email , $phone , $username , $type)
    {
        if ($email){
            $query->where('email' , 'LIKE' , '%' . $email . '%');
        }
        if ($phone){
            $query->where('phone' , 'LIKE' , '%' . $phone . '%');
        }
        if ($username){
            $query->where('username' , 'LIKE' , '%' . $username . '%');
        }

        if (isset($type) && trim($type) != 'all') {
            $query->where('type', $type);
        }

        return $query;
    }
}
