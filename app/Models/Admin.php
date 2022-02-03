<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
    protected $guard = 'admin';

    
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset("uploads/admins_images/" . $this->image);
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function pages()
    {
        return $this->hasMany('App\Models\Page');
    }
}
