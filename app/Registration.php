<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'registration_id';
    protected $fillable = ['registration_type','full_name','mobile','birth','gender','parents_name','parents_mobile','address','zip_code','phone','highest_edu_id','highest_edu','precur_school_id','precur_school','major_interested_id','major_interested','destination_of_study_id','destination_of_study','program_interested_id','program_interested','marketing_source_id','marketing_source','planning_year','has_contact_sun'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','branch_id');
    }
}
