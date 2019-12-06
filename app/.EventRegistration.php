<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'eventregistration'; //memberitahu table yg ada di database bahwa table adalah 'eventregistration' bukan 'evenregistrations'
    protected $fillable = ['studentName', 'form_id', 'educationGrade', 'mobilePhone', 'previousCurrentSchool', 'email','majorInterested', 'dateBirth', 'destinationStudy', 'gender', 'programInterested', 'parentsName', 'planningYear', 'parentsMobilePhone', 'fullAddress', 'postCode', 'homeAddressPhone', 'knowThisEvent', 'office'];


}
