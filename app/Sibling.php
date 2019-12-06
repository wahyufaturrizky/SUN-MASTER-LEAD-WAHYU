<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'siblings'; //memberitahu table yg ada di database bahwa table adalah 'eventregistration' bukan 'evenregistrations'
    protected $fillable = ['siblingName', 'id_families'];
}
