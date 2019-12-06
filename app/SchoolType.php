<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolType extends Model
{
    protected $primaryKey = 'school_type_id';
    // protected $fillable = ['kode_prop','propinsi','kode_kab_kota','kabupaten_kota','kode_kec','kecamatan','id','npsn','sekolah','bentuk','status','alamat_jalan','lintang','bujur'];
    protected $fillable = ['name'];

}
