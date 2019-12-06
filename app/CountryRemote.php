<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryRemote extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'mysql_web_scn';
    protected $table = 'country';
    protected $primaryKey = 'country_id';
}
