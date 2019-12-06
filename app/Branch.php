<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Branch extends Model
{
    // use LogsActivity;
    // use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'branch_id';
    protected $fillable = ['branch_name','branch_code','branch_area'];

    // protected $dates = ['deleted_at'];

    // protected static $logAttributes = ['*'];

    // public function scopeOrdered($query){
    //     return $query->orderBy('branch_area', 'asc')->orderBy('branch_name', 'asc');
    // }

    protected static function boot(){
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('branch_area', 'asc');
            $builder->orderBy('branch_name', 'asc');
        });
    }


    public function getBranchCodeAttribute($value)
    {
        return strtoupper($value);
    }

}
