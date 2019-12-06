<?php

namespace App\Http\Controllers\Leads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Cache;

// Sunnies
use App\RStudentRemote;
use App\FStudentRemote;
use App\SyswebFormatCodeRemote;

// Suntrack
use App\Remote\Suntrack\Lead as SuntrackLead;

// Sunmobile
use App\Remote\Sunmobile\Apply as SunmobileApply;
use App\Remote\Sunmobile\ApplyEvent as SunmobileApplyEvent;
use App\Remote\Sunmobile\User as SunmobileUser;

// Self
use App\Registration;
use App\Form;
use App\EventRegistration;
use App\EventType;

use DB;

class LeadsController extends Controller
{
    public function getAll(Request $request)
    {
        $search = $request->search;
        $count = $this->getCount();
        $type = '';

        $leads = $this->getDataSunnies($search);
        return view('pages.leads.index', compact('leads', 'type', 'count'));
    }

    public function getByType($type, Request $request)
    {
        $search = $request->search;

        switch ($type) {
            case 'sunnies':
                $leads = $this->getDataSunnies($search);
                break;

            case 'suntrack':
                $leads = $this->getDataSuntrack($search);
                break;

            case 'mobileapp':
                $leads = $this->getDataMobileApp($search);
                break;

            case 'android':
                $leads = $this->getDataAndroid($search);
                break;

            case 'ios':
                $leads = $this->getDataIOS($search);
                break;

            case 'sun-edu-web':
                $leads = $this->getDataSunEduWeb($search);
                break;

            case 'sun-eng-web':
                $leads = $this->getDataSunEngWeb($search);
                break;

                // case 'workshop':
                //     $leads = $this->getDataWorkshop($search);
                //     break;

                // case 'seminar':
                //     $leads = $this->getDataSeminar($search);
                //     break;

                // case 'info-session':
                //     $leads = $this->getDataInfoSession($search);
                //     break;

                // case 'sun-eng-event':
                //     $leads = $this->getDataInfoSession($search);
                //     break;

                // case 'Sun-eng-class':
                //     $leads = $this->getDataInfoSession($search);
                //     break;

                // case 'partner-event':
                //     $leads = $this->getDataInfoSession($search);
                //     break;

                // case 'school-expo':
                //     $leads = $this->getDataInfoSession($search);
                //     break;
            case 'event-all':
                $leads = EventRegistration::paginate(20);
                // dd($leads);
                break;

            case 'workshop':
                $leads = EventType::where('event_type_name', 'Workshop')
                    ->first()->eventRegistration()->paginate(20);
                // dd($leads);
                break;

            case 'seminar':
                $leads = EventType::where('event_type_name', 'Seminar')
                    ->first()->eventRegistration()->paginate(20);
                break;

            case 'info-session':
                $leads = EventType::where('event_type_name', 'Info Session')
                    ->first()->eventRegistration()->paginate(20);
                break;

            case 'sun-eng-event':
                $leads = EventType::where('event_type_name', 'Sun Eng Event')
                    ->first()->eventRegistration()->paginate(20);
                break;

            case 'sun-eng-class':
                $leads = EventType::where('event_type_name', 'Sun Eng Class')
                    ->first()->eventRegistration()->paginate(20);
                break;

            case 'partner-event':
                $leads = EventType::where('event_type_name', 'Partner Event')
                    ->first()->eventRegistration()->paginate(20);
                break;

            case 'school-expo':
                $leads = EventType::where('event_type_name', 'School Expo')
                    ->first()->eventRegistration()->paginate(20);
                break;

            default:
                return back();
        }

        $count = $this->getCount();
        return view('pages.leads.index', compact('leads', 'type', 'count'));
    }

    public function getByID($type, $id)
    {
        switch ($type) {
            case 'sunnies':
                $lead = FStudentRemote::find($id);
                break;

            case 'suntrack':
                $lead = SuntrackLead::where('leads_id', $id)->first();
                break;

            case 'mobileapp':
                $lead = SunmobileApply::find($id);
                // dd($lead);
                break;

            case 'android':
                $lead = SunmobileUser::find($id);
                break;

            case 'ios':
                $lead = SunmobileUser::find($id);
                break;

            case 'sun-edu-web':
                $lead = Registration::find($id);
                break;

            case 'sun-eng-web':
                $lead = Registration::find($id);
                break;

                // case 'workshop':
                //     $lead = SunmobileApplyEvent::find($id);
                //     break;

            case 'workshop':
                $lead = EventRegistration::find($id);
                break;

            case 'seminar':
                $lead = SunmobileApplyEvent::find($id);
                break;

            case 'seminar':
                $lead = EventRegistration::find($id);
                break;

                // case 'info-session':
                //     $lead = SunmobileApplyEvent::find($id);
                //     break;

            case 'info-session':
                $lead = EventRegistration::find($id);
                break;

            default:
                return back();
        }
        // dd($lead);
        $disabled = true;
        $count = $this->getCount();
        return view('pages.leads.detail', compact('lead', 'type', 'count', 'disabled'));
    }

    public function getCount()
    {

        // $cacheName = 'leads.count.all';

        // if(Cache::has($cacheName)){
        //     return Cache::get($cacheName);
        // } else {


        $data = [
            'sunnies' => FStudentRemote::count(),
            'suntrack' => SuntrackLead::count(),
            'mobileapp' => SunmobileApply::count(),
            // 'android' => SunmobileUser::count(),
            // 'ios' => SunmobileUser::count(),
            // 'sun-edu-web-general' => 0,
            // 'sun-edu-web-apply' => 0,
            // 'sun-eng-web-general' => 0,
            'sun-edu-web' => Registration::whereIn('registration_type', ['sun-edu-general-registration', 'sun-edu-apply-program', 'sun-edu-info-session', 'sun-edu-seminar', 'sun-edu-workshop'])->count(),
            'sun-eng-web' => Registration::whereIn('registration_type', ['sun-eng-general-registration', 'sun-eng-ielts', 'sun-eng-toefl', 'sun-eng-gmat', 'sun-eng-gre', 'sun-eng-sat', 'sun-eng-pte', 'sun-eng-general-english', 'sun-eng-conversation', 'sun-eng-business', 'sun-eng-versant', 'sun-eng-info-session', 'sun-eng-seminar', 'sun-eng-workshop', 'sun-eng-intl-ielts', 'sun-eng-intl-toefl'])->count(),
            // 'workshop' => SunmobileApplyEvent::where('event_type','workshop')->count(),
            // 'seminar' => SunmobileApplyEvent::where('event_type','seminar')->count(),
            // 'info-session' => SunmobileApplyEvent::where('event_type','info-session')->count(),
            'event' => EventRegistration::count(),
            'workshop' => EventType::where('event_type_name', 'Workshop')->first()->eventRegistration()->count(),
            'seminar' => EventType::where('event_type_name', 'Seminar')->first()->eventRegistration()->count(),
            'info-session' => EventType::where('event_type_name', 'Info Session')->first()->eventRegistration()->count(),
            'sun-eng-event' => EventType::where('event_type_name', 'Sun Eng Event')->first()->eventRegistration()->count(),
            'Sun-eng-class' => EventType::where('event_type_name', 'Sun Eng Class')->first()->eventRegistration()->count(),
            'partner-event' => EventType::where('event_type_name', 'Partner Event')->first()->eventRegistration()->count(),
            'school-expo' => EventType::where('event_type_name', 'School Expo')->first()->eventRegistration()->count(),
        ];




        // Cache::remember($cacheName, 3600, function() use ($data){
        //     return $data;
        // });

        return $data;
        // }


        // $data = [
        //     'sunnies' => FStudentRemote::count(),
        //     'suntrack' => SuntrackLead::count(),
        //     'mobileapp' => SunmobileUser::count(),
        //     // 'android' => SunmobileUser::count(),
        //     // 'ios' => SunmobileUser::count(),
        //     // 'sun-edu-web-general' => 0,
        //     // 'sun-edu-web-apply' => 0,
        //     // 'sun-eng-web-general' => 0,
        //     'sun-edu-web' => Registration::whereIn('registration_type',['sun-edu-general-registration','sun-edu-apply-program','sun-edu-info-session','sun-edu-seminar','sun-edu-workshop'])->count(),
        //     'sun-eng-web' => Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->count(),
        //     // 'workshop' => ::where('category','Workshop')->count(),

        //     'workshop' => DB::table('eventregistration')
        //         ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
        //         ->where('forms.category', 'Workshop')
        //         ->count(),

        //     'seminar' => DB::table('eventregistration')
        //         ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
        //         ->where('forms.category', 'Seminar')
        //         ->count(),

        //     'info-session' => DB::table('eventregistration')
        //         ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
        //         ->where('forms.category', 'Info Session')
        //         ->count(),
        // ];

        // Cache::remember($cacheName, 3600, function() use ($data){
        //     return $data;
        // });

        return $data;
    }

    public function getDataSunnies($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-sunnies-' . $currentPage;
        $cache = Cache::get($cacheName);

        if ($search != null) {
            $leads = FStudentRemote::where("full_name", "like", "%{$search}%")
                ->orwhere("address", "like", "%{$search}%")
                ->orwhere("email", "like", "%{$search}%")
                ->paginate(20);
            // dd($leads);
            return $leads;
        } elseif ($cache) {
            return $cache;
        } else {
            // if(!is_null($search)){
            //     return FStudentRemote::orderBy('created_date', 'desc')->where('full_name','LIKE','%' . $search . '%')->paginate(20);
            // } else {
            // return FStudentRemote::orderBy('created_date', 'desc')->paginate(20);
            // }
            $leads = Cache::remember($cacheName, 3600, function () {
                return FStudentRemote::orderBy('created_date', 'desc')->paginate(20);
            });

            return $leads;
            // $value = Cache::remember('users', $seconds, function () {
            //     return FStudentRemote::orderBy('created_date', 'desc')->paginate(20);
            // });
        }
    }

    public function getDataSuntrack($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-suntrack-' . $currentPage;

        if ($search != null) {
            $leads = SuntrackLead::where("full_name", "like", "%{$search}%")
                ->orwhere("address", "like", "%{$search}%")
                ->orwhere("email", "like", "%{$search}%")
                ->paginate(20);
            // dd($leads);
            return $leads;
        } elseif (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            $leads = SuntrackLead::orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }
    }

    public function getDataMobileApp($search = null)
    {
        // $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // $cacheName = 'leads-mobileapp-' . $currentPage;

        // if(Cache::has($cacheName)){
        //     return Cache::get($cacheName);
        // } else {

        if ($search != null) {
            $leads = SunmobileApply::where("full_name", "like", "%{$search}%")
                ->orwhere("address", "like", "%{$search}%")
                ->orwhere("email", "like", "%{$search}%")
                ->paginate(20);
            return $leads;
        } else {
            $leads = SunmobileApply::orderBy('created_at', 'desc')->paginate(20);
            // dd($leads);
            return $leads;
        }
        // Cache::remember($cacheName, 3600, function() use ($leads){
        //     return $leads;
        // });

        // }

        // return SunmobileUser::join('user_f_c_m_tokens','user_f_c_m_tokens.user_id','users.id')->select('users.*','user_f_c_m_tokens.device_type as device_type')->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getDataAndroid($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-android-' . $currentPage;
        if ($search != null) {
            $leads = SunmobileUser::where("full_name", "like", "%{$search}%")
                ->orwhere("address", "like", "%{$search}%")
                ->orwhere("email", "like", "%{$search}%")
                ->paginate(20);
            // dd($leads);
            return $leads;
        } elseif (Cache::has($cacheName)) {
            return Cache::get($cacheName);
            dd($leads);
        } else {
            $leads = SunmobileUser::leftJoin('user_f_c_m_tokens', 'user_f_c_m_tokens.user_id', 'users.id')->select('users.*', 'user_f_c_m_tokens.device_type as device_type')->where('marketing_source_id', 63)->orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }

        // return SunmobileUser::join('user_f_c_m_tokens','user_f_c_m_tokens.user_id','users.id')->select('users.*','user_f_c_m_tokens.device_type as device_type')->where('marketing_source_id', 63)->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getDataIOS($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-ios-' . $currentPage;

        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            $leads = SunmobileUser::leftJoin('user_f_c_m_tokens', 'user_f_c_m_tokens.user_id', 'users.id')->select('users.*', 'user_f_c_m_tokens.device_type as device_type')->where('marketing_source_id', 62)->orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }

        // return SunmobileUser::join('user_f_c_m_tokens','user_f_c_m_tokens.user_id','users.id')->select('users.*','user_f_c_m_tokens.device_type as device_type')->where('marketing_source_id', 62)->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getDataSunEduWeb($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-suneduweb-' . $currentPage;

        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            $leads = Registration::whereIn('registration_type', ['sun-edu-general-registration', 'sun-edu-apply-program', 'sun-edu-info-session', 'sun-edu-seminar', 'sun-edu-workshop'])->orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }

        // return Registration::whereIn('registration_type',['sun-edu-general-registration','sun-edu-apply-program','sun-edu-info-session','sun-edu-seminar','sun-edu-workshop'])->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getDataSunEngWeb($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-sunengweb-' . $currentPage;

        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            $leads = Registration::whereIn('registration_type', ['sun-eng-general-registration', 'sun-eng-ielts', 'sun-eng-toefl', 'sun-eng-gmat', 'sun-eng-gre', 'sun-eng-sat', 'sun-eng-pte', 'sun-eng-general-english', 'sun-eng-conversation', 'sun-eng-business', 'sun-eng-versant', 'sun-eng-info-session', 'sun-eng-seminar', 'sun-eng-workshop', 'sun-eng-intl-ielts', 'sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }

        // return Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getDataWorkshop($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-workshop-' . $currentPage;

        // if(Cache::has($cacheName)){
        //     return Cache::get($cacheName);
        // } else {
        //     $leads = SunmobileApplyEvent::where('event_type','workshop')->orderBy('created_at','desc')->paginate(20);

        //     Cache::remember($cacheName, 3600, function() use ($leads){
        //         return $leads;
        //     });

        //     return $leads;
        // }

        $leads =  DB::table('eventregistration')
            ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
            ->select('eventregistration.studentName', 'forms.category', 'forms.name', 'eventregistration.mobilePhone', 'eventregistration.email', 'eventregistration.id')
            ->get();

        return $leads;

        // return Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);
        // return SunmobileApplyEvent::where('event_type','workshop')->orderBy('created_at','desc')->paginate(20);
    }

    public function getDataSeminar($search = null)
    {
        // $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // $cacheName = 'leads-seminar-' . $currentPage;

        // if(Cache::has($cacheName)){
        //     return Cache::get($cacheName);
        // } else {
        //     $leads = SunmobileApplyEvent::where('event_type','seminar')->orderBy('created_at','desc')->paginate(20);

        //     Cache::remember($cacheName, 3600, function() use ($leads){
        //         return $leads;
        //     });

        //     return $leads;
        // }

        $leads =  DB::table('eventregistration')
            ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
            ->select('eventregistration.studentName', 'forms.category', 'forms.name', 'eventregistration.mobilePhone', 'eventregistration.email', 'eventregistration.id')
            ->get();

        return $leads;


        // return Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);
        // return SunmobileApplyEvent::where('event_type','seminar')->orderBy('created_at','desc')->paginate(20);
    }

    public function getDataInfoSession($search = null)
    {
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $cacheName = 'leads-infosession-' . $currentPage;

        if (Cache::has($cacheName)) {
            return Cache::get($cacheName);
        } else {
            $leads = SunmobileApplyEvent::where('event_type', 'info-session')->orderBy('created_at', 'desc')->paginate(20);

            Cache::remember($cacheName, 3600, function () use ($leads) {
                return $leads;
            });

            return $leads;
        }


        // $leads =  DB::table('eventregistration')
        //         ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
        //         ->select('eventregistration.studentName', 'forms.category', 'forms.name', 'eventregistration.mobilePhone', 'eventregistration.email', 'eventregistration.id')
        //         ->get();

        //     return $leads;

        // return Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->orderBy('created_at', 'desc')->paginate(20);
        // return SunmobileApplyEvent::where('event_type','info-session')->orderBy('created_at','desc')->paginate(20);
    }

    public function searchData(Request $req)
    {
        $req->validate([
            'search' => 'required',
            'type' => 'required',
        ]);
        return $this->getByType($req->type, $req->search);
    }

    // For Master Data Integration
    public function syncToSunnies(Request $req)
    {
        // switch($type){
        //     case 'suntrack':
        $leads = SuntrackLead::find($req->id);
        if (!is_null($leads)) {

            $syswebFormatCode = SyswebFormatCodeRemote::where('format_name', 'Leads ID')->first();

            // Generate Leads ID
            $leads_id = 'LEADS' . date('y.m.d.') . $syswebFormatCode->last_number;

            $newLeads = new RStudentRemote();
            $newLeads->leads_id = $leads_id;
            // $newLeads->student_id = null;
            // $newLeads->status = null;
            // $newLeads->tags = null;
            // $newLeads->register_id = null;
            $newLeads->parents_name = $leads->parents_name;
            $newLeads->parents_mobile = $leads->parents_phone;
            $newLeads->full_name = $leads->full_name;
            // $newLeads->nick_name = '';
            $newLeads->address = $leads->address;
            $newLeads->zip_code = $leads->postcode;
            // $newLeads->kelurahan = '';
            // $newLeads->kecamatan = '';
            // $newLeads->dt2 = '';
            // $newLeads->kabupaten = '';
            // $newLeads->provinsi = '';
            $newLeads->phone = $leads->telephone;
            $newLeads->mobile = $leads->mobile_phone;
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
            // $newLeads->register_type = null;
            // $newLeads->comment_flag = null;
            // $newLeads->is_commented = null;
            // $newLeads->is_ielts_participant = null;
            // $newLeads->ielts_result = null;
            // $newLeads->manage_by = null;
            // $newLeads->is_branching_auto = null;
            // $newLeads->event_id = null;
            // $newLeads->event_name = null;
            // $newLeads->event_date = null;
            // $newLeads->is_delete = null;
            // $newLeads->pict_profile = null;
            // $newLeads->created_by = null;
            // $newLeads->created_date = null;
            // $newLeads->modified_by = null;
            // $newLeads->modified_date = null;
            // $newLeads->created_by_name = null;
            // $newLeads->modified_by_name = null;
            $newLeads->gender = $leads->gender;

            if ($newLeads->save()) {
                // return response()->json($syswebFormatCode);
                $syswebFormatCode->last_number = $syswebFormatCode->last_number + 1;
                $syswebFormatCode->save();

                response()->json([
                    'success' => true,
                    'message' => 'Successfully add data to Sunnies',
                ]);
            } else {
                response()->json([
                    'success' => false,
                    'message' => 'Error add data to Sunnies',
                ]);
            }
            //     }

            //     break;

            // default:
            //     break;
        }
    }
}
