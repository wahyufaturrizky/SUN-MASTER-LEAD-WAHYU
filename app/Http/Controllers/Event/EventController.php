<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Event;
use App\EventCategory;
use App\EventType;
use App\EventRegistration;
use App\Branch;
use App\PostalCode;
use App\School;
use App\Location;
use App\Major;
use App\MarketingSource;
use App\Country;

// Sunnies
use App\Remote\Sunnies\MBranch;
use App\Remote\Sunnies\MInstitution;
use App\Remote\Sunnies\MProgramInterested;
use App\Remote\Sunnies\MClassification;
use App\Remote\Sunnies\MStudySector;
use App\Remote\Sunnies\MDestinationOfStudy;
use App\Remote\Sunnies\MMarketingSource;
use App\Remote\Sunnies\MHighestEdu;

use Carbon\Carbon;

class EventController extends Controller
{
    public function index(){
        $events = Event::paginate(100);
        $eventTypes = EventType::all();
        $locations = Location::all();
        $branches = Branch::all();
        $type = '';
        return view('pages.event.index', compact('events','eventTypes','branches', 'locations', 'type'));
    }

    public function getByType(Request $req, $type = 'all', $search = null)
    {
        $events = Event::join('event_types','event_types.event_type_id','events.event_type_id');
        $eventType = EventType::where('slug', $type)->first();

        if(is_null($eventType)){
            $event_type_name = 'All Event';
        } else {
            $event_type_name = $eventType->event_type_name;
            $events = $events->where('events.event_type_id', $eventType->event_type_id);
        }

        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search)){
                $search = $req->search;
                $searchs = explode(' ', $req->search);
                $events->where(function($query) use($searchs){
                    foreach($searchs as $s){
                        $query->where('event_name','LIKE','%' . $s . '%');
                    }
                });
            }
        } else {
            $search = '';
        }

        $events = $events->paginate(100);

        $eventTypes = EventType::all();
        $locations = Location::all();
        $branches = Branch::all();
        $type = '';

        return view('pages.event.index', compact('search','events','event_type_name','eventTypes','branches', 'locations', 'type'));
    }

    public function add(){
        $eventTypes = EventType::all();
        $branches = Branch::all();
        $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->get();

        return view('pages.event.add', compact('eventTypes','branches','marketingSources'));
    }


    public function postAdd(Request $req){
        $req->validate([
            'event_name' => 'required',
            'event_type_id' => 'required',
            'abbreviation' => 'required | max:3',
            'start_date' => 'required',
            // 'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'branch_id' => 'required',
            // 'slug' => 'required',

            // 'event_name' => "asdas"
            // 'event_type_id' => "2"
            // 'abbreviation' => "asa"
            // 'start_date' => "2019-09-24"
            // 'end_date' => null
            // 'start_time' => "12:12"
            // 'end_time' => "12:12"
            // 'location' => "qww"
            // 'branch_id' => "18"
            // 'slug' => null
        ]);

        $event = new Event();
        $event->event_name = $req->event_name;
        $event->event_type_id = $req->event_type_id;
        $event->abbreviation = $req->abbreviation;
        $event->start_date = $req->start_date;
        $event->end_date = $req->end_date;
        $event->start_time =  Carbon::createFromFormat('H:i', $req->start_time)->format('H:i:s');
        $event->end_time = Carbon::createFromFormat('H:i', $req->end_time)->format('H:i:s');
        $event->location = $req->location;
        $event->branch_id = $req->branch_id;
        if(is_null($req->is_open)){
            $event->is_open = true;
        } else {
            $event->is_open = $req->is_open;
        }
        $event->slug = str_slug($req->event_name, '-');

        if($req->has('marketing_source_ids')){
            if(!is_null($req->marketing_source_ids) && !empty($req->marketing_source_ids) && is_array($req->marketing_source_ids)){
                $event->marketing_source_ids = implode($req->marketing_source_ids, ',');
            }
        }

        if($req->has('event_close')){
            if(!is_null($req->event_close) && !empty($req->event_close)){
                $event->event_close = Carbon::createFromFormat('Y-m-d H:i', $req->event_close)->format('Y-m-d H:i:s');
            }
        }

        if($event->save()){
            $eventType = EventType::find($event->event_type_id);
            return redirect(route('getDataByTypeEvents', ['slug' => $eventType->slug]));
        }
    }

    public function edit($id){
        $event = Event::find($id);
        $eventTypes = EventType::all();
        $branches = Branch::all();
        $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->get();
        if(!is_null($event)){
            return view('pages.event.edit', compact('event','eventTypes','branches','marketingSources'));
        }
    }

    public function update(Request $req, $id){
        $req->validate([
            'event_name' => 'required',
            'event_type_id' => 'required',
            // 'date' => 'required',
            // 'slug' => 'required',
        ]);

        $eventTypes = EventType::all();
        $branches = Branch::all();
        $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->get();

        $event = Event::find($id);
        $event->event_name = $req->event_name;
        $event->event_type_id = $req->event_type_id;
        $event->abbreviation = $req->abbreviation;
        $event->start_date = $req->start_date;
        $event->end_date = $req->end_date;
        $event->start_time = Carbon::createFromFormat('H:i', $req->start_time)->format('H:i:s');
        $event->end_time = Carbon::createFromFormat('H:i', $req->end_time)->format('H:i:s');
        $event->location = $req->location;
        $event->branch_id = $req->branch_id;

        if(is_null($req->is_open)){
            $event->is_open = true;
        } else {
            $event->is_open = $req->is_open;
        }

        if($req->has('marketing_source_ids')){
            if(!is_null($req->marketing_source_ids) && !empty($req->marketing_source_ids) && is_array($req->marketing_source_ids)){
                $event->marketing_source_ids = implode($req->marketing_source_ids, ',');
            }
        }

        if($req->has('event_close')){
            if(!is_null($req->event_close) && !empty($req->event_close)){
                $event->event_close = $req->event_close;
            }
        }

        if($event->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.event.edit', compact('event','eventTypes','branches','marketingSources','saved'));
    }

    public function delete($id){
        $event = Event::find($id);
        $eventTypes = EventType::all();
        $branches = Branch::all();
        $marketingSources = MarketingSource::orderBy('marketing_source_name','asc')->get();
        if(!is_null($event)){
            return view('pages.event.delete', compact('event','eventTypes','branches','marketingSources'));
        }
    }

    public function confirmDelete($event_id){
        $event = Event::find($event_id);
        $event->delete($event);

        return redirect(route('getDataByTypeEvents'));
    }

    public function linkEventId($event_id){
        $event_id = Event::where('event_id', $event_id)->get();
        return view('pages.eventregistration.index', compact('event_id'));
    }

    public function registration($event_id,$slug,$lang_id){
        $event = Event::find($event_id);
        if($event->event_close >= date('Y-m-d H:i:s')){
            $branches = Branch::all();
            // $postalCodes = PostalCode::all();
            $countries = Country::where('sun_destination','Yes')->get();
            // $schools = School::all();
            $highestEdus = MHighestEdu::all();
            $programInterested = MProgramInterested::all();
            $marketingSources = MarketingSource::whereIn('marketing_source_id', explode(',', $event->marketing_source_ids))->orderBy('marketing_source_name','asc')->get();
            $majors = Major::with('fieldOfStudy')->get();

            return view('pages.event.registration.en2', compact('event','branches','countries','highestEdus','programInterested','marketingSources','majors'));
        } else {
            return view('pages.event.registration.closed', compact('event'));
        }
    }

    public function applyEvent(Request $req, $event_id){
        $req->validate([
            'full_name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'birth' => 'required',
            'gender' => 'required',
            'parents_name' => 'required',
            'parents_mobile' => 'required',
            'address' => 'required',
            'postal_code_id' => 'required',
            // 'phone' => 'required',
            'highest_edu_id' => 'required',
            'school_id' => 'required',
            'major_interested' => 'required',
            'destination_of_study_id' => 'required',
            'program_interested_id' => 'required',
            'planning_year' => 'required',
            'marketing_source_id' => 'required',
            'has_contact_sun' => 'required',
            // 'branch_id' => 'required',
            // 'event_ids' => 'required',
        ]);

        $event = Event::find($event_id);
        $regId = $event->generateRegId();
        $eventRegistration = new EventRegistration();
        $eventRegistration->event_id = $req->event_id;
        $eventRegistration->event_type_id = $event->event_type_id;
        $eventRegistration->register_id = $regId['id'];
        $eventRegistration->full_name = $req->full_name;
        $eventRegistration->mobile = $req->mobile;
        $eventRegistration->email = $req->email;
        $eventRegistration->birth = $req->birth;
        $eventRegistration->gender = $req->gender;
        $eventRegistration->parents_name = $req->parents_name;
        $eventRegistration->parents_mobile = $req->parents_mobile;
        $eventRegistration->address = $req->address;

        $postalCode = PostalCode::find($req->postal_code_id);
        $eventRegistration->zip_code = $postalCode->postal_code_number;
        $eventRegistration->kelurahan = $postalCode->kelurahan;
        $eventRegistration->kecamatan = $postalCode->kecamatan;
        $eventRegistration->dt2 = $postalCode->jenis;
        $eventRegistration->kabupaten = $postalCode->kabupaten;
        $eventRegistration->propinsi = $postalCode->propinsi;
        $eventRegistration->phone = $req->phone;

        $highestEdu = MHighestEdu::find($req->highest_edu_id);
        $eventRegistration->highest_edu_id = $highestEdu->highest_edu_id;
        $eventRegistration->highest_edu = $highestEdu->highest_edu;

        $school = School::find($req->school_id);
        $eventRegistration->precur_school_id = $school->school_id;
        $eventRegistration->precur_school = $school->name;

        $eventRegistration->major_interested_id = 0;
        $eventRegistration->major_interested = $req->major_interested;

        $country = Country::find($req->destination_of_study_id);
        $eventRegistration->destination_of_study_id = $country->country_id;
        $eventRegistration->destination_of_study = $country->country_name;

        $programInterested = MProgramInterested::find($req->program_interested_id);
        $eventRegistration->program_interested_id = $programInterested->program_interested_id;
        $eventRegistration->program_interested = $programInterested->program_interested;

        $eventRegistration->planning_year = $req->planning_year;

        $marketingSource = MarketingSource::find($req->marketing_source_id);
        $eventRegistration->marketing_source_id = $marketingSource->marketing_source_id;
        $eventRegistration->marketing_source = $marketingSource->marketing_source_name;

        $eventRegistration->has_contact_sun = $req->has_contact_sun;

        if($req->has('branch_id')){
            if(!is_null($req->branch_id) && empty($req->branch_id)){
                $branch = Branch::find($req->branch_id);
                $eventRegistration->branch_id = $branch->branch_id;
                $eventRegistration->branch_name = $branch->branch_name;
            }
        }

        if($eventRegistration->save()){
            $event->last_number = $regId['number'];
            $event->save();

            return view('pages.event.registration.en_success', compact('event','eventRegistration'));
        };
    }
}
