<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'institution_id';
    protected $fillable = ['institution_name','acronym','country_id','is_partnership'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function country(){
        return $this->belongsTo(Country::class,'country_id','country_code');
    }
}
