<?php

namespace App\Http\Controllers\Leads\Integration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

// Self
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
// use App\Http\Resources\Integration\Suntrack\SunEduWebCollection;
// use App\Http\Resources\Integration\Suntrack\SunEduWebResource;
use App\Http\Resources\Integration\Suntrack\SunEngWebCollection;
use App\Http\Resources\Integration\Suntrack\SunEngWebResource;
use App\Http\Resources\Integration\Suntrack\MasterDataEventRegistrationCollection;
use App\Http\Resources\Integration\Suntrack\MasterDataEventRegistrationResource;

// Sunmobile
use App\Remote\Sunmobile\User as SunmobileUser;

use App\Remote\Sunmobile\ApplyEvent as SunmobileApplyEvent;
use App\Http\Resources\Integration\Suntrack\SunmobileApplyEventResource;
use App\Http\Resources\Integration\Suntrack\SunmobileApplyEventCollection;

use App\Remote\Sunmobile\Apply as SunmobileApplyProgram;
use App\Http\Resources\Integration\Suntrack\SunmobileApplyProgramResource;
use App\Http\Resources\Integration\Suntrack\SunmobileApplyProgramCollection;

// Suntrack
use App\Remote\Suntrack\Lead as SuntrackLead;
use App\Remote\Suntrack\Branch as SuntrackBranch;
use App\Remote\Suntrack\PostalCode as SuntrackPostalCode;
use App\Http\Resources\Integration\Suntrack\SuntrackResource;
use App\Http\Resources\Integration\Suntrack\SuntrackCollection;

// Sunnies
use App\Model\Sunnies\FStudent as SunniesFStudent;
use App\Http\Resources\Integration\Suntrack\SunniesResource;
use App\Http\Resources\Integration\Suntrack\SunniesCollection;

class SuntrackController extends Controller
{
    public $results = [];

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
            'countRowsSunnies' => $this->setDataSunnies(null, null)->select('email','birth')->get()->count(),
            'countRowsMobileApp' => $this->setDataMobileAppApplyProgram($search, false, true)->select('email','birth')->get()->count(),
            'countRowsSunEduWeb' => 0,
            // 'countRowsSunEduWeb' => $this->setDataSunEduWeb($search)->select('email','birth')->get()->count(),
            'countRowsSunEngWeb' => $this->setDataSunEngWeb(null)->select('email','birth')->get()->count(),
            'countRowsEventWorkshop' => $this->setDataMasterDataEvent($search, 1)->select('email','birth')->get()->count(),
            'countRowsEventSeminar' => $this->setDataMasterDataEvent($search, 2)->select('email','birth')->get()->count(),
            'countRowsEventInfoSession' => $this->setDataMasterDataEvent($search, 3)->select('email','birth')->get()->count(),
            'countRowsEventSunEngEvent' => $this->setDataMasterDataEvent($search, 4)->select('email','birth')->get()->count(),
            'countRowsEventSunEngClass' => $this->setDataMasterDataEvent($search, 5)->select('email','birth')->get()->count(),
            'countRowsEventPartnerEvent' => $this->setDataMasterDataEvent($search, 6)->select('email','birth')->get()->count(),
            'countRowsEventSchoolExpo' => $this->setDataMasterDataEvent($search, 7)->select('email','birth')->get()->count(),
            'countRowsEventIndependent' => $this->setDataMasterDataEvent($search, 8)->select('email','birth')->get()->count(),
        ]);
    }

    public function allocateTo(Request $req){
        $req->validate([
            'leads_source' => 'required',
            'id' => 'required',
            // 'branch_uuid' => 'required',
        ]);

        switch($req->leads_source){
            case 'Sunnies':
                $lead = SunniesFStudent::find($req->id);
                if (!is_null($lead)) {
                    return response()->json($this->fromSunnies($lead, $req));
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

    public function allocateSelection(Request $req){
        $req->validate([
            'leads_source' => 'required',
            // 'initiate_to' => 'required',
        ]);

        return $req->all();

        $results = [];

        switch($req->leads_source){
            case 'Sunnies':
                $this->setDataSunnies(null,null)->chunk(100, function ($sunniesLeads) use ($req) {
                    foreach ($sunniesLeads as $sunniesLeads) {
                        $results[] = $this->fromSunnies($sunniesLeads, $req);
                    }
                });
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
                $masterDataEvents = $this->setDataMasterDataEvent(null, $req->event_type_id)->get();
                foreach($masterDataEvents as $masterDataEvent){
                    $results[] = $this->fromMasterDataEvent($masterDataEvent, $req);
                }
                break;

            default:
                break;
        }

        return response()->json($results);
    }

    public function allocateAll(Request $req){
        $req->validate([
            'leads_source' => 'required',
            // 'initiate_to' => 'required',
        ]);

        $results = [];

        switch($req->leads_source){
            case 'Sunnies':
                $this->setDataSunnies(null,null)->chunk(100, function ($sunniesLeads) use ($req) {
                    foreach ($sunniesLeads as $sunniesLeads) {
                        $this->results[] = $this->fromSunnies($sunniesLeads, $req);
                        // $results[] = $this->fromSunnies($sunniesLeads, $req);
                    }
                });
                break;

            case 'Sun Mobile App - Apply':
                $mobileAppApplyPrograms = $this->setDataMobileAppApplyProgram(null, false, true)->get();
                foreach($mobileAppApplyPrograms as $mobileAppApplyProgram){
                    $this->results[] = $this->fromMobileAppApplyProgram($mobileAppApplyProgram, $req);
                }
                break;

            case 'Sun Edu Web':
                $sunEduWebRegistrations = $this->setDataSunEduWeb(null)->get();
                foreach($sunEduWebRegistrations as $sunEduWebRegistration){
                    $this->results[] = $this->fromSunEduWeb($sunEduWebRegistration, $req);
                }
                break;

            case 'Sun Eng Web':
                $sunEngWebRegistrations = $this->setDataSunEngWeb()->get();
                foreach($sunEngWebRegistrations as $sunEngWebRegistration){
                    $this->results[] = $this->fromSunEngWeb($sunEngWebRegistration, $req);
                }
                break;

            case 'Master Data Event':
                $masterDataEvents = $this->setDataMasterDataEvent(null, $req->event_type_id)->get();
                foreach($masterDataEvents as $masterDataEvent){
                    $this->results[] = $this->fromMasterDataEvent($masterDataEvent, $req);
                }
                break;

            default:
                break;
        }

        return response()->json($this->results);
    }

    public function fromSunnies($leads, $req){
        if($req->has('branch_uuid')){
            $preferredBranch = $req->branch_uuid;
            $suntrackBranch = SuntrackBranch::find($req->branch_uuid);
            $branch_uuid = $req->branch_uuid;
        } else {
            $suntrackBranchCode = $this->getSuntrackBranchCode($leads->manage_by);
            if($suntrackBranchCode != ''){
                $preferredBranch = $suntrackBranchCode;
                $suntrackBranch = SuntrackBranch::where('branch_code', $suntrackBranchCode)->first();
                $branch_uuid = $suntrackBranch->branch_uuid;
            } else {
                if(!is_null($leads->zip_code) && !empty($leads->zip_code)){
                    $suntrackBranch = SuntrackBranch::whereRaw("FIND_IN_SET($leads->zip_code,branch_coverage)")->first();
                    if(is_null($suntrackBranch)){
                        return [
                            'success' => false,
                            'message' => 'Coverage Area ' . $leads->zip_code . ' Not Found',
                        ];
                    } else {
                        $preferredBranch = $suntrackBranch->branch_uuid;
                        $branch_uuid = $suntrackBranch->branch_uuid;
                    }
                } else {
                    return [
                        'success' => false,
                        'message' => 'Post Code not found',
                    ];
                }
            }
        }

        // Check if duplicated leads by email & dob
        if($this->checkDuplicated($leads->email, $leads->birth)){
            SunniesFStudent::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_suntrack_leads' => true]);

            return [
                'success' => false,
                'message' => 'Duplicated leads',
            ];
        }

        $suntrackLead = new SuntrackLead();
        $suntrackLead->leads_uuid = Str::uuid()->toString();
        $suntrackLead->leads_id = "LEADS." . date('y.m.d.His.') . str_pad(SuntrackLead::count() + 10, 4, 0, STR_PAD_LEFT);
        $suntrackLead->created_by = '885fb005-c9ed-4cd6-82a2-1f3efa5b95f0';
        $suntrackLead->branch_uuid = $branch_uuid;
        $suntrackLead->student_id = '';
        $suntrackLead->full_name = $leads->full_name;
        $suntrackLead->gender = $leads->gender == 'undefined' ? '' : $leads->gender;
        $suntrackLead->dob = $leads->birth;
        $suntrackLead->email = $leads->email;
        $suntrackLead->telephone = $leads->phone;
        $suntrackLead->mobile_phone = $leads->mobile;
        $suntrackLead->address = $leads->address;
        $suntrackLead->postcode = $leads->zip_code;
        $suntrackLead->postal_code_uuid = null;
        $suntrackLead->parents_name = $leads->parents_name;
        $suntrackLead->parents_phone = $leads->parent_mobile;
        $suntrackLead->marketing_source_type = '';
        $suntrackLead->marketing_source_online = '';
        $suntrackLead->marketing_source_offline = '';
        $suntrackLead->marketing_source_event = '';
        $suntrackLead->marketing_source_detail = '';
        $suntrackLead->marketing_source_note = '';
        $suntrackLead->type_student = '';
        $suntrackLead->type_student_value = '';
        $suntrackLead->type_student_note = '';
        $suntrackLead->intake = '';
        $suntrackLead->notes = 'Leads from Sunnies - Master Leads';
        $suntrackLead->profile_image = '';
        $suntrackLead->status = 'Unhandled';
        $suntrackLead->is_cancel = false;
        $suntrackLead->is_student = false;
        $suntrackLead->created_at = date('Y-m-d H:i:s');
        $suntrackLead->updated_at = date('Y-m-d H:i:s');
        $suntrackLead->is_sunnies_leads = true;

        if ($suntrackLead->save()) {
            $leads->is_suntrack_leads = true;
            $leads->save();

            SunniesFStudent::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_suntrack_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->birth;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = true;
            $leadsMD->is_sunnies = false;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $suntrackLead->leads_uuid;
                $leadsHistory->reference_type = 'suntrack';
                $leadsHistory->from = 'sunnies';
                $leadsHistory->to = 'suntrack';
                $leadsHistory->allocated_to = $suntrackBranch->branch_name;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Suntrack',
                'data' => $suntrackLead,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Suntrack',
            ];
        }
    }

    public function setDataSunnies($search = null, $filterByBranch = null){
        // Base Query
        $datas = SunniesFStudent::where('is_suntrack_leads', false);

        // Base Filter
        $datas->where('created_date', '>=', '2017');
        $datas->whereNotNull('manage_by');
        $datas->where('manage_by', '!=', '');
        $datas->whereNotNull('zip_code');
        $datas->where('zip_code', '!=', '');

        // Base Order
        $datas->orderBy('created_date','desc');

        // Search
        if(!is_null($search) && !empty($search)){
            $datas->where('full_name','like','%' . $search . '%');
        }

        // Filter By Branch
        if(!is_null($filterByBranch) && !empty($filterByBranch)){
            $datas->where('manage_by', $filterByBranch);
        }

        return $datas->select('*')->groupBy('email','birth');
    }

    public function getDataSunnies(Request $req){
        $search = '';
        if($req->has('search')){
            if(!empty($req->search)){
                $search = $req->search;
            }
        }

        $branch = '';
        if($req->has('filter_branch')){
            if(!empty($req->filter_branch)){
                $filterByBranch = $req->filter_branch;
                $suntrackBranch = SuntrackBranch::find($req->filter_branch)->branch_code;
                $branch = $this->getSunniesBranchCode($suntrackBranch);
            }
        }

        // $suntrackMail = SuntrackLead::select('email')->get()->pluck('email');
        // $datas = SunniesFStudent::whereNotIn('email', $suntrackMail);

        return new SunniesCollection($this->setDataSunnies($search, $branch)->take(100)->paginate(20));
    }

    public function getDataMobileApp(){

    }

    public function setDataMobileAppApplyProgram($search, $filterByBranch = false, $filterByPostCode = false){
        $datas = SunmobileApplyProgram::where('is_suntrack_leads', false);

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

        // Base Order
        $datas->orderBy('applies.created_at','desc');

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

    public function fromMobileAppApplyProgram($leads, $req){
        if($req->has('branch_uuid')){
            $preferredBranch = $req->branch_uuid;
            $suntrackBranch = SuntrackBranch::find($req->branch_uuid);
            $branch_uuid = $suntrackBranch->branch_uuid;
        } else {
            if(is_null($leads->zip_code) || empty($leads->zip_code)){
                return [
                    'success' => false,
                    'message' => 'Post code is null or empty',
                ];
            }

            $suntrackBranch = SuntrackBranch::whereRaw("FIND_IN_SET($leads->zip_code,branch_coverage)")->first();
            if(is_null($suntrackBranch)){
                return [
                    'success' => false,
                    'message' => 'Coverage Area ' . $leads->zip_code . ' Not Found',
                ];
            } else {
                $branch_uuid = $suntrackBranch->branch_uuid;
            }
        }

        $suntrackLead = new SuntrackLead();
        $suntrackLead->leads_uuid = Str::uuid()->toString();
        $suntrackLead->leads_id = "LEADS." . date('y.m.d.His.') . str_pad(SuntrackLead::count() + 1, 4, 0, STR_PAD_LEFT);
        $suntrackLead->created_by = '885fb005-c9ed-4cd6-82a2-1f3efa5b95f0';
        $suntrackLead->branch_uuid = $branch_uuid;
        $suntrackLead->student_id = '';
        $suntrackLead->full_name = $leads->full_name;
        $suntrackLead->gender = $leads->gender == 'undefined' ? '' : $leads->gender;
        $suntrackLead->dob = $leads->birth;
        $suntrackLead->email = $leads->email;
        $suntrackLead->telephone = $leads->phone;
        $suntrackLead->mobile_phone = $leads->mobile;
        $suntrackLead->address = $leads->address;
        $suntrackLead->postcode = $leads->zip_code;
        $suntrackLead->postal_code_uuid = null;
        $suntrackLead->parents_name = $leads->parents_name;
        $suntrackLead->parents_phone = $leads->parent_mobile;
        $suntrackLead->marketing_source_type = '';
        $suntrackLead->marketing_source_online = '';
        $suntrackLead->marketing_source_offline = '';
        $suntrackLead->marketing_source_event = '';
        $suntrackLead->marketing_source_detail = '';
        $suntrackLead->marketing_source_note = '';
        $suntrackLead->type_student = '';
        $suntrackLead->type_student_value = '';
        $suntrackLead->type_student_note = '';
        $suntrackLead->intake = '';
        $suntrackLead->notes = 'Leads from Mobile App Apply Program - Master Leads';
        $suntrackLead->profile_image = '';
        $suntrackLead->status = 'Unhandled';
        $suntrackLead->is_cancel = false;
        $suntrackLead->is_student = false;
        $suntrackLead->created_at = date('Y-m-d H:i:s');
        $suntrackLead->updated_at = date('Y-m-d H:i:s');
        $suntrackLead->is_sunnies_leads = true;
        // $suntrackLead->is_suntrack_leads = false;

        if ($suntrackLead->save()) {
            $leads->is_suntrack_leads = true;
            $leads->save();

            SunmobileApplyProgram::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_suntrack_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->birth;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = true;
            $leadsMD->is_sunnies = false;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $suntrackLead->leads_uuid;
                $leadsHistory->reference_type = 'suntrack';
                $leadsHistory->from = 'mobile-app-apply-program';
                $leadsHistory->to = 'suntrack';
                $leadsHistory->allocated_to = $suntrackBranch->branch_name;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Suntrack',
                'data' => $suntrackLead,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Suntrack',
            ];
        }
    }

    public function getDataMobileAppApplyExpo(){
        $datas = SunmobileApplyEvent::where('event_type','education-expo')->orderBy('created_at','desc')->paginate(10);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyWorkshop(){
        $datas = SunmobileApplyEvent::where('event_type','workshop')->orderBy('created_at','desc')->paginate(10);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyEventSeminar(){
        $datas = SunmobileApplyEvent::where('event_type','seminar')->orderBy('created_at','desc')->paginate(10);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataMobileAppApplyEventInfoSession(){
        $datas = SunmobileApplyEvent::where('event_type','info-session')->orderBy('created_at','desc')->paginate(10);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataSunEduWebGeneral(){
        $datas = Registration::whereIn('registration_type',['sun-edu-general-registration'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataSunEduWebApplyProgram(){
        $datas = Registration::whereIn('registration_type',['sun-edu-apply-program'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function setDataSunEngWeb($search = null){
        $datas = Registration::where('is_suntrack_leads', false)->whereIn('registration_type', ['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-intl-ielts','sun-eng-intl-toefl']);

        // Where address not null
        $datas->whereNotNull('branch_id')->where('branch_id','!=','');
        // $datas->whereNotNull('zip_code')->where('zip_code','!=','');
        // $datas->whereNotNull('precur_school')->where('precur_school','!=','');
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

    public function getDataSunEngWeb(Request $req){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new SunEngWebCollection($this->setDataSunEngWeb($search)->paginate(20));
    }

    public function fromSunEngWeb($leads, $req){
        if($req->has('branch_uuid')){
            $preferredBranch = $req->branch_uuid;
            $suntrackBranch = SuntrackBranch::find($req->branch_uuid);
            $branch_uuid = $suntrackBranch->branch_uuid;
        } else {
            // Filter By Branch
            $masterDataBranch = MasterDataBranch::find($this->branch_id);
            if(!is_null($masterDataBranch)){
                $suntrackBranch = SuntrackBranch::where('branch_code', $masterDataBranch->branch_code)->first();
                if(!is_null($suntrackBranch)){
                    $branch_uuid = $suntrackBranch->branch_uuid;
                } else {
                    return [
                        'success' => false,
                        'message' => 'Branch UUID with code ' . $masterDataBranch->branch_code . ' not found',
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Branch UUID with code ' . $masterDataBranch->branch_code . ' not found',
                ];
            }
        }

        $suntrackLead = new SuntrackLead();
        $suntrackLead->leads_uuid = Str::uuid()->toString();
        $suntrackLead->leads_id = "LEADS." . date('y.m.d.His.') . str_pad(SuntrackLead::count() + 1, 4, 0, STR_PAD_LEFT);
        $suntrackLead->created_by = '885fb005-c9ed-4cd6-82a2-1f3efa5b95f0';
        $suntrackLead->branch_uuid = $branch_uuid;
        $suntrackLead->student_id = '';
        $suntrackLead->full_name = $leads->full_name;
        $suntrackLead->gender = $leads->gender;
        $suntrackLead->dob = $leads->birth;
        $suntrackLead->email = $leads->email;
        $suntrackLead->telephone = $leads->phone;
        $suntrackLead->mobile_phone = $leads->mobile;
        $suntrackLead->address = $leads->address;
        $suntrackLead->postcode = $leads->zip_code;
        $suntrackLead->postal_code_uuid = null;
        $suntrackLead->parents_name = $leads->parents_name;
        $suntrackLead->parents_phone = $leads->parent_mobile;
        $suntrackLead->marketing_source_type = '';
        $suntrackLead->marketing_source_online = '';
        $suntrackLead->marketing_source_offline = '';
        $suntrackLead->marketing_source_event = '';
        $suntrackLead->marketing_source_detail = '';
        $suntrackLead->marketing_source_note = '';
        $suntrackLead->type_student = '';
        $suntrackLead->type_student_value = '';
        $suntrackLead->type_student_note = '';
        $suntrackLead->intake = '';
        $suntrackLead->notes = 'Leads from Sun English Web - Master Leads';
        $suntrackLead->profile_image = '';
        $suntrackLead->status = 'Unhandled';
        $suntrackLead->is_cancel = false;
        $suntrackLead->is_student = false;
        $suntrackLead->created_at = date('Y-m-d H:i:s');
        $suntrackLead->updated_at = date('Y-m-d H:i:s');
        $suntrackLead->is_sunnies_leads = true;
        // $suntrackLead->is_suntrack_leads = false;

        if ($suntrackLead->save()) {
            $leads->is_suntrack_leads = true;
            $leads->save();

            Registration::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_suntrack_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->birth;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = true;
            $leadsMD->is_sunnies = false;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $suntrackLead->leads_uuid;
                $leadsHistory->reference_type = 'suntrack';
                $leadsHistory->from = 'sun-eng-web';
                $leadsHistory->to = 'suntrack';
                $leadsHistory->allocated_to = $suntrackBranch->branch_name;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Suntrack',
                'data' => $suntrackLead,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Suntrack',
            ];
        }
    }

    public function getDataSunEngWebGeneral(){
        $datas = Registration::whereIn('registration_type',['sun-eng-general-registration'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataSunEngWebApplyProgram(){
        $datas = Registration::whereIn('registration_type',['sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
    }

    public function getDataSunEngWebInternational(){
        $datas = Registration::whereIn('registration_type',['sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);
        return new SunmobileApplyEventCollection($datas);
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

    public function setDataMasterDataEvent($search = null, $event_type_id){
        $datas = EventRegistration::where('event_registrations.is_suntrack_leads', false)
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
        if(!is_null($search) && !empty($search)){
            $datas->where('event_registrations.full_name','LIKE','%' . $search . '%');
        }

        // Distinct email & dob
        $datas->groupBy('email','birth');

        return $datas;
    }

    public function getDataMasterDataEvent(Request $req, $event_type_id){
        if($req->has('search')){
            if(!is_null($req->search) && !empty($req->search) && $req->search != 'undefined'){
                $search = $req->search;
            } else {
                $search = null;
            }
        } else {
            $search = null;
        }

        return new MasterDataEventRegistrationCollection($this->setDataMasterDataEvent($search, $event_type_id)->paginate(20));
    }

    public function fromMasterDataEvent($leads, $req){
        if($req->has('branch_uuid')){
            $preferredBranch = $req->branch_uuid;
            $suntrackBranch = SuntrackBranch::find($req->branch_uuid);
            $branch_uuid = $suntrackBranch->branch_uuid;
        } else {
            if(is_null($leads->zip_code) || empty($leads->zip_code)){
                return [
                    'success' => false,
                    'message' => 'Post code is null or empty',
                ];
            }

            $suntrackBranch = SuntrackBranch::whereRaw("FIND_IN_SET($leads->zip_code,branch_coverage)")->first();
            if(is_null($suntrackBranch)){
                return [
                    'success' => false,
                    'message' => 'Coverage Area ' . $leads->zip_code . ' Not Found',
                ];
            } else {
                $branch_uuid = $suntrackBranch->branch_uuid;
            }
        }

        $suntrackLead = new SuntrackLead();
        $suntrackLead->leads_uuid = Str::uuid()->toString();
        $suntrackLead->leads_id = "LEADS." . date('y.m.d.His.') . str_pad(SuntrackLead::count() + 1, 4, 0, STR_PAD_LEFT);
        $suntrackLead->created_by = '885fb005-c9ed-4cd6-82a2-1f3efa5b95f0';
        $suntrackLead->branch_uuid = $branch_uuid;
        $suntrackLead->student_id = '';
        $suntrackLead->full_name = $leads->full_name;
        $suntrackLead->gender = $leads->gender;
        $suntrackLead->dob = $leads->birth;
        $suntrackLead->email = $leads->email;
        $suntrackLead->telephone = $leads->phone;
        $suntrackLead->mobile_phone = $leads->mobile;
        $suntrackLead->address = $leads->address;
        $suntrackLead->postcode = $leads->zip_code;
        $suntrackLead->postal_code_uuid = null;
        $suntrackLead->parents_name = $leads->parents_name;
        $suntrackLead->parents_phone = $leads->parent_mobile;
        $suntrackLead->marketing_source_type = '';
        $suntrackLead->marketing_source_online = '';
        $suntrackLead->marketing_source_offline = '';
        $suntrackLead->marketing_source_event = '';
        $suntrackLead->marketing_source_detail = '';
        $suntrackLead->marketing_source_note = '';
        $suntrackLead->type_student = '';
        $suntrackLead->type_student_value = '';
        $suntrackLead->type_student_note = '';
        $suntrackLead->intake = '';
        $suntrackLead->notes = 'Leads from Master Data Event - Master Leads';
        $suntrackLead->profile_image = '';
        $suntrackLead->status = 'Unhandled';
        $suntrackLead->is_cancel = false;
        $suntrackLead->is_student = false;
        $suntrackLead->created_at = date('Y-m-d H:i:s');
        $suntrackLead->updated_at = date('Y-m-d H:i:s');
        $suntrackLead->is_sunnies_leads = true;
        // $suntrackLead->is_suntrack_leads = false;

        if ($suntrackLead->save()) {
            $leads->is_suntrack_leads = true;
            $leads->save();

            Registration::where('email', $leads->email)->where('birth', $leads->birth)->update(['is_suntrack_leads' => true]);

            $leadsMD = new MasterDataLead();
            $leadsMD->full_name = $leads->full_name;
            $leadsMD->email = $leads->email;
            $leadsMD->dob = $leads->birth;
            $leadsMD->gender = $leads->gender;
            $leadsMD->mobile = $leads->mobile;
            $leadsMD->address = $leads->address;
            $leadsMD->is_suntrack = true;
            $leadsMD->is_sunnies = false;
            if($leadsMD->save()){
                $leadsHistory = new MasterDataLeadHistory();
                $leadsHistory->leads_uuid = $leadsMD->leads_uuid;
                $leadsHistory->reference_id = $suntrackLead->leads_uuid;
                $leadsHistory->reference_type = 'suntrack';
                $leadsHistory->from = 'master-data-event';
                $leadsHistory->to = 'suntrack';
                $leadsHistory->allocated_to = $suntrackBranch->branch_name;
                $leadsHistory->save();
            }

            return [
                'success' => true,
                'message' => 'Successfully add data to Suntrack',
                'data' => $suntrackLead,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error add data to Suntrack',
            ];
        }
    }

    public function getSuntrackBranchCode($branch_code){
        $branches = [
            // SUNTRACK => SUNNIES
            'LMPG' => 'LAM',            //	Lampung
            'ALSUT' => 'AS',            //	Alam Sutera
            'KG' => 'KGB',              //	Kelapa Gading Barat
            'TD' => 'TD',               //	Tanjung Duren
            'SMR' => 'SMG',             //	Semarang
            'PI' => 'PI',               //	Pondok Indah
            'BDG' => 'BDG',             //	Bandung
            'SRB' => 'SBB',             //	Surabaya Barat
            'BALI' => 'BL',             //	Bali
            'MKS' => 'MKS',             //	Makassar
            'STC' => 'STC',             //	Senayan Trade Center
            'PKB' => 'PKU',             //	Pekanbaru
            'KG' => 'KGT',              //	Kelapa Gading Timur
            'KJ' => 'KJ',               //	Kebon Jeruk
            'SBYTM' => 'SBT',           //	Surabaya Timur
            'PLUIT' => 'PL',            //	Pluit
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

    public function checkDuplicated($email, $dob){
        $lead = SuntrackLead::where('email',$email)->where('dob', $dob)->first();
        if(!is_null($lead)){
            return true;
        } else {
            return false;
        }
    }
}
