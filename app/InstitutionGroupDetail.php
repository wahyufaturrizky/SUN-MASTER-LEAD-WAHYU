<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionGroupDetail extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'institution_group_detail_id';
    // protected $fillable = ['institution_name','acronym','country_id'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function institution(){
        return $this->belongsTo(Institution::class,'institution_id','institution_id');
    }

}
