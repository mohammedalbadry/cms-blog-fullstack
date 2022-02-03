<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'approval',
        'body',
        'parent_id'
    ];

    public function comment()
    {
        return $this->where('parent_id', 0);
    }

    public function report()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function replay()
    {
        return $this->hasMany('App\Models\Comment','parent_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
}
