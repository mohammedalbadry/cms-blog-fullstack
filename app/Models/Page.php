<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
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
        'admin_id'
    ];

    protected $appends = ['image'];

    public function getImagePathAttribute()
    {
        return asset("uploads/pages_images/" . $this->image);
    }


    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
