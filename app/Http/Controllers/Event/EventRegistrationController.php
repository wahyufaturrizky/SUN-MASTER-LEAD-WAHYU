<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Event;
use App\EventType;
use App\Branch;
use App\EventRegistration;

class EventRegistrationController extends Controller
{
    public function index(Request $req, $slug, $event_id){
        $registrations = EventRegistration::join('events','events.event_id', 'event_registrations.event_id')->where('event_registrations.event_id', $event_id);

        $search = '';
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search)){
                $search = $req->search;
                $searchs = explode(' ', $req->search);
                $registrations->where(function($query) use($searchs){
                    foreach($searchs as $s){
                        $query->where('event_registrations.full_name','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.full_name','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.mobile','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.email','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.birth','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.gender','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.parents_name','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.parents_mobile','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.address','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.zip_code','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.kelurahan','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.kecamatan','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.dt2','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.kabupaten','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.propinsi','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.phone','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.highest_edu_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.highest_edu','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.precur_school_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.precur_school','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.major_interested_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.major_interested','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.destination_of_study_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.destination_of_study','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.program_interested_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.program_interested','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.planning_year','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.marketing_source_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.marketing_source','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.has_contact_sun','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.branch_id','LIKE','%' . $s . '%');
                        $query->orWhere('event_registrations.branch_name','LIKE','%' . $s . '%');
                    }
                });
            }
        } else {
            $search = '';
        }

        $registrations = $registrations->paginate(100);
        $event = Event::find($event_id);
        $eventTypes = EventType::all();
        return view('pages.event.registration.index', compact('event','registrations','eventTypes','search'));
    }

    public function detail($slug, $event_id, $event_registration_id){
        $lead = EventRegistration::find($event_registration_id);
        $eventTypes = EventType::all();
        return view('pages.event.registration.detail', compact('lead','eventTypes'));
    }
}
