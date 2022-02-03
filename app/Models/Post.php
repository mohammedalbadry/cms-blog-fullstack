<?php

namespace App\models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'image',
        'body',
        'excerpt',
        'publish',
        'visibility',
        'comments',
        'views',
        'admin_id'
    ];

    protected $appends = ['image'];

    public function getImagePathAttribute()
    {
        return asset("uploads/admins_image/" . $this->image);
    }

    
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'post_category');
    }

    public function postcomments()
    {
        return $this->hasMany('App\Models\Comment')->where('parent_id', 0);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }

}
