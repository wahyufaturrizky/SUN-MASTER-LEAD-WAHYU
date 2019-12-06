<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lead extends Model
{
    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->leads_uuid = (string) Str::uuid();
        });
    }
}
