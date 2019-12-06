<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionContact extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'institution_contact_id';
    protected $fillable = ['type','name','position','address','phone','email'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function reference(){
        if($this->type == 'Institution'){
            $institution = Institution::find($this->reference_id);
            if(!is_null($institution)){
                return $institution->institution_name;
            } else {
                return null;
            }
        } else if($this->type == 'Group'){
            $institutionGroup = InstitutionGroup::find($this->reference_id);
            if(!is_null($institutionGroup)){
                return $institutionGroup->institution_group_name;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
