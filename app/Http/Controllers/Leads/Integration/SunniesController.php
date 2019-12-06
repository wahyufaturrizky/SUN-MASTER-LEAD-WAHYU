<?php

namespace App\Http\Controllers\Leads\Integration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Sunmobile
use App\Remote\Sunmobile\User as SunmobileUser;

use App\Remote\Sunmobile\ApplyEvent as SunmobileApplyEvent;
use App\Http\Resources\Integration\Sunnies\SunmobileApplyEventResource;
use App\Http\Resources\Integration\Sunnies\SunmobileApplyEventCollection;

use App\Remote\Sunmobile\Apply as SunmobileApplyProgram;
use App\Http\Resources\Integration\Sunnies\SunmobileApplyProgramResource;
use App\Http\Resources\Integration\Sunnies\SunmobileApplyProgramCollection;

// Suntrack
use App\Remote\Suntrack\PostalCode as SuntrackPostalCode;
use App\Remote\Suntrack\Branch as SuntrackBranch;
use App\Remote\Suntrack\Lead as SuntrackLead;
use App\Http\Resources\Integration\Sunnies\SuntrackResource;
use App\Http\Resources\Integration\Sunnies\SuntrackCollection;

// Sunnies
use App\RStudentRemote;
use App\FStudentRemote;
use App\SyswebFormatCodeRemote;

// Self
use App\Registration;
use App\Form;
use App\EventRegistration;
use App\EventType;
use App\Remote\Sunnies\MBranch as SunniesBranch;
use App\Lead as MasterDataLead;
use App\LeadHistory as MasterDataLeadHistory;
use App\Branch as MasterDataBranch;
use DB;
use App\Http\Resources\Integration\Sunnies\SunEduWebCollection;
use App\Http\Resources\Integration\Sunnies\SunEduWebResource;
use App\Http\Resources\Integration\Sunnies\SunEngWebCollection;
use App\Http\Resources\Integration\Sunnies\SunEngWebResource;
use App\Http\Resources\Integration\Sunnies\MasterDataEventRegistrationCollection;
use App\Http\Resources\Integration\Sunnies\MasterDataEventRegistrationResource;

class SunniesController extends Controller
{
    public function getSunniesBranchCode($branch_code){
        $branches = [
            // SUNTRACK => SUNNIES
            'LAM' => 'LMPG',            //	Lampung
            'AS' => 'ALSUT',            //	Alam Sutera
            'KGB' => 'KG',              //	Kelapa Gading Barat
            'TD' => 'TD',               //	Tanjung Duren
            'SMG' => 'SMR',             //	Semarang
            'PI' => 'PI',               //	Pondok Indah
            'BDG' => 'BDG',             //	Bandung
            'SBB' => 'SRB',             //	Surabaya Barat
            'BL' => 'BALI',             //	Bali
            'MKS' => 'MKS',             //	Makassar
            'STC' => 'STC',             //	Senayan Trade Center
            'PKU' => 'PKB',             //	Pekanbaru
            'KGT' => 'KG',              //	Kelapa Gading Timur
            'KJ' => 'KJ',               //	Kebon Jeruk
            'SBT' => 'SBYTM',           //	Surabaya Timur
            'PL' => 'PLUIT',            //	Pluit
            'GS' => 'GS',               //	Gading Serpong
            'BTM' => 'BTM',             //	Batam
            // 'CBR' => 'XXX',          //	Cibubur
        ];

        if(array_key_exists($branch_code, $branches)){
            return $branches[$branch_code];
        } else {
            return '';
        }
    }

    public function getCount(Request $req){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return response()->json([
            'countRowsSuntrack' => $this->setDataSuntrack($search, true)->select('email','dob')->get()->count(),
            'countRowsMobileApp' => $this->setDataMobileAppApplyProgram($search, false, true)->select('email','birth')->get()->count(),
            'countRowsSunEduWeb' => $this->setDataSunEduWeb($search)->select('email','birth')->get()->count(),
            'countRowsSunEngWeb' => $this->setDataSunEngWeb()->select('email','birth')->get()->count(),
            'countRowsEventWorkshop' => $this->setDataEvent($search, 1)->select('email','birth')->get()->count(),
            'countRowsEventSeminar' => $this->setDataEvent($search, 2)->select('email','birth')->get()->count(),
            'countRowsEventInfoSession' => $this->setDataEvent($search, 3)->select('email','birth')->get()->count(),
            'countRowsEventSunEngEvent' => $this->setDataEvent($search, 4)->select('email','birth')->get()->count(),
            'countRowsEventSunEngClass' => $this->setDataEvent($search, 5)->select('email','birth')->get()->count(),
            'countRowsEventPartnerEvent' => $this->setDataEvent($search, 6)->select('email','birth')->get()->count(),
            'countRowsEventSchoolExpo' => $this->setDataEvent($search, 7)->select('email','birth')->get()->count(),
            'countRowsEventIndependent' => $this->setDataEvent($search, 8)->select('email','birth')->get()->count(),
        ]);
    }

    public function setDataSuntrack($search = null, $filterByBranch){
        $datas = SuntrackLead::where('is_sunnies_leads', false)->where('leads.branch_uuid','!=','');

        // Search
        if(!is_null($search)){
            $datas->where('leads.full_name','LIKE','%' . $search . '%');
        }

        // Filter By Branch Sunnies
        if($filterByBranch){
            $sunniesBranch = SunniesBranch::all()->pluck('branch_id');
            $datas->join('branches','branches.branch_uuid','leads.branch_uuid')->whereIn('branches.branch_code', $sunniesBranch);
        }

        // Default Order By
        $datas->orderBy('leads.created_at','desc');

        // Distinct email & dob
        $datas->groupBy('leads.email','leads.dob');

        return $datas;
    }

    public function getDataSuntrack(Request $req){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new SuntrackCollection($this->setDataSuntrack($search, true)->paginate(20));
    }

    public function getDataMobileApp($search = null){
        $datas = SunmobileApplyEvent::select( DB::raw("CONCAT(full_name, ' ',birth) AS unique","*"))->distinct('unique')->where('event_type',['seminar','workshop','info-session'])->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function setDataMobileAppApplyProgram($search, $filterByBranch = false, $filterByPostCode = false){
        $datas = SunmobileApplyProgram::where('is_sunnies_leads', false);

        // Search
        if(!is_null($search)){
            $datas->where('applies.full_name','LIKE','%' . $search . '%');
        }

        // Filter by Branch
        if($filterByBranch){

        }
        if($filterByPostCode){
            $datas->whereNotNull('zip_code')->where('zip_code','!=','');
        }

        // Distinct email & dob
        $datas->groupBy('email','birth');

        return $datas;
    }

    public function getDataMobileAppApplyProgram(Request $req){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new SunmobileApplyProgramCollection($this->setDataMobileAppApplyProgram($search, false, true)->paginate(20));
    }

    public function getDataMobileAppApplyExpo(){
        $datas = SunmobileApplyEvent::where('event_type','education-expo')->orderBy('created_at','desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyWorkshop(){
        $datas = SunmobileApplyEvent::where('event_type','workshop')->orderBy('created_at','desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyEventSeminar(){
        $datas = SunmobileApplyEvent::where('event_type','seminar')->orderBy('created_at','desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyEventInfoSession(){
        $datas = SunmobileApplyEvent::where('event_type','info-session')->orderBy('created_at','desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function setDataSunEduWeb($search = null){
        $datas = Registration::where('is_sunnies_leads', false)->whereIn('registration_type', ['sun-edu-general-registration', 'sun-edu-apply-program', 'sun-edu-info-session', 'sun-edu-seminar', 'sun-edu-workshop']);

        // Where address not null
        $datas->whereNotNull('branch_id')->where('branch_id','!=','');
        $datas->whereNotNull('zip_code')->where('zip_code','!=','');
        $datas->whereNotNull('precur_school')->where('precur_school','!=','');
        // $datas->whereNotNull('highest_edu_id')->where('highest_edu_id','!=','');
        // $datas->whereNotNull('highest_edu')->where('highest_edu','!=','');
        // $datas->whereNotNull('precur_school_id')->where('precur_school_id','!=','');
        // $datas->whereNotNull('precur_school')->where('precur_school','!=','');
        // $datas->whereNotNull('destination_of_study_id')->where('destination_of_study_id','!=','');
        // $datas->whereNotNull('destination_of_study')->where('destination_of_study','!=','');
        // $datas->whereNotNull('major_interested_id')->where('major_interested_id','!=','');
        // $datas->whereNotNull('major_interested')->where('major_interested','!=','');
        // $datas->whereNotNull('program_interested_id')->where('program_interested_id','!=','');
        // $datas->whereNotNull('program_interested')->where('program_interested','!=','');

        // Search
        if(!is_null($search)){
            $datas->where('registrations.full_name','LIKE','%' . $search . '%');
        }

        // Order By
        $datas->orderBy('created_at', 'desc');

        // Distinct
        $datas->groupBy('email','birth');

        return $datas;
    }

    public function getDataSunEduWeb(Request $req){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new SunEduWebCollection($this->setDataSunEduWeb($search)->paginate(20));
    }

    public function getDataSunEduWebGeneral(){
        $datas = Registration::whereIn('registration_type',['sun-edu-general-registration'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataSunEduWebApplyProgram(){
        $datas = Registration::whereIn('registration_type',['sun-edu-apply-program'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function setDataSunEngWeb(){
        $datas = Registration::where('is_sunnies_leads', false)->whereIn('registration_type', ['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-intl-ielts','sun-eng-intl-toefl']);

        // Where address not null
        $datas->whereNotNull('branch_id')->where('branch_id','!=','');
        $datas->whereNotNull('zip_code')->where('zip_code','!=','');
        $datas->whereNotNull('highest_edu_id')->where('highest_edu_id','!=','');
        $datas->whereNotNull('highest_edu')->where('highest_edu','!=','');
        $datas->whereNotNull('precur_school_id')->where('precur_school_id','!=','');
        $datas->whereNotNull('precur_school')->where('precur_school','!=','');
        $datas->whereNotNull('destination_of_study_id')->where('destination_of_study_id','!=','');
        $datas->whereNotNull('destination_of_study')->where('destination_of_study','!=','');
        $datas->whereNotNull('major_interested_id')->where('major_interested_id','!=','');
        $datas->whereNotNull('major_interested')->where('major_interested','!=','');
        $datas->whereNotNull('program_interested_id')->where('program_interested_id','!=','');
        $datas->whereNotNull('program_interested')->where('program_interested','!=','');
        // Order By
        $datas->orderBy('created_at', 'desc');

        return $datas;
    }

    public function getDataSunEngWeb(){
        return new SunEngWebCollection($this->setDataSunEngWeb()->paginate(20));
    }

    public function setDataSunEngWebGeneral(){
        $datas = Registration::whereIn('registration_type',['sun-eng-general-registration'])->orderBy('created_at', 'desc');

        return $datas;
    }

    public function getDataSunEngWebGeneral(){
        return new SunmobileApplyEventCollection($this->setDataSunEngWebGeneral()->paginate(20));
    }

    public function setDataSunEngWebApplyProgram(){
        $datas = Registration::whereIn('registration_type',['sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant'])->orderBy('created_at', 'desc');

        return $datas;
    }

    public function getDataSunEngWebApplyProgram(){
        return new SunmobileApplyEventCollection($this->setDataSunEngWebApplyProgram()->paginate(20));
    }

    public function setDataSunEngWebInternational(){
        $datas = Registration::whereIn('registration_type',['sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc');

        return $datas;
    }

    public function getDataSunEngWebInternational(){
        return new SunmobileApplyEventCollection($this->setDataSunEngWebInternational()->paginate(20));
    }

    public function setDataEvent($search = null, $event_type_id){
        $datas = EventRegistration::where('event_registrations.is_sunnies_leads', false)
                                    ->join('events','events.event_id','event_registrations.event_id')
                                    ->join('event_types','event_types.event_type_id','events.event_type_id')
                                    ->where('event_types.event_type_id',$event_type_id)
                                    ->orderBy('event_registrations.created_at', 'desc')
                                    ->select('event_registrations.*');
                                    // ->groupBy('event_registrations.event_registration_id','event_registrations.email','event_registrations.birth')
                                    // ->get();

        // $datas = EventRegistration::whereIn('event_registration_id', $eventRegistrationIds);
        // Distinct
        // $datas;

        // Search
        if(!is_null($search)){
            $datas->where('event_registrations.full_name','LIKE','%' . $search . '%');
        }

        // Distinct email & dob
        $datas->groupBy('email','birth');

        return $datas;
    }

    public function getDataEvent(Request $req, $event_type_id){
        // $eventRegistrationIds = EventRegistration::where('event_registrations.is_sunnies_leads', false)
        //                             // ->select('event_registrations.event_registration_id','event_registrations.email','event_registrations.birth')
        //                             ->distinct('email')->get();
        //                             return $eventRegistrationIds;

        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new MasterDataEventRegistrationCollection($this->setDataEvent($search, $event_type_id)->paginate(20));
    }

    public function postGetDataExpo(Request $req){
        $events = ApplyEvent::where('full_name', 'LIKE', '%' . $req->search . '%')->where('event_type','education-expo');
        if(!is_null($req->event_id)){
            $events = $events->where('event_id', $req->event_id);
        }

        return new ApplyEventCollection($events->orderBy('created_at','desc')->get());
    }

    public function postGetDataWorkshop(Request $req){
        $events = ApplyEvent::where('full_name', 'LIKE', '%' . $req->search . '%')->where('event_type','workshop');
        if(!is_null($req->event_id)){
            $events = $events->where('event_id', $req->event_id);
        }

        return new ApplyEventCollection($events->orderBy('created_at','desc')->get());
    }

    public function postGetDataSeminar(Request $req){
        $events = ApplyEvent::where('full_name', 'LIKE', '%' . $req->search . '%')->where('event_type','seminar');
        if(!is_null($req->event_id)){
            $events = $events->where('event_id', $req->event_id);
        }

        return new ApplyEventCollection($events->orderBy('created_at','desc')->get());
    }

    public function postGetDataInfoSession(Request $req){
        $events = ApplyEvent::where('full_name', 'LIKE', '%' . $req->search . '%')->where('event_type','info-session');
        if(!is_null($req->event_id)){
            $events = $events->where('event_id', $req->event_id);
        }

        return new ApplyEventCollection($events->orderBy('created_at','desc')->get());
    }

    public function syncToSunnies(Request $req){
        $req->validate([
            'id' => 'required',
            'leads_source' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
        ]);

        switch($req->leads_source){
            case 'Sun Track':
                $leads = SuntrackLead::find($req->id);
                if (!is_null($leads)) {
                    return response()->json($this->fromSuntrack($leads, $req));
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID not found',
                    ]);
                }
                break;

            case 'Sun Mobile App - Apply':
                $leads = SunmobileApplyProgram::find(str_replace('sunmobile-apply-','',$req->id));
                if (!is_null($leads)) {
                    return response()->json($this->fromMobileAppApplyProgram($leads, $req));
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID not found',
                    ]);
                }
                break;

            case 'Sun Eng Web':
                $leads = Registration::find(str_replace('sun-eng-web-','',$req->id));
                if (!is_null($leads)) {
                    return response()->json($this->fromSunEngWeb($leads, $req));
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID not found',
                    ]);
                }
                break;

            case 'Master Data Event':
                $leads = EventRegistration::find(str_replace('master-data-event-','',$req->id));
                if (!is_null($leads)) {
                    return response()->json($this->fromMasterDataEvent($leads, $req));
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'ID not found',
                    ]);
                }
                break;

            default:
                break;
        }
    }

    public function syncAllToSunnies(Request $req){
        $req->validate([
            'leads_source' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
        ]);

        $results = [];

        switch($req->leads_source){
            case 'Sun Track':
                $suntrackLeads = $this->setDataSuntrack(null, true)->get();
                foreach($suntrackLeads as $suntrackLead){
                    $results[] = $this->fromSuntrack($suntrackLead, $req);
                }
                break;

            case 'Sun Mobile App - Apply':
                $mobileAppApplyPrograms = $this->setDataMobileAppApplyProgram(null, false, true)->get();
                foreach($mobileAppApplyPrograms as $mobileAppApplyProgram){
                    $results[] = $this->fromMobileAppApplyProgram($mobileAppApplyProgram, $req);
                }
                break;

            case 'Sun Edu Web':
                $sunEduWebRegistrations = $this->setDataSunEduWeb(null)->get();
                foreach($sunEduWebRegistrations as $sunEduWebRegistration){
                    $results[] = $this->fromSunEduWeb($sunEduWebRegistration, $req);
                }
                break;

            case 'Sun Eng Web':
                $sunEngWebRegistrations = $this->setDataSunEngWeb()->get();
                foreach($sunEngWebRegistrations as $sunEngWebRegistration){
                    $results[] = $this->fromSunEngWeb($sunEngWebRegistration, $req);
                }
                break;

            case 'Master Data Event':
                $masterDataEvents = $this->setDataEvent(null, $req->event_type_id)->get();
                foreach($masterDataEvents as $masterDataEvent){
                    $results[] = $this->fromMasterDataEvent($masterDataEvent, $req);
                }
                break;

            default:
                break;
        }

        return response()->json($results);
    }

    public function fromSuntrack($leads, $req){
        $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

        // Generate Leads ID
        $leads_id = 'LEADS.' . date('y.m.d.') . str_pad($syswebFormatCode->last_number + 1,4, 0, STR_PAD_LEFT);

        if($req->has('manage_by')){
            $manageBy = $req->manage_by;
        } else {
            // Find Branch for branching leads
            $branchSuntrack = SuntrackBranch::find($leads->branch_uuid);
            if(!is_null($branchSuntrack)){
                // $branchSunnies = SunniesBranch::where('branch_id', $branchSuntrack->branch_code)->first();
                $branchSunnies = $this->getSunniesBranchCode($branchSuntrack->branch_code);
                if($branchSunnies == ''){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with code ' . $branchSuntrack->branch_code . ' not found',
                    ];
                } else {
                    $manageBy = $branchSunnies;
                }
            } else {
                // Alternate if Branch is null (use Postal Code Coverage Sunnies)
            }
        }

        // For r_student
        $newLeads = new RStudentRemote();
        $newLeads->leads_id = $leads_id;
        // $newLeads->student_id = null;
        $newLeads->status = 'followup';
        // $newLeads->tags = null;
        $newLeads->register_id = null;
        $newLeads->parents_name = $leads->parents_name;
        $newLeads->parents_mobile = $leads->parents_phone;
        $newLeads->full_name = $leads->full_name;
        // $newLeads->nick_name = '';
        $newLeads->address = $leads->address;
        $postalCode = SuntrackPostalCode::find($leads->postal_code_uuid);
        if(!is_null($postalCode)){
            $newLeads->zip_code = $postalCode->postal_code_number;
            $newLeads->kelurahan = $postalCode->kelurahan;
            $newLeads->kecamatan = $postalCode->kecamatan;
            $newLeads->dt2 = $postalCode->jenis;
            $newLeads->kabupaten = $postalCode->kabupaten;
            $newLeads->provinsi = $postalCode->propinsi;
        } else {
            $newLeads->zip_code = null;
            $newLeads->kelurahan = null;
            $newLeads->kecamatan = null;
            $newLeads->dt2 = null;
            $newLeads->kabupaten = null;
            $newLeads->provinsi = null;
        }
        $newLeads->phone = $leads->telephone;
        $newLeads->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeads->email = $leads->email;
        $newLeads->birth = $leads->dob;
        $newLeads->highest_edu_id = 0;
        $newLeads->highest_edu = '';
        $newLeads->precur_school_id = 0;
        $newLeads->precur_school = '';
        $newLeads->destination_of_study_id = 0;
        $newLeads->destination_of_study = '';
        $newLeads->major_interested_id = 0;
        $newLeads->major_interested = '';
        $newLeads->program_interested_id = 0;
        $newLeads->program_interested = '';
        $newLeads->planning_year = date('Y');
        $newLeads->marketing_source_id = 0;
        $newLeads->marketing_source = $leads->marketing_source_type;
        $newLeads->has_contact_sun = 0;
        // $newLeads->branch_id = null;
        // $newLeads->branch_name = null;
        // $newLeads->other_branch_id = null;
        // $newLeads->other_branch_name = null;
        $newLeads->register_type = 'md-suntrack';
        // $newLeads->comment_flag = null;
        // $newLeads->is_commented = null;
        // $newLeads->is_ielts_participant = null;
        // $newLeads->ielts_result = null;
        $newLeads->manage_by = $manageBy; // Branch Code
        // $newLeads->is_branching_auto = null;
        $newLeads->event_id = 'MASTERDATA';
        $newLeads->event_name = 'From Master Data';
        $newLeads->event_date = '2001-01-01';
        // $newLeads->is_delete = null;
        // $newLeads->pict_profile = null;
        $newLeads->created_by = $req->user_id;
        $newLeads->created_date = date("Y-m-d H:i:s");
        $newLeads->modified_by = $req->user_id;
        $newLeads->modified_date = date("Y-m-d H:i:s");
        $newLeads->created_by_name = $req->user_name;
        $newLeads->modified_by_name = $req->user_name;
        $newLeads->gender = $leads->gender;
        $status1 = $newLeads->save();


        // For f_student
        $newLeadFStudent = new FStudentRemote();
        $newLeadFStudent->leads_id = $leads_id;
        $newLeadFStudent->student_id = '';
        $newLeadFStudent->ssa_no = null;
        $newLeadFStudent->promotion_fee = null;
        $newLeadFStudent->sun_english = 0; // False
        $newLeadFStudent->is_scholarship = 0; // False
        $newLeadFStudent->interest_aptitude = 0; // False
        $newLeadFStudent->status = 'UNHANDLED';
        $newLeadFStudent->tm_status = null;
        $newLeadFStudent->visited_to = null;
        $newLeadFStudent->previous_status = null;
        // $newLeadFStudent->visit_date = '0000-00-00 00:00:00';
        $newLeadFStudent->register_id = null;
        $newLeadFStudent->parents_name = $leads->parents_name;
        $newLeadFStudent->parents_mobile = $leads->parents_phone;
        $newLeadFStudent->overseas_number = null;
        $newLeadFStudent->full_name = $leads->full_name;
        $newLeadFStudent->nick_name = '';
        $newLeadFStudent->address = $leads->address;

        $postalCode = SuntrackPostalCode::find($leads->postal_code_uuid);
        if(!is_null($postalCode)){
            $newLeadFStudent->zip_code = $postalCode->postal_code_number;
            $newLeadFStudent->kelurahan = $postalCode->kelurahan;
            $newLeadFStudent->kecamatan = $postalCode->kecamatan;
            $newLeadFStudent->dt2 = $postalCode->jenis;
            $newLeadFStudent->kabupaten = $postalCode->kabupaten;
            $newLeadFStudent->provinsi = $postalCode->propinsi;
        } else {
            $newLeadFStudent->zip_code = null;
            $newLeadFStudent->kelurahan = null;
            $newLeadFStudent->kecamatan = null;
            $newLeadFStudent->dt2 = null;
            $newLeadFStudent->kabupaten = null;
            $newLeadFStudent->provinsi = null;
        }
        $newLeadFStudent->phone = $leads->telephone;
        $newLeadFStudent->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeadFStudent->email = $leads->email;
        $newLeadFStudent->birth = $leads->dob;
        $newLeadFStudent->highest_edu_id = 0;
        $newLeadFStudent->highest_edu = '';
        $newLeadFStudent->precur_school_id = 0;
        $newLeadFStudent->precur_school = '';
        $newLeadFStudent->destination_of_study_id = 0;
        $newLeadFStudent->destination_of_study = '';
        $newLeadFStudent->major_interested_id = 0;
        $newLeadFStudent->major_interested = '';
        $newLeadFStudent->program_interested_id = 0;
        $newLeadFStudent->program_interested = '';
        $newLeadFStudent->planning_year = date('Y');
        $newLeadFStudent->intake = null;
        $newLeadFStudent->end_intake = null;
        $newLeadFStudent->recruitment_date = null;
        $newLeadFStudent->marketing_source_id = 0;
        $newLeadFStudent->marketing_source = '';
        $newLeadFStudent->has_contact_sun = 0;
        $newLeadFStudent->branch_id = null;
        $newLeadFStudent->branch_name = null;
        $newLeadFStudent->other_branch_id = null;
        $newLeadFStudent->other_branch_name = null;
        $newLeadFStudent->register_type = 'md-suntrack';
        $newLeadFStudent->comment_flag = null;
        $newLeadFStudent->is_commented = 0;
        $newLeadFStudent->is_ielts_participant = 0;
        $newLeadFStudent->ielts_result = 0;
        $newLeadFStudent->manage_by = $manageBy;
        $newLeadFStudent->is_branching_auto = 1;
        $newLeadFStudent->counselor_id = null;
        $newLeadFStudent->admission_id = null;
        $newLeadFStudent->admission_add = null;
        $newLeadFStudent->tmstaff_id = null;
        $newLeadFStudent->tmleader_id = null;
        $newLeadFStudent->event_id = null;
        $newLeadFStudent->event_name = null;
        $newLeadFStudent->event_date = null;
        $newLeadFStudent->pict_profile = null;
        $newLeadFStudent->is_delete = 0;
        $newLeadFStudent->is_publish = 1;
        $newLeadFStudent->is_import = 0;
        $newLeadFStudent->tags = null;
        $newLeadFStudent->passport_no = null;
        $newLeadFStudent->passport_exp = null;
        $newLeadFStudent->callbp_via = null;
        $newLeadFStudent->callbp_on = null;
        $newLeadFStudent->is_sun_property = 0;
        $newLeadFStudent->created_by = $req->user_id;
        $newLeadFStudent->created_date = date("Y-m-d H:i:s");
        $newLeadFStudent->modified_by = $req->user_id;
        $newLeadFStudent->modified_date = date("Y-m-d H:i:s");
        $newLeadFStudent->created_by_name = $req->user_name;
        $newLeadFStudent->modified_by_name = $req->user_name;
        $newLeadFStudent->tm_share_councelor_id = '';
        $newLeadFStudent->tm_share_councelor_date = '';
        $newLeadFStudent->tm_allocate_leader_id = '';
        $newLeadFStudent->tm_allocate_leader_date = '';
        $newLeadFStudent->sort_date = '';
        $newLeadFStudent->gender = $leads->gender;
        $status2 = $newLeadFStudent->save();
        // $status2 = true;

        // Increase Number Sysweb Format Leads Sunnies
        if ($status1 || $status2) {
            $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
            $syswebFormatCode->save();

            $leads->is_sunnies_leads = true;
            $leads->save();

            SuntrackLead::where('email', $leads->email)->where('dob', $leads->dob)->update(['is_sunnies_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->dob;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile_phone;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = false;
            $leadsMD->is_sunnies = true;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $leads_id;
                $leadsHistory->reference_type = 'sunnies';
                $leadsHistory->from = 'suntrack';
                $leadsHistory->to = 'sunnies';
                $leadsHistory->allocated_to = $manageBy;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Sunnies',
                'data' => $newLeads,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Sunnies',
            ];
        }
    }

    public function fromMobileAppApplyProgram($leads, $req){
        $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

        // Generate Leads ID
        $leads_id = 'LEADS.' . date('y.m.d.') . str_pad($syswebFormatCode->last_number + 1,4, 0, STR_PAD_LEFT);

        if($req->has('manage_by')){
            $manageBy = $req->manage_by;
        } else {
            // Find Branch for branching leads - Disable Temporarly
            // $branchSuntrack = SuntrackBranch::find($leads->branch_uuid);
            // if(!is_null($branchSuntrack)){
            //     $branchSunnies = SunniesBranch::where('branch_id', $branchSuntrack->branch_code)->first();
            //     $branchSunnies = $this->getSunniesBranchCode($branchSuntrack->branch_code);
            //     if($branchSunnies == ''){
            //     if(is_null($branchSunnies)){
            //         return [
            //             'success' => false,
            //             'message' => 'Sunnies branch with code ' . $branchSuntrack->branch_code . ' not found',
            //         ];
            //     } else {
            //         $manageBy = $branchSunnies->branch_id;
            //     }
            // } else {
                // Alternate if Branch is null (use Postal Code Coverage Sunnies)
                // $sunniesBranches = SunniesBranch::where('status','active')->get();
                // foreach($sunniesBranches as $sunniesBranch){
                    if(is_null($leads->zip_code) || empty($leads->zip_code)){
                        return [
                            'success' => false,
                            'message' => 'Post code is null or empty',
                        ];
                    }

                    $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($leads->zip_code,coverage_area)")->first();
                    if(is_null($sunniesBranch)){
                        return [
                            'success' => false,
                            'message' => 'Sunnies branch with post code area ' . $leads->zip_code . ' not found',
                        ];
                    } else {
                        $manageBy = $sunniesBranch->branch_id;
                    }

                // }
            // }
        }

        // For r_student
        $newLeads = new RStudentRemote();
        $newLeads->leads_id = $leads_id;
        // $newLeads->student_id = null;
        $newLeads->status = 'followup';
        // $newLeads->tags = null;
        $newLeads->register_id = null;
        $newLeads->parents_name = $leads->parents_name;
        $newLeads->parents_mobile = $leads->parents_phone;
        $newLeads->full_name = $leads->full_name;
        // $newLeads->nick_name = '';
        $newLeads->address = $leads->address;
        $newLeads->zip_code = $leads->zip_code;
        $newLeads->kelurahan = $leads->kelurahan;
        $newLeads->kecamatan = $leads->kecamatan;
        $newLeads->dt2 = $leads->dt2;
        $newLeads->kabupaten = $leads->kabupaten;
        $newLeads->provinsi = $leads->provinsi;
        $newLeads->phone = $leads->phone;
        $newLeads->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeads->email = $leads->email;
        $newLeads->birth = $leads->birth;
        $newLeads->highest_edu_id = $leads->highest_edu_id;
        $newLeads->highest_edu = $leads->highest_edu;
        $newLeads->precur_school_id = $leads->precur_school_id;
        $newLeads->precur_school = $leads->precur_school;
        $newLeads->destination_of_study_id = $leads->destination_of_study_id;
        $newLeads->destination_of_study = $leads->destination_of_study;
        $newLeads->major_interested_id = $leads->major_interested_id;
        $newLeads->major_interested = $leads->major_interested;
        $newLeads->program_interested_id = $leads->program_interested_id;
        $newLeads->program_interested = $leads->program_interested;
        $newLeads->planning_year = date('Y');
        $newLeads->marketing_source_id = $leads->marketing_source_id;
        $newLeads->marketing_source = $leads->marketing_source;
        $newLeads->has_contact_sun = 0;
        // $newLeads->branch_id = null;
        // $newLeads->branch_name = null;
        // $newLeads->other_branch_id = null;
        // $newLeads->other_branch_name = null;
        $newLeads->register_type = 'md-mobile-app';
        // $newLeads->comment_flag = null;
        // $newLeads->is_commented = null;
        // $newLeads->is_ielts_participant = null;
        // $newLeads->ielts_result = null;
        $newLeads->manage_by = $manageBy; // Branch Code
        // $newLeads->is_branching_auto = null;
        $newLeads->event_id = 'MASTERDATA';
        $newLeads->event_name = 'From Master Data';
        $newLeads->event_date = '2001-01-01';
        // $newLeads->is_delete = null;
        // $newLeads->pict_profile = null;
        $newLeads->created_by = $req->user_id;
        $newLeads->created_date = date("Y-m-d H:i:s");
        $newLeads->modified_by = $req->user_id;
        $newLeads->modified_date = date("Y-m-d H:i:s");
        $newLeads->created_by_name = $req->user_name;
        $newLeads->modified_by_name = $req->user_name;
        $newLeads->gender = $leads->gender;
        $status1 = $newLeads->save();


        // For f_student
        $newLeadFStudent = new FStudentRemote();
        $newLeadFStudent->leads_id = $leads_id;
        $newLeadFStudent->student_id = '';
        $newLeadFStudent->ssa_no = null;
        $newLeadFStudent->promotion_fee = null;
        $newLeadFStudent->sun_english = 0; // False
        $newLeadFStudent->is_scholarship = 0; // False
        $newLeadFStudent->interest_aptitude = 0; // False
        $newLeadFStudent->status = 'UNHANDLED';
        $newLeadFStudent->tm_status = null;
        $newLeadFStudent->visited_to = null;
        $newLeadFStudent->previous_status = null;
        // $newLeadFStudent->visit_date = '0000-00-00 00:00:00';
        $newLeadFStudent->register_id = null;
        $newLeadFStudent->parents_name = $leads->parents_name;
        $newLeadFStudent->parents_mobile = $leads->parents_mobile;
        $newLeadFStudent->overseas_number = null;
        $newLeadFStudent->full_name = $leads->full_name;
        $newLeadFStudent->nick_name = '';
        $newLeadFStudent->address = $leads->address;
        $newLeadFStudent->zip_code = $leads->zip_code;
        $newLeadFStudent->kelurahan = $leads->kelurahan;
        $newLeadFStudent->kecamatan = $leads->kecamatan;
        $newLeadFStudent->dt2 = $leads->dt2;
        $newLeadFStudent->kabupaten = $leads->kabupaten;
        $newLeadFStudent->provinsi = $leads->provinsi;
        $newLeadFStudent->phone = $leads->phone;
        $newLeadFStudent->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeadFStudent->email = $leads->email;
        $newLeadFStudent->birth = $leads->birth;
        $newLeadFStudent->highest_edu_id = $leads->highest_edu_id;
        $newLeadFStudent->highest_edu = $leads->highest_edu;
        $newLeadFStudent->precur_school_id = $leads->precur_school_id;
        $newLeadFStudent->precur_school = $leads->precur_school;
        $newLeadFStudent->destination_of_study_id = $leads->destination_of_study_id;
        $newLeadFStudent->destination_of_study = $leads->destination_of_study;
        $newLeadFStudent->major_interested_id = $leads->major_interested_id;
        $newLeadFStudent->major_interested = $leads->major_interested;
        $newLeadFStudent->program_interested_id = $leads->program_interested_id;
        $newLeadFStudent->program_interested = $leads->program_interested;
        $newLeadFStudent->planning_year = date('Y');
        $newLeadFStudent->intake = null;
        $newLeadFStudent->end_intake = null;
        $newLeadFStudent->recruitment_date = null;
        $newLeadFStudent->marketing_source_id = $leads->marketing_source_id;
        $newLeadFStudent->marketing_source = $leads->marketing_source;
        $newLeadFStudent->has_contact_sun = 0;
        $newLeadFStudent->branch_id = null;
        $newLeadFStudent->branch_name = null;
        $newLeadFStudent->other_branch_id = null;
        $newLeadFStudent->other_branch_name = null;
        $newLeadFStudent->register_type = 'md-mobile-app';
        $newLeadFStudent->comment_flag = null;
        $newLeadFStudent->is_commented = 0;
        $newLeadFStudent->is_ielts_participant = 0;
        $newLeadFStudent->ielts_result = 0;
        $newLeadFStudent->manage_by = $manageBy;
        $newLeadFStudent->is_branching_auto = 1;
        $newLeadFStudent->counselor_id = null;
        $newLeadFStudent->admission_id = null;
        $newLeadFStudent->admission_add = null;
        $newLeadFStudent->tmstaff_id = null;
        $newLeadFStudent->tmleader_id = null;
        $newLeadFStudent->event_id = null;
        $newLeadFStudent->event_name = null;
        $newLeadFStudent->event_date = null;
        $newLeadFStudent->pict_profile = null;
        $newLeadFStudent->is_delete = 0;
        $newLeadFStudent->is_publish = 1;
        $newLeadFStudent->is_import = 0;
        $newLeadFStudent->tags = null;
        $newLeadFStudent->passport_no = null;
        $newLeadFStudent->passport_exp = null;
        $newLeadFStudent->callbp_via = null;
        $newLeadFStudent->callbp_on = null;
        $newLeadFStudent->is_sun_property = 0;
        $newLeadFStudent->created_by = $req->user_id;
        $newLeadFStudent->created_date = date("Y-m-d H:i:s");
        $newLeadFStudent->modified_by = $req->user_id;
        $newLeadFStudent->modified_date = date("Y-m-d H:i:s");
        $newLeadFStudent->created_by_name = $req->user_name;
        $newLeadFStudent->modified_by_name = $req->user_name;
        $newLeadFStudent->tm_share_councelor_id = '';
        $newLeadFStudent->tm_share_councelor_date = '';
        $newLeadFStudent->tm_allocate_leader_id = '';
        $newLeadFStudent->tm_allocate_leader_date = '';
        $newLeadFStudent->sort_date = '';
        $newLeadFStudent->gender = $leads->gender;
        $status2 = $newLeadFStudent->save();
        // $status2 = true;

        // Increase Number Sysweb Format Leads Sunnies
        if ($status1 || $status2) {
            $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
            $syswebFormatCode->save();

            $leads->is_sunnies_leads = true;
            $leads->save();

            SunmobileApplyProgram::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_sunnies_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->dob;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile_phone;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = false;
            $leadsMD->is_sunnies = true;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $leads_id;
                $leadsHistory->reference_type = 'sunnies';
                $leadsHistory->from = 'suntrack';
                $leadsHistory->to = 'sunnies';
                $leadsHistory->allocated_to = $manageBy;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Sunnies',
                'data' => $newLeads,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Sunnies',
            ];
        }
    }

    public function fromSunEngWeb($leads, $req){
        $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

        // Generate Leads ID
        $leads_id = 'LEADS.' . date('y.m.d.') . str_pad($syswebFormatCode->last_number + 1,4, 0, STR_PAD_LEFT);

        if($req->has('manage_by')){
            $manageBy = $req->manage_by;
        } else {
            // Find Branch for branching leads - Disable Temporarly
            $masterDataBranch = MasterDataBranch::find($leads->branch_id);
            if(!is_null($masterDataBranch)){
                // $branchSunnies = SunniesBranch::where('branch_id', $masterDataBranch->branch_code)->first();
                $branchSunnies = $this->getSunniesBranchCode($masterDataBranch->branch_code);
                if($branchSunnies == ''){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with code ' . $masterDataBranch->branch_code . ' not found',
                    ];
                } else {
                    $manageBy = $branchSunnies->branch_id;
                }
            } else {
                // Alternate if Branch is null (use Postal Code Coverage Sunnies)
                if(is_null($leads->zip_code) || empty($leads->zip_code)){
                    return [
                        'success' => false,
                        'message' => 'Post code is null or empty',
                    ];
                }

                $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($leads->zip_code,coverage_area)")->first();
                if(is_null($sunniesBranch)){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with post code area ' . $leads->zip_code . ' not found',
                    ];
                } else {
                    $manageBy = $sunniesBranch->branch_id;
                }
            }
        }

        // For r_student
        $newLeads = new RStudentRemote();
        $newLeads->leads_id = $leads_id;
        // $newLeads->student_id = null;
        $newLeads->status = 'followup';
        // $newLeads->tags = null;
        $newLeads->register_id = null;
        $newLeads->parents_name = $leads->parents_name;
        $newLeads->parents_mobile = $leads->parents_phone;
        $newLeads->full_name = $leads->full_name;
        // $newLeads->nick_name = '';
        $newLeads->address = $leads->address;
        $newLeads->zip_code = $leads->zip_code;
        $newLeads->kelurahan = $leads->kelurahan;
        $newLeads->kecamatan = $leads->kecamatan;
        $newLeads->dt2 = $leads->dt2;
        $newLeads->kabupaten = $leads->kabupaten;
        $newLeads->provinsi = $leads->provinsi;
        $newLeads->phone = $leads->fixed_phone;
        $newLeads->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeads->email = $leads->email;
        $newLeads->birth = $leads->birth;
        $newLeads->highest_edu_id = $leads->highest_edu_id;
        $newLeads->highest_edu = $leads->highest_edu;
        $newLeads->precur_school_id = $leads->precur_school_id;
        $newLeads->precur_school = $leads->precur_school;
        $newLeads->destination_of_study_id = $leads->destination_of_study_id;
        $newLeads->destination_of_study = $leads->destination_of_study;
        $newLeads->major_interested_id = $leads->major_interested_id;
        $newLeads->major_interested = $leads->major_interested;
        $newLeads->program_interested_id = $leads->program_interested_id;
        $newLeads->program_interested = $leads->program_interested;
        $newLeads->planning_year = date('Y');
        $newLeads->marketing_source_id = $leads->marketing_source_id;
        $newLeads->marketing_source = $leads->marketing_source;
        $newLeads->has_contact_sun = $leads->has_contact_sun;
        // $newLeads->branch_id = null;
        // $newLeads->branch_name = null;
        // $newLeads->other_branch_id = null;
        // $newLeads->other_branch_name = null;
        $newLeads->register_type = 'md-sun-eng-web';
        // $newLeads->comment_flag = null;
        // $newLeads->is_commented = null;
        // $newLeads->is_ielts_participant = null;
        // $newLeads->ielts_result = null;
        $newLeads->manage_by = $manageBy; // Branch Code
        // $newLeads->is_branching_auto = null;
        $newLeads->event_id = 'MASTERDATA';
        $newLeads->event_name = 'From Master Data';
        $newLeads->event_date = '2001-01-01';
        // $newLeads->is_delete = null;
        // $newLeads->pict_profile = null;
        $newLeads->created_by = $req->user_id;
        $newLeads->created_date = date("Y-m-d H:i:s");
        $newLeads->modified_by = $req->user_id;
        $newLeads->modified_date = date("Y-m-d H:i:s");
        $newLeads->created_by_name = $req->user_name;
        $newLeads->modified_by_name = $req->user_name;
        $newLeads->gender = $leads->gender;
        $status1 = $newLeads->save();


        // For f_student
        $newLeadFStudent = new FStudentRemote();
        $newLeadFStudent->leads_id = $leads_id;
        $newLeadFStudent->student_id = '';
        $newLeadFStudent->ssa_no = null;
        $newLeadFStudent->promotion_fee = null;
        $newLeadFStudent->sun_english = 0; // False
        $newLeadFStudent->is_scholarship = 0; // False
        $newLeadFStudent->interest_aptitude = 0; // False
        $newLeadFStudent->status = 'UNHANDLED';
        $newLeadFStudent->tm_status = null;
        $newLeadFStudent->visited_to = null;
        $newLeadFStudent->previous_status = null;
        // $newLeadFStudent->visit_date = '0000-00-00 00:00:00';
        $newLeadFStudent->register_id = null;
        $newLeadFStudent->parents_name = $leads->parents_name;
        $newLeadFStudent->parents_mobile = $leads->parents_mobile;
        $newLeadFStudent->overseas_number = null;
        $newLeadFStudent->full_name = $leads->full_name;
        $newLeadFStudent->nick_name = '';
        $newLeadFStudent->address = $leads->address;
        $newLeadFStudent->zip_code = $leads->zip_code;
        $newLeadFStudent->kelurahan = $leads->kelurahan;
        $newLeadFStudent->kecamatan = $leads->kecamatan;
        $newLeadFStudent->dt2 = $leads->dt2;
        $newLeadFStudent->kabupaten = $leads->kabupaten;
        $newLeadFStudent->provinsi = $leads->provinsi;
        $newLeadFStudent->phone = $leads->fixed_phone;
        $newLeadFStudent->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeadFStudent->email = $leads->email;
        $newLeadFStudent->birth = $leads->birth;
        $newLeadFStudent->highest_edu_id = $leads->highest_edu_id;
        $newLeadFStudent->highest_edu = $leads->highest_edu;
        $newLeadFStudent->precur_school_id = $leads->precur_school_id;
        $newLeadFStudent->precur_school = $leads->precur_school;
        $newLeadFStudent->destination_of_study_id = $leads->destination_of_study_id;
        $newLeadFStudent->destination_of_study = $leads->destination_of_study;
        $newLeadFStudent->major_interested_id = $leads->major_interested_id;
        $newLeadFStudent->major_interested = $leads->major_interested;
        $newLeadFStudent->program_interested_id = $leads->program_interested_id;
        $newLeadFStudent->program_interested = $leads->program_interested;
        $newLeadFStudent->planning_year = date('Y');
        $newLeadFStudent->intake = null;
        $newLeadFStudent->end_intake = null;
        $newLeadFStudent->recruitment_date = null;
        $newLeadFStudent->marketing_source_id = $leads->marketing_source_id;
        $newLeadFStudent->marketing_source = $leads->marketing_source;
        $newLeadFStudent->has_contact_sun = $leads->has_contact_sun;
        $newLeadFStudent->branch_id = null;
        $newLeadFStudent->branch_name = null;
        $newLeadFStudent->other_branch_id = null;
        $newLeadFStudent->other_branch_name = null;
        $newLeadFStudent->register_type = 'md-sun-eng-web';
        $newLeadFStudent->comment_flag = null;
        $newLeadFStudent->is_commented = 0;
        $newLeadFStudent->is_ielts_participant = 0;
        $newLeadFStudent->ielts_result = 0;
        $newLeadFStudent->manage_by = $manageBy;
        $newLeadFStudent->is_branching_auto = 1;
        $newLeadFStudent->counselor_id = null;
        $newLeadFStudent->admission_id = null;
        $newLeadFStudent->admission_add = null;
        $newLeadFStudent->tmstaff_id = null;
        $newLeadFStudent->tmleader_id = null;
        $newLeadFStudent->event_id = null;
        $newLeadFStudent->event_name = null;
        $newLeadFStudent->event_date = null;
        $newLeadFStudent->pict_profile = null;
        $newLeadFStudent->is_delete = 0;
        $newLeadFStudent->is_publish = 1;
        $newLeadFStudent->is_import = 0;
        $newLeadFStudent->tags = null;
        $newLeadFStudent->passport_no = null;
        $newLeadFStudent->passport_exp = null;
        $newLeadFStudent->callbp_via = null;
        $newLeadFStudent->callbp_on = null;
        $newLeadFStudent->is_sun_property = 0;
        $newLeadFStudent->created_by = $req->user_id;
        $newLeadFStudent->created_date = date("Y-m-d H:i:s");
        $newLeadFStudent->modified_by = $req->user_id;
        $newLeadFStudent->modified_date = date("Y-m-d H:i:s");
        $newLeadFStudent->created_by_name = $req->user_name;
        $newLeadFStudent->modified_by_name = $req->user_name;
        $newLeadFStudent->tm_share_councelor_id = '';
        $newLeadFStudent->tm_share_councelor_date = '';
        $newLeadFStudent->tm_allocate_leader_id = '';
        $newLeadFStudent->tm_allocate_leader_date = '';
        $newLeadFStudent->sort_date = '';
        $newLeadFStudent->gender = is_null($leads->gender) ? 'undefined' : $leads->gender;
        $status2 = $newLeadFStudent->save();
        // $status2 = true;

        // Increase Number Sysweb Format Leads Sunnies
        if ($status1 || $status2) {
            $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
            $syswebFormatCode->save();

            $leads->is_sunnies_leads = true;
            $leads->save();

            Registration::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_sunnies_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->dob;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile_phone;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = false;
            $leadsMD->is_sunnies = true;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $leads_id;
                $leadsHistory->reference_type = 'sunnies';
                $leadsHistory->from = 'suntrack';
                $leadsHistory->to = 'sunnies';
                $leadsHistory->allocated_to = $manageBy;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Sunnies',
                'data' => $newLeads,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Sunnies',
            ];
        }
    }

    public function fromSunEduWeb($leads, $req){
        $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

        // Generate Leads ID
        $leads_id = 'LEADS.' . date('y.m.d.') . str_pad($syswebFormatCode->last_number + 1,4, 0, STR_PAD_LEFT);

        if($req->has('manage_by')){
            $manageBy = $req->manage_by;
        } else {
            // Find Branch for branching leads - Disable Temporarly
            $masterDataBranch = MasterDataBranch::find($leads->branch_id);
            // return $masterDataBranch;
            if(!is_null($masterDataBranch)){
                // $branchSunnies = SunniesBranch::where('branch_id', $masterDataBranch->branch_code)->first();
                $getSunniesBranchCode = $this->getSunniesBranchCode($masterDataBranch->branch_code);
                if($getSunniesBranchCode == ''){
                    // return [
                    //     'success' => false,
                    //     'message' => 'Sunnies branch with code ' . $masterDataBranch->branch_code . ' not found',
                    // ];
                    // Alternate if Branch is null (use Postal Code Coverage Sunnies)
                    if(is_null($leads->zip_code) || empty($leads->zip_code)){
                        return [
                            'success' => false,
                            'message' => 'Post code is null or empty',
                        ];
                    }

                    $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($leads->zip_code,coverage_area)")->first();
                    if(is_null($sunniesBranch)){
                        return [
                            'success' => false,
                            'message' => 'Sunnies branch with post code area ' . $leads->zip_code . ' not found',
                        ];
                    } else {
                        $manageBy = $sunniesBranch->branch_id;
                    }
                } else {
                    $manageBy = $getSunniesBranchCode;
                }
            } else {
                // Alternate if Branch is null (use Postal Code Coverage Sunnies)
                if(is_null($leads->zip_code) || empty($leads->zip_code)){
                    return [
                        'success' => false,
                        'message' => 'Post code is null or empty',
                    ];
                }

                $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($leads->zip_code,coverage_area)")->first();
                if(is_null($sunniesBranch)){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with post code area ' . $leads->zip_code . ' not found',
                    ];
                } else {
                    $manageBy = $sunniesBranch->branch_id;
                }
            }
        }

        // For r_student
        $newLeads = new RStudentRemote();
        $newLeads->leads_id = $leads_id;
        // $newLeads->student_id = null;
        $newLeads->status = 'followup';
        // $newLeads->tags = null;
        $newLeads->register_id = null;
        $newLeads->parents_name = $leads->parents_name;
        $newLeads->parents_mobile = $leads->parents_phone;
        $newLeads->full_name = $leads->full_name;
        // $newLeads->nick_name = '';
        $newLeads->address = $leads->address;
        $newLeads->zip_code = $leads->zip_code;
        $newLeads->kelurahan = $leads->kelurahan;
        $newLeads->kecamatan = $leads->kecamatan;
        $newLeads->dt2 = $leads->dt2;
        $newLeads->kabupaten = $leads->kabupaten;
        $newLeads->provinsi = $leads->provinsi;
        $newLeads->phone = $leads->fixed_phone;
        $newLeads->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeads->email = $leads->email;
        $newLeads->birth = $leads->birth;
        $newLeads->highest_edu_id = $leads->highest_edu_id;
        $newLeads->highest_edu = $leads->highest_edu;
        $newLeads->precur_school_id = $leads->precur_school_id;
        $newLeads->precur_school = $leads->precur_school;
        $newLeads->destination_of_study_id = $leads->destination_of_study_id;
        $newLeads->destination_of_study = $leads->destination_of_study;
        $newLeads->major_interested_id = $leads->major_interested_id;
        $newLeads->major_interested = $leads->major_interested;
        $newLeads->program_interested_id = $leads->program_interested_id;
        $newLeads->program_interested = $leads->program_interested;
        $newLeads->planning_year = date('Y');
        $newLeads->marketing_source_id = $leads->marketing_source_id;
        $newLeads->marketing_source = $leads->marketing_source;
        $newLeads->has_contact_sun = $leads->has_contact_sun;
        // $newLeads->branch_id = null;
        // $newLeads->branch_name = null;
        // $newLeads->other_branch_id = null;
        // $newLeads->other_branch_name = null;
        $newLeads->register_type = 'md-sun-edu-web';
        // $newLeads->comment_flag = null;
        // $newLeads->is_commented = null;
        // $newLeads->is_ielts_participant = null;
        // $newLeads->ielts_result = null;
        $newLeads->manage_by = $manageBy; // Branch Code
        // $newLeads->is_branching_auto = null;
        $newLeads->event_id = 'MASTERDATA';
        $newLeads->event_name = 'From Master Data';
        $newLeads->event_date = '2001-01-01';
        // $newLeads->is_delete = null;
        // $newLeads->pict_profile = null;
        $newLeads->created_by = $req->user_id;
        $newLeads->created_date = date("Y-m-d H:i:s");
        $newLeads->modified_by = $req->user_id;
        $newLeads->modified_date = date("Y-m-d H:i:s");
        $newLeads->created_by_name = $req->user_name;
        $newLeads->modified_by_name = $req->user_name;
        $newLeads->gender = $leads->gender;
        $status1 = $newLeads->save();


        // For f_student
        $newLeadFStudent = new FStudentRemote();
        $newLeadFStudent->leads_id = $leads_id;
        $newLeadFStudent->student_id = '';
        $newLeadFStudent->ssa_no = null;
        $newLeadFStudent->promotion_fee = null;
        $newLeadFStudent->sun_english = 0; // False
        $newLeadFStudent->is_scholarship = 0; // False
        $newLeadFStudent->interest_aptitude = 0; // False
        $newLeadFStudent->status = 'UNHANDLED';
        $newLeadFStudent->tm_status = null;
        $newLeadFStudent->visited_to = null;
        $newLeadFStudent->previous_status = null;
        // $newLeadFStudent->visit_date = '0000-00-00 00:00:00';
        $newLeadFStudent->register_id = null;
        $newLeadFStudent->parents_name = $leads->parents_name;
        $newLeadFStudent->parents_mobile = $leads->parents_mobile;
        $newLeadFStudent->overseas_number = null;
        $newLeadFStudent->full_name = $leads->full_name;
        $newLeadFStudent->nick_name = '';
        $newLeadFStudent->address = $leads->address;
        $newLeadFStudent->zip_code = $leads->zip_code;
        $newLeadFStudent->kelurahan = $leads->kelurahan;
        $newLeadFStudent->kecamatan = $leads->kecamatan;
        $newLeadFStudent->dt2 = $leads->dt2;
        $newLeadFStudent->kabupaten = $leads->kabupaten;
        $newLeadFStudent->provinsi = $leads->provinsi;
        $newLeadFStudent->phone = $leads->fixed_phone;
        $newLeadFStudent->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeadFStudent->email = $leads->email;
        $newLeadFStudent->birth = $leads->birth;
        $newLeadFStudent->highest_edu_id = $leads->highest_edu_id;
        $newLeadFStudent->highest_edu = $leads->highest_edu;
        $newLeadFStudent->precur_school_id = $leads->precur_school_id;
        $newLeadFStudent->precur_school = $leads->precur_school;
        $newLeadFStudent->destination_of_study_id = $leads->destination_of_study_id;
        $newLeadFStudent->destination_of_study = $leads->destination_of_study;
        $newLeadFStudent->major_interested_id = $leads->major_interested_id;
        $newLeadFStudent->major_interested = $leads->major_interested;
        $newLeadFStudent->program_interested_id = $leads->program_interested_id;
        $newLeadFStudent->program_interested = $leads->program_interested;
        $newLeadFStudent->planning_year = date('Y');
        $newLeadFStudent->intake = null;
        $newLeadFStudent->end_intake = null;
        $newLeadFStudent->recruitment_date = null;
        $newLeadFStudent->marketing_source_id = $leads->marketing_source_id;
        $newLeadFStudent->marketing_source = $leads->marketing_source;
        $newLeadFStudent->has_contact_sun = $leads->has_contact_sun;
        $newLeadFStudent->branch_id = null;
        $newLeadFStudent->branch_name = null;
        $newLeadFStudent->other_branch_id = null;
        $newLeadFStudent->other_branch_name = null;
        $newLeadFStudent->register_type = 'md-sun-edu-web';
        $newLeadFStudent->comment_flag = null;
        $newLeadFStudent->is_commented = 0;
        $newLeadFStudent->is_ielts_participant = 0;
        $newLeadFStudent->ielts_result = 0;
        $newLeadFStudent->manage_by = $manageBy;
        $newLeadFStudent->is_branching_auto = 1;
        $newLeadFStudent->counselor_id = null;
        $newLeadFStudent->admission_id = null;
        $newLeadFStudent->admission_add = null;
        $newLeadFStudent->tmstaff_id = null;
        $newLeadFStudent->tmleader_id = null;
        $newLeadFStudent->event_id = null;
        $newLeadFStudent->event_name = null;
        $newLeadFStudent->event_date = null;
        $newLeadFStudent->pict_profile = null;
        $newLeadFStudent->is_delete = 0;
        $newLeadFStudent->is_publish = 1;
        $newLeadFStudent->is_import = 0;
        $newLeadFStudent->tags = null;
        $newLeadFStudent->passport_no = null;
        $newLeadFStudent->passport_exp = null;
        $newLeadFStudent->callbp_via = null;
        $newLeadFStudent->callbp_on = null;
        $newLeadFStudent->is_sun_property = 0;
        $newLeadFStudent->created_by = $req->user_id;
        $newLeadFStudent->created_date = date("Y-m-d H:i:s");
        $newLeadFStudent->modified_by = $req->user_id;
        $newLeadFStudent->modified_date = date("Y-m-d H:i:s");
        $newLeadFStudent->created_by_name = $req->user_name;
        $newLeadFStudent->modified_by_name = $req->user_name;
        $newLeadFStudent->tm_share_councelor_id = '';
        $newLeadFStudent->tm_share_councelor_date = '';
        $newLeadFStudent->tm_allocate_leader_id = '';
        $newLeadFStudent->tm_allocate_leader_date = '';
        $newLeadFStudent->sort_date = '';
        $newLeadFStudent->gender = is_null($leads->gender) ? 'undefined' : $leads->gender;
        $status2 = $newLeadFStudent->save();
        // $status2 = true;

        // Increase Number Sysweb Format Leads Sunnies
        if ($status1 || $status2) {
            $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
            $syswebFormatCode->save();

            $leads->is_sunnies_leads = true;
            $leads->save();

            Registration::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_sunnies_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->dob;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile_phone;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = false;
            $leadsMD->is_sunnies = true;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $leads_id;
                $leadsHistory->reference_type = 'sunnies';
                $leadsHistory->from = 'suntrack';
                $leadsHistory->to = 'sunnies';
                $leadsHistory->allocated_to = $manageBy;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Sunnies',
                'data' => $newLeads,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Sunnies',
            ];
        }
    }

    public function fromMasterDataEvent($leads, $req){
        $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

        // Generate Leads ID
        $leads_id = 'LEADS.' . date('y.m.d.') . str_pad($syswebFormatCode->last_number + 1,4, 0, STR_PAD_LEFT);

        if($req->has('manage_by')){
            $manageBy = $req->manage_by;
        } else {
            // Find Branch for branching leads - Disable Temporarly
            $masterDataBranch = MasterDataBranch::find($leads->branch_id);
            if(!is_null($masterDataBranch)){
                // $branchSunnies = SunniesBranch::where('branch_id', $masterDataBranch->branch_code)->first();
                $branchSunnies = $this->getSunniesBranchCode($masterDataBranch->branch_code);
                if($branchSunnies == ''){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with code ' . $masterDataBranch->branch_code . ' not found',
                    ];
                } else {
                    $manageBy = $branchSunnies;
                }
            } else {
                // Alternate if Branch is null (use Postal Code Coverage Sunnies)
                if(is_null($leads->zip_code) || empty($leads->zip_code)){
                    return [
                        'success' => false,
                        'message' => 'Post code is null or empty',
                    ];
                }

                $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($leads->zip_code,coverage_area)")->first();
                if(is_null($sunniesBranch)){
                    return [
                        'success' => false,
                        'message' => 'Sunnies branch with post code area ' . $leads->zip_code . ' not found',
                    ];
                } else {
                    $manageBy = $sunniesBranch->branch_id;
                }
            }
        }

        // For r_student
        $newLeads = new RStudentRemote();
        $newLeads->leads_id = $leads_id;
        // $newLeads->student_id = null;
        $newLeads->status = 'followup';
        // $newLeads->tags = null;
        $newLeads->register_id = null;
        $newLeads->parents_name = $leads->parents_name;
        $newLeads->parents_mobile = $leads->parents_phone;
        $newLeads->full_name = $leads->full_name;
        // $newLeads->nick_name = '';
        $newLeads->address = $leads->address;
        $newLeads->zip_code = $leads->zip_code;
        $newLeads->kelurahan = $leads->kelurahan;
        $newLeads->kecamatan = $leads->kecamatan;
        $newLeads->dt2 = $leads->dt2;
        $newLeads->kabupaten = $leads->kabupaten;
        $newLeads->provinsi = $leads->provinsi;
        $newLeads->phone = $leads->fixed_phone;
        $newLeads->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeads->email = $leads->email;
        $newLeads->birth = $leads->birth;
        $newLeads->highest_edu_id = $leads->highest_edu_id;
        $newLeads->highest_edu = $leads->highest_edu;
        $newLeads->precur_school_id = $leads->precur_school_id;
        $newLeads->precur_school = $leads->precur_school;
        $newLeads->destination_of_study_id = $leads->destination_of_study_id;
        $newLeads->destination_of_study = $leads->destination_of_study;
        $newLeads->major_interested_id = $leads->major_interested_id;
        $newLeads->major_interested = $leads->major_interested;
        $newLeads->program_interested_id = $leads->program_interested_id;
        $newLeads->program_interested = $leads->program_interested;
        $newLeads->planning_year = date('Y');
        $newLeads->marketing_source_id = $leads->marketing_source_id;
        $newLeads->marketing_source = $leads->marketing_source;
        $newLeads->has_contact_sun = $leads->has_contact_sun;
        // $newLeads->branch_id = null;
        // $newLeads->branch_name = null;
        // $newLeads->other_branch_id = null;
        // $newLeads->other_branch_name = null;
        $newLeads->register_type = 'md-event';
        // $newLeads->comment_flag = null;
        // $newLeads->is_commented = null;
        // $newLeads->is_ielts_participant = null;
        // $newLeads->ielts_result = null;
        $newLeads->manage_by = $manageBy; // Branch Code
        // $newLeads->is_branching_auto = null;
        $newLeads->event_id = 'MASTERDATA';
        $newLeads->event_name = 'From Master Data';
        $newLeads->event_date = '2001-01-01';
        // $newLeads->is_delete = null;
        // $newLeads->pict_profile = null;
        $newLeads->created_by = $req->user_id;
        $newLeads->created_date = date("Y-m-d H:i:s");
        $newLeads->modified_by = $req->user_id;
        $newLeads->modified_date = date("Y-m-d H:i:s");
        $newLeads->created_by_name = $req->user_name;
        $newLeads->modified_by_name = $req->user_name;
        $newLeads->gender = $leads->gender;
        $status1 = $newLeads->save();


        // For f_student
        $newLeadFStudent = new FStudentRemote();
        $newLeadFStudent->leads_id = $leads_id;
        $newLeadFStudent->student_id = '';
        $newLeadFStudent->ssa_no = null;
        $newLeadFStudent->promotion_fee = null;
        $newLeadFStudent->sun_english = 0; // False
        $newLeadFStudent->is_scholarship = 0; // False
        $newLeadFStudent->interest_aptitude = 0; // False
        $newLeadFStudent->status = 'UNHANDLED';
        $newLeadFStudent->tm_status = null;
        $newLeadFStudent->visited_to = null;
        $newLeadFStudent->previous_status = null;
        // $newLeadFStudent->visit_date = '0000-00-00 00:00:00';
        $newLeadFStudent->register_id = null;
        $newLeadFStudent->parents_name = $leads->parents_name;
        $newLeadFStudent->parents_mobile = $leads->parents_mobile;
        $newLeadFStudent->overseas_number = null;
        $newLeadFStudent->full_name = $leads->full_name;
        $newLeadFStudent->nick_name = '';
        $newLeadFStudent->address = $leads->address;
        $newLeadFStudent->zip_code = $leads->zip_code;
        $newLeadFStudent->kelurahan = $leads->kelurahan;
        $newLeadFStudent->kecamatan = $leads->kecamatan;
        $newLeadFStudent->dt2 = $leads->dt2;
        $newLeadFStudent->kabupaten = $leads->kabupaten;
        $newLeadFStudent->provinsi = $leads->provinsi;
        $newLeadFStudent->phone = $leads->fixed_phone;
        $newLeadFStudent->mobile = preg_replace('/[^\p{L}\p{N}\s]/u', '', str_replace(['+62','+08'], ['',''], $leads->mobile_phone));
        $newLeadFStudent->email = $leads->email;
        $newLeadFStudent->birth = $leads->birth;
        $newLeadFStudent->highest_edu_id = $leads->highest_edu_id;
        $newLeadFStudent->highest_edu = $leads->highest_edu;
        $newLeadFStudent->precur_school_id = $leads->precur_school_id;
        $newLeadFStudent->precur_school = $leads->precur_school;
        $newLeadFStudent->destination_of_study_id = $leads->destination_of_study_id;
        $newLeadFStudent->destination_of_study = $leads->destination_of_study;
        $newLeadFStudent->major_interested_id = $leads->major_interested_id;
        $newLeadFStudent->major_interested = $leads->major_interested;
        $newLeadFStudent->program_interested_id = $leads->program_interested_id;
        $newLeadFStudent->program_interested = $leads->program_interested;
        $newLeadFStudent->planning_year = date('Y');
        $newLeadFStudent->intake = null;
        $newLeadFStudent->end_intake = null;
        $newLeadFStudent->recruitment_date = null;
        $newLeadFStudent->marketing_source_id = $leads->marketing_source_id;
        $newLeadFStudent->marketing_source = $leads->marketing_source;
        $newLeadFStudent->has_contact_sun = $leads->has_contact_sun;
        $newLeadFStudent->branch_id = null;
        $newLeadFStudent->branch_name = null;
        $newLeadFStudent->other_branch_id = null;
        $newLeadFStudent->other_branch_name = null;
        $newLeadFStudent->register_type = 'md-event';
        $newLeadFStudent->comment_flag = null;
        $newLeadFStudent->is_commented = 0;
        $newLeadFStudent->is_ielts_participant = 0;
        $newLeadFStudent->ielts_result = 0;
        $newLeadFStudent->manage_by = $manageBy;
        $newLeadFStudent->is_branching_auto = 1;
        $newLeadFStudent->counselor_id = null;
        $newLeadFStudent->admission_id = null;
        $newLeadFStudent->admission_add = null;
        $newLeadFStudent->tmstaff_id = null;
        $newLeadFStudent->tmleader_id = null;
        $newLeadFStudent->event_id = null;
        $newLeadFStudent->event_name = null;
        $newLeadFStudent->event_date = null;
        $newLeadFStudent->pict_profile = null;
        $newLeadFStudent->is_delete = 0;
        $newLeadFStudent->is_publish = 1;
        $newLeadFStudent->is_import = 0;
        $newLeadFStudent->tags = null;
        $newLeadFStudent->passport_no = null;
        $newLeadFStudent->passport_exp = null;
        $newLeadFStudent->callbp_via = null;
        $newLeadFStudent->callbp_on = null;
        $newLeadFStudent->is_sun_property = 0;
        $newLeadFStudent->created_by = $req->user_id;
        $newLeadFStudent->created_date = date("Y-m-d H:i:s");
        $newLeadFStudent->modified_by = $req->user_id;
        $newLeadFStudent->modified_date = date("Y-m-d H:i:s");
        $newLeadFStudent->created_by_name = $req->user_name;
        $newLeadFStudent->modified_by_name = $req->user_name;
        $newLeadFStudent->tm_share_councelor_id = '';
        $newLeadFStudent->tm_share_councelor_date = '';
        $newLeadFStudent->tm_allocate_leader_id = '';
        $newLeadFStudent->tm_allocate_leader_date = '';
        $newLeadFStudent->sort_date = '';
        $newLeadFStudent->gender = is_null($leads->gender) ? 'undefined' : $leads->gender;
        $status2 = $newLeadFStudent->save();
        // $status2 = true;

        // Increase Number Sysweb Format Leads Sunnies
        if ($status1 || $status2) {
            $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
            $syswebFormatCode->save();

            $leads->is_sunnies_leads = true;
            $leads->save();

            EventRegistration::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_sunnies_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->dob;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile_phone;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = false;
            $leadsMD->is_sunnies = true;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $leads_id;
                $leadsHistory->reference_type = 'sunnies';
                $leadsHistory->from = 'suntrack';
                $leadsHistory->to = 'sunnies';
                $leadsHistory->allocated_to = $manageBy;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Sunnies',
                'data' => $newLeads,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Sunnies',
            ];
        }
    }


    public function sendToFollowUp(){
        $action_desc = "Send students to responsible Branch Manager.";
        $data["result"] = "ok";
        if (!IsNullOrEmpty($main->V['filter_bid'])){
            $now = date("Y-m-d H:i:s");
            $user_id = $main->S['UserIdentity']->UserId;
            $user_name = $main->S['UserIdentity']->UserName; //
            $data["recap_from"] = $main->DBGetFirst("SELECT COUNT(CASE WHEN manage_by='".$main->V['filter_bid']."' THEN leads_id ELSE NULL END) AS ".$main->V['filter_bid']." FROM r_student WHERE (is_delete IS NULL OR is_delete IS FALSE) AND status IN ('register','branching')", $main->V['filter_bid']);
            $query = "SELECT leads_id, status FROM f_student WHERE leads_id IN (SELECT leads_id FROM r_student WHERE (is_delete IS NULL OR is_delete IS FALSE) AND manage_by='".$main->V['filter_bid']."' AND status IN ('register','branching'))";
            $rs_check = $main->DBExec($query);
            while(!$rs_check->eof){
                $query = "UPDATE r_student SET status='followup' WHERE leads_id='".$rs_check->fields['leads_id']."'";
                $main->DBExec($query);
                $rs_check->MoveNext();
            }//ew
            $query_u = "SELECT user_id FROM v_users WHERE FIND_IN_SET('".$main->V['filter_bid']."', branch_ids) AND FIND_IN_SET('Counselor', role_names)";
            $result_u = $main->DBGetFirst($query_u);
            $query = "INSERT INTO f_student (leads_id, student_id, register_id, parents_name, parents_mobile, full_name, nick_name, address, zip_code, kelurahan, kecamatan, dt2, kabupaten, provinsi, phone, mobile, email, birth, highest_edu_id, highest_edu, precur_school_id, precur_school, destination_of_study_id, destination_of_study, major_interested_id, major_interested, program_interested_id, program_interested, planning_year, marketing_source_id, marketing_source, has_contact_sun, branch_id, branch_name, other_branch_id, other_branch_name, register_type, comment_flag, is_commented, is_ielts_participant, ielts_result, manage_by, is_branching_auto, event_id, event_name, event_date, created_by, created_date, modified_by, modified_date, created_by_name, modified_by_name) SELECT leads_id, student_id, register_id, parents_name, parents_mobile, full_name, nick_name, address, zip_code, kelurahan, kecamatan, dt2, kabupaten, provinsi, phone, mobile, email, birth, highest_edu_id, highest_edu, precur_school_id, precur_school, destination_of_study_id, destination_of_study, major_interested_id, major_interested, program_interested_id, program_interested, planning_year, marketing_source_id, marketing_source, has_contact_sun, branch_id, branch_name, other_branch_id, other_branch_name, register_type, comment_flag, is_commented, is_ielts_participant, ielts_result, manage_by, is_branching_auto, event_id, event_name, event_date, '$user_id', created_date, '$user_id', '$now', '$user_name', '$user_name' FROM r_student WHERE (is_delete IS NULL OR is_delete IS FALSE) AND manage_by='".$main->V['filter_bid']."' AND status IN  ('register','branching')";
            if(!$main->DBExec($query)){
                $data["result"] = "failed";
                $data["message"] = $main->db->error_msg;
                $main->G['ActionLog']->LogAuditTrail($main->V['filter_bid'], $action_desc, date("Y-m-d H:i:s"), $this->module_name, $data["result"], $data["message"]);
            } else {
                $query = "REPLACE INTO sysweb_status_audit (status_audit_id, record_id, action_date, table_name, status, action_by, action_from_ip, action_group) SELECT MD5(leads_id), leads_id, NOW(), 'f_student', '".$this->default_status."', '".$main->S['UserIdentity']->UserId."', '".XIP."', 'Follow Up' FROM r_student WHERE (is_delete IS NULL OR is_delete IS FALSE) AND manage_by='".$main->V['filter_bid']."' AND status IN ('register','branching')";
                if(!$main->DBExec($query)){
                    $data["result"] = "failed";
                    $data["message"] = $main->db->error_msg;
                        $main->G['ActionLog']->LogAuditTrail($main->V['filter_bid'], $action_desc, date("Y-m-d H:i:s"), $this->module_name, $data["result"], $data["message"]);
                    }
                else {
                    $query = "UPDATE r_student SET status='followup' WHERE manage_by='".$main->V['filter_bid']."' AND status IN ('register','branching')";
                    if(!$main->DBExec($query)){
                        $data["result"] = "failed";
                        $data["message"] = $main->db->error_msg;
                        $main->G['ActionLog']->LogAuditTrail($main->V['filter_bid'], $action_desc, date("Y-m-d H:i:s"), $this->module_name, $data["result"], $data["message"]);
                    } else {
                        $qcount = "SELECT COUNT(CASE WHEN comment_flag='hot' THEN leads_id ELSE NULL END) AS hot";
                        $qcount .= ", COUNT(CASE WHEN is_branching_auto IS FALSE AND manage_by IS NOT NULL AND manage_by<>'' THEN leads_id ELSE NULL END) AS malloc";
                        $qcount .= " FROM r_student WHERE (is_delete IS NULL OR is_delete IS FALSE) AND status IN ('register','branching')";
                        $rsc = $main->DBExec($qcount);
                        $data["recap_hot"] = ToMoneyFormat($rsc->fields["hot"]);
                        $data["recap_malloc"] = ToMoneyFormat($rsc->fields["malloc"]);
                        $main->G['ActionLog']->LogAuditTrail($main->V['filter_bid'], $action_desc, date("Y-m-d H:i:s"), $this->module_name, $data["result"]);
                    }
                }//eif
                }//eif
        }//eif
        $main->SendJSON($data);
    }//ef

}
