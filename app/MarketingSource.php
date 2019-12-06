<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketingSource extends Model
{
    use LogsActivity;
    use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'marketing_source_id';
    protected $fillable = ['marketing_source_name','parent_id'];

    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['*'];

    public function arrRegisterType(){
        if(!is_null($this->register_type)){
            // dd('ss');
            $arrs = explode(",", $this->register_type);
            $data = '[';
            foreach($arrs as $arr){
                $data .= '"' . $arr . '",';
            }
            // $data = substr_replace($data ,"", -1);
            $data .= ']';
            return $data;
        } else {
            return [];
        }
    }
}
