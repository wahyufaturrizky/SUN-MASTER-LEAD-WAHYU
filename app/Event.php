<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Carbon\Carbon;
class Event extends Model
{
    protected $primaryKey = 'event_id';
    protected $fillable = ['event_name','abbreviation','start','end','marketing_source','location','branch_id'];

    protected static function boot(){
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('start_date', 'desc');
        });
    }

    public function eventType(){
        return $this->belongsTo(EventType::class,'event_type_id','event_type_id');
    }

    public function eventRegistration(){
        return $this->hasMany(EventRegistration::class,'event_id','event_id');
    }

    public function startTime(){
        if(!is_null($this->start_time)){
            return Carbon::createFromFormat('H:i:s', $this->start_time)->format('H:i');
        } else {
            return null;
        }
    }

    public function endTime(){
        if(!is_null($this->end_time)){
            return Carbon::createFromFormat('H:i:s', $this->end_time)->format('H:i');
        } else {
            return null;
        }
    }

    public function arrMarketingSourceIds(){
        if(!is_null($this->marketing_source_ids)){
            $arrs = explode(",", $this->marketing_source_ids);
            $data = '[';
            foreach($arrs as $arr){
                $data .= $arr . ',';
            }

            $data = substr_replace($data ,"", -1);

            $data .= ']';

            return $data;
        } else {
            return '[]';
        }
    }

    public function marketingSources(){
        $marketing_source_ids = explode(",", $this->marketing_source_ids);
        return MarketingSource::orderBy('marketing_source_name','asc')->whereIn('marketing_source_id', $marketing_source_ids)->get();
    }

    public function generateRegId(){
        $eventType = EventType::find($this->event_type_id);
        switch($eventType){
            case 'Workshop':
                $eventTypeCode = 'WO';
                break;

            case 'Seminar':
                $eventTypeCode = 'SM';
                break;

            case 'Info Session':
                $eventTypeCode = 'IS';
                break;

            case 'Sun Eng Event':
                $eventTypeCode = 'SEE';
                break;

            case 'Sun Eng Class':
                $eventTypeCode = 'SEC';
                break;

            case 'Partner Event':
                $eventTypeCode = 'PE';
                break;

            case 'School Expo':
                $eventTypeCode = 'SE';
                break;

            default:
                $eventTypeCode = 'OTH';
                break;
        }

        $branch = Branch::find($this->branch_id);
        $lastNumber = $this->last_number + 1;

        $regId = [
            'number' => $lastNumber,
            'id' => 'MD-' . strtoupper($branch->branch_code) . '-' . strtoupper($this->abbreviation) . str_pad($lastNumber,4, 0, STR_PAD_LEFT)
        ];

        return $regId;
    }

    public function registrations(){
        return $this->hasMany(EventRegistration::class,'event_id','event_id');
    }
}
