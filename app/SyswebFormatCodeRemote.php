<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyswebFormatCodeRemote extends Model
{
    // use Cachable;
    // use LogsActivity;

    public $incrementing = false;
    public $timestamps = false;

    protected $connection = 'mysql_sunnies';
    protected $table = 'sysweb_format_code';
    protected $primaryKey = 'format_name';

    // protected $fillable = [''];
    protected static $logAttributes = ['*'];

}
