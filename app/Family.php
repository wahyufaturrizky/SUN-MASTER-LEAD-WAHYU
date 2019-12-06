<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $primaryKey = 'id_families';
    protected $table = 'families'; //memberitahu table yg ada di database bahwa table adalah 'eventregistration' bukan 'evenregistrations'
    protected $fillable = ['familyCard_id', 'familyName', 'email', 'familyMobilePhone', 'homeAddressPhone', 'fatherName', 'dobf', 'motherName', 'dobm', 'postCode', 'address'];
}
