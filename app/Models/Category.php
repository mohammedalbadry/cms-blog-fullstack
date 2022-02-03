<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id'
    ];


    public function parent()
    {
        return $this->where('parent_id', 0);
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category','parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_category');
    }

    public function homechildren()
    {
       // return $this->withCount('posts');
    }

}
