<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $primaryKey = 'event_registration_id';

    public function eventType(){
        return $this->belongsTo(EventType::class,'event_type_id','event_type_id');
    }

    public function isDuplicate(){
        $count = EventRegistration::where('email', $this->email)->where('birth', $this->birth)->count();
        if($count > 1){
            return true;
        } else {
            return false;
        }

    }
}
