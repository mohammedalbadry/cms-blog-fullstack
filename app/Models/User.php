<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'image', 'banned_status', 'provider_id',
        'provider', 'access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        if(str_contains($this->image , "https://graph.facebook.com") ||  str_contains($this->image , "googleusercontent.com")){
            return  $this->image;
        } else {
            return asset("uploads/users_images/" . $this->image);
        }
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function report()
    {
        return $this->hasMany('App\Models\Report');
    }
}
