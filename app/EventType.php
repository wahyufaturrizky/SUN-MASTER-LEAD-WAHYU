<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Event;

class EventType extends Model
{
    protected $primaryKey = 'event_type_id';
    protected $fillable = ['event_type_name','slug'];

    public function event(){
        return $this->hasMany(Event::class,'event_type_id','event_type_id');
    }
    
    public function eventRegistration(){
        return $this->hasMany(EventRegistration::class,'event_type_id','event_type_id');
    }
}
