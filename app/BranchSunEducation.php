<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchSunEducation extends Model
{
    use LogsActivity;
    use SoftDeletes;

    public $incrementing = true;
    protected $primaryKey = 'branch_sun_education_id';
    // protected $fillable = ['email'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function arrBranchCoverage(){
        if(!is_null($this->branch_coverage)){
            $arrs = explode(",", $this->branch_coverage);
            $data = '';
            foreach($arrs as $arr){
                $data .= $arr . ',';
            }

            $data = substr_replace($data ,"", -1);

            // $data .= ']';

            return $data;
        } else {
            return '[]';
        }
    }
}
