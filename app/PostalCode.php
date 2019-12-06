<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public $incrementing = true;
    protected $primaryKey = 'postal_code_id';
    protected $fillable = ['postal_code_number','kelurahan','kecamatan','jenis','kabupaten','propinsi'];
}
