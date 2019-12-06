<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $primaryKey = 'school_id';
    // protected $fillable = ['kode_prop','propinsi','kode_kab_kota','kabupaten_kota','kode_kec','kecamatan','id','npsn','sekolah','bentuk','status','alamat_jalan','lintang','bujur'];
    protected $fillable = ['name','school_type_id','country_id','address','kelurahan','kecamatan','jenis','kabupaten','propinsi'];

    public function getAddressAttribute()
    {
        return "{$this->kecamatan}" . ", " . "{$this->kabupaten}" . ", " . "{$this->propinsi}";
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','country_id');
    }

    public function schoolType(){
        return $this->belongsTo(SchoolType::class,'school_type_id','school_type_id');
    }
}
