<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    // use LogsActivity;
    // use SoftDeletes;

    // public $incrementing = false;
    protected $primaryKey = 'email_verification_id';
    protected $fillable = ['email'];

    // protected $dates = ['deleted_at'];

    // protected static $logAttributes = ['*'];
}
