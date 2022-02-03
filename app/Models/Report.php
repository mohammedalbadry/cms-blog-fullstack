<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'comment_id',
        'user_id',
        'status',
        'reason',
        'result'
    ];


    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}
