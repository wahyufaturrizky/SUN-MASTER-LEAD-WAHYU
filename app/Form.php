<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $primaryKey = 'form_id';

    public function participantCount(){
        return $this->hasMany(EventRegistration::class,'form_id','form_id');
    }

}
