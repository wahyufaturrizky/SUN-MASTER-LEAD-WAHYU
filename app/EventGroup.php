<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventGroup extends Model
{
    protected $primaryKey = 'event_group_id';
    protected $fillable = ['event_group_name','event_close'];

    public function events(){
        return $this->hasMany(Event::class,'event_group_id','event_group_id');
    }

    public function arrEvent(){
        $event_ids = $this->hasMany(Event::class,'event_group_id','event_group_id')->get()->pluck('event_id')->toArray();
        if(!is_null($event_ids) && !empty($event_ids)){
            $data = '[';
            foreach($event_ids as $event_id){
                $data .= $event_id . ',';
            }

            $data = substr_replace($data ,"", -1);

            $data .= ']';

            return $data;
        } else {
            return '[]';
        }
    }

    public function generateGroupRegId(){
        $branch = Branch::find($this->branch_id);
        $lastNumber = date('ymd-His');

        $regId = [
            'number' => $lastNumber,
            'id' => 'MD-GR-' . $lastNumber
        ];

        return $regId;
    }
}
