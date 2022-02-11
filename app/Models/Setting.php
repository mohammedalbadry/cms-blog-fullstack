<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'icon',
        'description',
        'status',
        'alt_text',
    ];

    protected $appends = ['logo_path','icon_path'];

    public function getLogoPathAttribute()
    {
        return url("uploads/settings/" . $this->logo);
    }
    public function getIconPathAttribute()
    {
        return url("uploads/settings/" . $this->icon);
    }

}
