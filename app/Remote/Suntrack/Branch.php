<?php

namespace App\Remote\Suntrack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use Webpatser\Uuid\Uuid;

class Branch extends Model
{
    use LogsActivity;
    use SoftDeletes;

    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'mysql_suntrack';
    protected $table = 'branches';
    protected $primaryKey = 'branch_uuid';

    // protected $fillable = ['univ_name','univ_desc','univ_desc_indo','univ_img','univ_rank','univ_tier','univ_score','univ_addr','univ_weather','univ_facility','univ_show','univ_agreementscan2','univ_agreementscan3','univ_agreementscan4','univ_agreementscan5','univ_createdby','univ_createddate','univ_modby','univ_moddate','univ_agreementdate','univ_agreementexpirydate','univ_agreementscan','univ_commisionterms','univ_commisionamount','univ_specialpromo','univ_img1','univ_img2','univ_img3','univ_img4','univ_img5','univ_note'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['*'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->branch_uuid = (string) Uuid::generate(4);
        });
    }
}
