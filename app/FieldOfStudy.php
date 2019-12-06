<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldOfStudy extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'field_of_study_id';
    protected $fillable = ['field_of_study_name'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];
    
    public function majors(){
        return $this->hasMany(Major::class,'field_of_study_id','field_of_study_id');
    }
}
