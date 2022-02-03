<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewsCounters extends Model
{
    protected $fillable = [
        'post_id',
        'view_name',
        'views',
        'created_at'
    ];
}
