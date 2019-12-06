<?php

namespace App\Remote\Sunnies;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SyswebRole extends Model
{
    use LogsActivity;

    public $incrementing = true;
    public $timestamps = false;

    protected $connection = 'mysql_sunnies';
    protected $table = 'sysweb_roles';
    protected $primaryKey = 'role_id';

    // protected $fillable = ['univ_name','univ_desc','univ_desc_indo','univ_img','univ_rank','univ_tier','univ_score','univ_addr','univ_weather','univ_facility','univ_show','univ_agreementscan2','univ_agreementscan3','univ_agreementscan4','univ_agreementscan5','univ_createdby','univ_createddate','univ_modby','univ_moddate','univ_agreementdate','univ_agreementexpirydate','univ_agreementscan','univ_commisionterms','univ_commisionamount','univ_specialpromo','univ_img1','univ_img2','univ_img3','univ_img4','univ_img5','univ_note'];
    protected static $logAttributes = ['*'];

    public function users(){
        return $this->hasManyThrough(
            SyswebUser::class,
            SyswebRole::class,
            'user_ids', // Foreign key on users table...
            'user_id', // Foreign key on posts table...
            'user_id', // Local key on countries table...
            'user_id' // Local key on users table...
        );
    }
}
