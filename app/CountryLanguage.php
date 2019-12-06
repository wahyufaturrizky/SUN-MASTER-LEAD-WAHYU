<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryLanguage extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'country_language_id';
    protected $fillable = ['country_id','country_language_name'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];
}
