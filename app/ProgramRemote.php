<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class ProgramRemote extends Model
{
    use LogsActivity;

    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'mysql_web_scn';
    protected $table = 'program_ms';
    protected $primaryKey = 'program_id';

    protected $fillable = ['program_name','univ_id','major_id','major_id2','program_cost','program_costper','levelofstudy_id','program_englishrequirement','program_englishrequirement_indo','program_requirement','program_requirement_indo','program_duration','program_rank_nothing','program_studymode','program_notes','program_notes_indo','program_addfieldtext','program_strength','program_strengthrank','curr_id','program_createdby','program_createddate','program_modby','program_moddate','program_content_viewed'];
    protected static $logAttributes = ['program_id','program_name','univ_id','major_id','major_id2','program_cost','program_costper','levelofstudy_id','program_englishrequirement','program_englishrequirement_indo','program_requirement','program_requirement_indo','program_duration','program_rank_nothing','program_studymode','program_notes','program_notes_indo','program_addfieldtext','program_strength','program_strengthrank','curr_id','program_createdby','program_createddate','program_modby','program_moddate','program_content_viewed'];

    public function major(){
        return $this->belongsTo(MajorRemote::class,'major_id','major_id');
    }

    public function major2(){
        return $this->belongsTo(MajorRemote::class,'major_id2','major_id');
    }
    
    public function los(){
        return $this->belongsTo(LevelOfStudyRemote::class,'levelofstudy_id','levelofstudy_id');
    }

    public function currency(){
        return $this->belongsTo(CurrencyRemote::class,'curr_id','curr_id');
    }

    public function studymode(){
        return $this->belongsTo(ProgramStudyModeMSRemote::class,'program_studymode','studymode_id');
    }

    public function intake(){
        return $this->hasMany(IntakeMSRemote::class,'program_id','program_id');
    }

    public function intakeMonth(){
        return $this->hasManyThrough(
            IntakeRemote::class,
            IntakeMSRemote::class,
            'program_id',
            'intake_id',
            'program_id',
            'intake_id'
        );
    }

    public function university(){
        return $this->belongsTo(UniversityRemote::class,'univ_id','univ_id');
    }
}
