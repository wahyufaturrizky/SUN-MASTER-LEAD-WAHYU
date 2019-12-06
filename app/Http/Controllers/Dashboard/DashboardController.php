<?php

namespace App\Http\Controllers\Dashboard;

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

use DB;

class DashboardController extends Controller
{
    public $baseModel;

    public function index(){


        $count = $this->getCount();
        // return view('pages.leads.detail', compact('lead','type','count','disabled'));
        return view('pages.dashboard.index', compact('count'));
    }


    public function getCount(){
        $cacheName = 'leads.count.all';

        // if(Cache::has($cacheName)){
        //     return Cache::get($cacheName);
        // }
        // else {
            $data = [
                'sunnies' => FStudentRemote::count(),
                'suntrack' => SuntrackLead::count(),
                'mobileapp' => SunmobileUser::count(),
                // 'android' => SunmobileUser::count(),
                // 'ios' => SunmobileUser::count(),
                // 'sun-edu-web-general' => 0,
                // 'sun-edu-web-apply' => 0,
                // 'sun-eng-web-general' => 0,
                'sun-edu-web' => Registration::whereIn('registration_type',['sun-edu-general-registration','sun-edu-apply-program','sun-edu-info-session','sun-edu-seminar','sun-edu-workshop'])->count(),
                'sun-eng-web' => Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->count(),

                // 'workshop' => DB::table('eventregistration')
                // ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
                // ->where('forms.category', 'Workshop')
                // ->count(),

                // 'seminar' => DB::table('eventregistration')
                //     ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
                //     ->where('forms.category', 'Seminar')
                //     ->count(),

                // 'info-session' => DB::table('eventregistration')
                //     ->join('forms', 'forms.form_id', '=', 'eventregistration.form_id')
                //     ->where('forms.category', 'Info Session')
                //     ->count(),
            ];

            Cache::remember($cacheName, 3600, function() use ($data){
                return $data;
            });

            return $data;
        // }
    }

    public function baseModel($name = null){
        switch($name){
            // for Sunnies
            case 'sunnies':
                $this->baseLeads = 'xxx';
                break;

            // for Suntrack
            case 'suntrack':
                $this->baseLeads = 'xxx';
                break;

            // for Mobile App
            case 'mobileapp':
                $this->baseLeads = 'xxx';
                break;

            // for Sun Edu Web
            case 'suneduweb':
                $this->baseLeads = 'xxx';
                break;

            // for Sun Eng Web
            case 'sunengweb':
                $this->baseLeads = 'xxx';
                break;

            // for Workshop
            case 'workshop':
                $this->baseLeads = 'xxx';
                break;

            // for Seminar
            case 'seminar':
                $this->baseLeads = 'xxx';
                break;

            // for Info Session
            case 'infosession':
                $this->baseLeads = 'xxx';
                break;

            default:
                // code to be executed if n is different from all labels;
        }
        // for Sunnies
        // for Suntrack
        // for Mobile App
        // for Sun Edu Web
        // for Sun Eng Web
        // for Workshop
        // for Seminar
        // for Info Session
    }

    public function getDataOverview(Request $req){
        if ($data = Redis::get('dashboard.overview.all')) {
            $data = json_decode($data);
            return response()->json($data);
        }

        $appName = [
            'Sunnies',
            'Suntrack',
            'Mobile App',
            'Sun Edu Web',
            'Sun Eng Web',
            'Workshop',
            'Seminar',
            'Info Session',
        ];

        for($i=1; $i <= 12 ; $i++) {
            $countSunnies[] = RStudentRemote::whereYear('created_date', '2019')->whereMonth('created_date', (String) $i)->count();
            $countSuntrack[] = SuntrackLead::whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countMobileApp[] = SunmobileUser::whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countSunEduWeb[] = Registration::whereIn('registration_type',['sun-edu-general-registration','sun-edu-apply-program','sun-edu-info-session','sun-edu-seminar','sun-edu-workshop'])->whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countSunEngWeb[] = Registration::whereIn('registration_type',['sun-eng-general-registration','sun-eng-ielts','sun-eng-toefl','sun-eng-gmat','sun-eng-gre','sun-eng-sat','sun-eng-pte','sun-eng-general-english','sun-eng-conversation','sun-eng-business','sun-eng-versant','sun-eng-info-session','sun-eng-seminar','sun-eng-workshop','sun-eng-intl-ielts','sun-eng-intl-toefl'])->whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countWorkshop[] = SunmobileApplyEvent::where('event_type','workshop')->whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countSeminar[] = SunmobileApplyEvent::where('event_type','seminar')->whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
            $countInfoSession[] = SunmobileApplyEvent::where('event_type','info-session')->whereYear('created_at', '2019')->whereMonth('created_at', (String) $i)->count();
        }

        $dataSetsSunnies = [
            'label' => 'Sunnies',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countSunnies,
        ];

        $dataSetsSuntrack = [
            'label' => 'Suntrack',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countSuntrack,
        ];

        $dataSetsMobileApp = [
            'label' => 'Mobile App',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countMobileApp,
        ];

        $dataSetsSunEduWeb = [
            'label' => 'Sun Edu Web',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countSunEduWeb,
        ];

        $dataSetsSunEngWeb = [
            'label' => 'Sun Eng Web',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countSunEngWeb,
        ];

        $dataSetsWorkshop = [
            'label' => 'Workshop',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countWorkshop,
        ];

        $dataSetsSeminar = [
            'label' => 'Seminar',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countSeminar,
        ];

        $dataSetsInfoSession = [
            'label' => 'Info Session',
            'fill' => true,
            'backgroundColor' => 'rgba(66,165,245,.75)',
            'borderColor' => 'rgba(66,165,245,1)',
            'pointBackgroundColor' => 'rgba(66,165,245,1)',
            'pointBorderColor' => '#fff',
            'pointHoverBackgroundColor' => '#fff',
            'pointHoverBorderColor' => 'rgba(66,165,245,1)',
            'data' => $countInfoSession,
        ];

        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
            'datasets' => [
                $dataSetsSunnies,
                $dataSetsSuntrack,
                $dataSetsMobileApp,
                $dataSetsSunEduWeb,
                $dataSetsSunEngWeb,
                $dataSetsWorkshop,
                $dataSetsSeminar,
                $dataSetsInfoSession,
            ]
        ];

        Redis::set('dashboard.overview.all', json_encode($data));

        return response()->json($data);

        // [
        //     'label' => 'This Week',
        //     'fill' => true,
        //     'backgroundColor' => 'rgba(66,165,245,.75)',
        //     'borderColor' => 'rgba(66,165,245,1)',
        //     'pointBackgroundColor' => 'rgba(66,165,245,1)',
        //     'pointBorderColor' => '#fff',
        //     'pointHoverBackgroundColor' => '#fff',
        //     'pointHoverBorderColor' => 'rgba(66,165,245,1)',
        //     'data' => [25, 38, 62, 45, 90, 115, 130]
        // ],
    }
}
