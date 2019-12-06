<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'major_id';
    protected $fillable = ['field_of_study_id','major_name'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function fieldOfStudy(){
        return $this->belongsTo(FieldOfStudy::class,'field_of_study_id','field_of_study_id');
    }
}
