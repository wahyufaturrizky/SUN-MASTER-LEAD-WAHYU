<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MarketingSourceRemote extends Model
{
    use LogsActivity;
    
    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'mysql_sunnies';
    protected $table = 'm_marketing_source';
    protected $primaryKey = 'marketing_source_id';

    // protected $fillable = ['program_name','univ_id','major_id','major_id2','program_cost','program_costper','levelofstudy_id','program_englishrequirement','program_englishrequirement_indo','program_requirement','program_requirement_indo','program_duration','program_rank_nothing','program_studymode','program_notes','program_notes_indo','program_addfieldtext','program_strength','program_strengthrank','curr_id','program_createdby','program_createddate','program_modby','program_moddate','program_content_viewed'];

    public function fos(){
        return $this->belongsTo(FieldOfStudyRemote::class,'fos_id','fos_id');
    }
}
