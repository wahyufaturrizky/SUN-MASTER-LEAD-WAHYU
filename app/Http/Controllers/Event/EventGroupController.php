<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EventGroup;
use App\Event;
use App\EventRegistration;
use App\Branch;
use App\Country;
use App\MarketingSource;
use App\Major;
use App\PostalCode;
use App\School;
use App\EventType;

use App\Remote\Sunnies\MHighestEdu;
use App\Remote\Sunnies\MProgramInterested;

use DB;

class EventGroupController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $eventGroups = EventGroup::where('event_group_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $eventGroups = EventGroup::paginate(50);
            $search = '';
        }

        return view('pages.eventgroup.index', compact('eventGroups','search'));
    }

    public function add(){
        $events = Event::all();
        return view('pages.eventgroup.add', compact('events'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'event_group_name' => 'required',
            'event_ids' => 'required|array',
            'event_close' => 'required'
        ]);

        $eventGroup = new EventGroup();
        $eventGroup->fill($req->all());
        $slug = EventGroup::where('slug', str_slug($req->event_group_name, '-'));
        if($slug->count() > 0){
            $slug = str_slug($req->event_group_name, '-') . ($slug->count() + 1);
        } else {
            $slug = str_slug($req->event_group_name, '-');
        }
        $eventGroup->slug = $slug;
        if($eventGroup->save()){
            foreach($req->event_ids as $event_id){
                $event = Event::find($event_id);
                $event->event_group_id = $eventGroup->event_group_id;
                $event->save();
            }
        }

        return redirect(route('indexEventGroup'));
    }

    public function edit($id){
        $eventGroup = EventGroup::find($id);
        $events = Event::all();
        if(!is_null($eventGroup)){
            return view('pages.eventgroup.edit', compact('eventGroup','events'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'event_group_id' => 'required',
            'event_ids' => 'required|array'
        ]);

        $events = Event::all();

        $eventGroup = EventGroup::find($req->event_group_id);
        $eventGroup->fill($req->all());
        if($eventGroup->save()){
            $eventsGroup = Event::where('event_group_id', $eventGroup->event_group_id)->get();
            foreach($eventsGroup as $event){
                $event = Event::find($event->event_id);
                $event->event_group_id = null;
                $event->save();
            }
            foreach($req->event_ids as $event_id){
                $event = Event::find($event_id);
                $event->event_group_id = $eventGroup->event_group_id;
                $event->save();
            }
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.eventgroup.edit', compact('eventGroup', 'saved','events'));
    }

    public function delete($id){
        $eventGroup = EventGroup::find($id);
        $events = Event::all();
        if(!is_null($eventGroup)){
            return view('pages.eventgroup.delete', compact('eventGroup','events'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'event_group_id' => 'required',
        ]);

        $eventGroup = EventGroup::find($req->event_group_id);
        $eventGroup->delete();

        return redirect(route('indexEventGroup'));
    }

    public function registration($event_group_id,$slug,$lang_id){
        $eventGroup = EventGroup::find($event_group_id);
        if($eventGroup->event_close >= date('Y-m-d H:i:s')){
            $branches = Branch::all();
            // $postalCodes = PostalCode::all();
            $countries = Country::where('sun_destination','Yes')->get();
            // $schools = School::all();
            $highestEdus = MHighestEdu::all();
            $programInterested = MProgramInterested::all();
            $marketing_source_ids = DB::table('events')->where('event_group_id', $event_group_id)->select('marketing_source_ids')->get()->pluck('marketing_source_ids');
            $ms_ids = [];
            foreach($marketing_source_ids as $marketing_source_id){
                $ms_ids = array_merge($ms_ids, explode(',', $marketing_source_id));
            }

            $marketingSources = MarketingSource::whereIn('marketing_source_id', $ms_ids)->orderBy('marketing_source_name','asc')->get();

            $majors = Major::with('fieldOfStudy')->get();
            $group = true;
            // return view('pages.eventgroup.registration.en', compact('eventGroup','branches','countries','highestEdus','programInterested','marketingSources','majors','group'));
            return view('pages.event.registration.en2', compact('eventGroup','branches','countries','highestEdus','programInterested','marketingSources','majors','group'));
        } else {
            return view('pages.eventgroup.registration.closed', compact('eventGroup'));
        }
    }

    public function applyEvent(Request $req, $event_group_id){
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
            'event_ids' => 'required',
        ]);

        $eventGroup = EventGroup::find($event_group_id);
        if(!is_null($eventGroup)){
            $register_id = $eventGroup->generateGroupRegId();
            $events = Event::whereIn('event_id', explode(",", $req->event_ids))->get();
            foreach($events as $evnt){
                $event = Event::find($evnt->event_id);
                $regId = $register_id;
                $eventRegistration = new EventRegistration();
                $eventRegistration->event_id = $event->event_id;
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

                $eventRegistration->save();
            }
        }

        return view('pages.eventgroup.registration.en_success', compact('eventGroup','register_id'));

        // if($eventRegistration->save()){
        //     $event->last_number = $regId['number'];
        //     $event->save();

        //     return view('pages.event.registration.en_success', compact('event','eventRegistration'));
        // };
    }

    public function detail($event_group_id){
        $eventGroup = EventGroup::find($event_group_id);
        return view('pages.eventgroup.detail', compact('eventGroup'));
    }

    public function detailRegistration($event_group_id, $event_id, $event_registration_id){
        $lead = EventRegistration::find($event_registration_id);
        $eventTypes = EventType::all();
        return view('pages.eventgroup.registration.detail', compact('lead','eventTypes','event_group_id'));
    }
}
