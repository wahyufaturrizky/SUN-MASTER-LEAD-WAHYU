<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_code','country_name','sun_destination'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];
}
