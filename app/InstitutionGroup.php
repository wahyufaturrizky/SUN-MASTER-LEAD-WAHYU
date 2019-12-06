<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstitutionGroup extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'institution_group_id';
    // protected $fillable = ['institution_name','acronym','country_id'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function arrInstitutionIds(){
        $institutions = $this->hasMany(InstitutionGroupDetail::class,'institution_group_id','institution_group_id')->pluck('institution_id')->toArray();
        return '[' . implode($institutions, ',') . ']';
    }

    public function insitutions(){
        return $this->hasManyThrough(
            InstitutionGroupDetail::class, // country
            Institution::class, // users
            'institution_id', // Foreign key on users table...
            'institution_group_id', // Foreign key on posts table...
            'institution_group_id', // Local key on countries table...
            'institution_id' // Local key on users table...
        );
    }

}
