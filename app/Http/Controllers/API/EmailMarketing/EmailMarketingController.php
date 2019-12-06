<?php

namespace App\Http\Controllers\API\EmailMarketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

// use EmailChecker;
use EmailChecker\EmailChecker;

// Sunnies
use App\Remote\Sunnies\RStudent;
use App\Remote\Sunnies\FStudent;
use App\Remote\Sunnies\TSAP;
use App\Remote\Sunnies\SyswebUser;
use App\Remote\Sunnies\SyswebProfile;
use App\Remote\Sunnies\SyswebRole;
use App\Remote\Sunnies\SyswebUserInRole;

// SCN
use App\Remote\SCN\UniversityMS;
use App\Remote\SCN\Country;

// Mailapp
use App\Remote\Mailapp\SMCustomer;
use App\Remote\Mailapp\SMList;

use App\Registration;
use App\EmailVerification;
use App\InstitutionContact;

use MailWizzApi_Autoloader;
use MailWizzApi_Config;
use MailWizzApi_Base;
use MailWizzApi_Endpoint_ListSubscribers;

use App\Events\ImportEmailMarketingNotification;

class EmailMarketingController extends Controller
{
    private $baseModel;

    // For MailWizz
    private $ipAddress;
    private $source;
    private $status;
    public $emailVerification;

    public function __construct(Request $req){
        MailWizzApi_Autoloader::register();

        $this->ipAddress = $req->ip();
        $this->source = 'Sun Master Data';
        $this->status = 'confirmed';
    }

    // public function check(Request $req){
    //     $req->validate([
    //         'targetProfile' => 'required',
    //         'type' => 'required', // check or submit
    //     ]);

    //     if($req->targetProfile == 'Leads'){
    //         $req->validate([
    //             'typeLeads' => 'required',
    //         ]);

    //         // Setup Base Model
    //         if($req->has('typeLeads')){
    //             if(!is_null($req->typeLeads) && !empty($req->typeLeads)){
    //                 if($req->typeLeads == 'SAP'){
    //                     // Set Base Model
    //                     // $this->baseModel = TSAP::join('m_branch','m_branch.branch_id','t_sap.manage_by');
    //                     $this->baseModel = TSAP::join('f_student','f_student.leads_id','t_sap.leads_id');
    //                     // Start SAP

    //                     if($req->has('SAPStatus')){
    //                         if(!is_null($req->SAPStatus) && !empty($req->SAPStatus)){
    //                             if(is_array($req->SAPStatus)){
    //                                 $this->baseModel->whereIn('t_sap.status', $req->SAPStatus);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.status', $req->SAPStatus);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('branch')){
    //                         if(!is_null($req->branch) && !empty($req->branch)){
    //                             $this->baseModel->join('m_branch','m_branch.branch_id','t_sap.manage_by');
    //                             if(is_array($req->branch)){
    //                                 $this->baseModel->whereIn('t_sap.manage_by', $req->branch);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.manage_by', $req->branch);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('country')){
    //                         if(!is_null($req->country) && !empty($req->country)){
    //                             if(is_array($req->country)){
    //                                 $this->baseModel->whereIn('t_sap.mp_country_id', $req->country);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.mp_country_id', $req->country);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('mainInstitution')){
    //                         if(!is_null($req->mainInstitution) && !empty($req->mainInstitution)){
    //                             if(is_array($req->mainInstitution)){
    //                                 $this->baseModel->whereIn('t_sap.mp_institution_id', $req->mainInstitution);
    //                             } else {
    //                                 $this->baseModel->whereIn('t_sap.mp_institution_id', $req->mainInstitution);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('startOfMainProgramMonth')){
    //                         if(!is_null($req->startOfMainProgramMonth) && !empty($req->startOfMainProgramMonth)){
    //                             // $this->baseModel->whereIn('t_sap.status', $req->startOfMainProgramMonth);
    //                             if(is_array($req->startOfMainProgramMonth)){
    //                                 foreach($req->startOfMainProgramMonth as $month){
    //                                     $this->baseModel->whereMonth('t_sap.mp_intake', $month);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereMonth('t_sap.mp_intake', $req->startOfMainProgramMonth);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('startOfMainProgramYear')){
    //                         if(!is_null($req->startOfMainProgramYear) && !empty($req->startOfMainProgramYear)){
    //                             // $this->baseModel->whereIn('t_sap.status', $req->startOfMainProgramYear);
    //                             if(is_array($req->startOfMainProgramYear)){
    //                                 foreach($req->startOfMainProgramYear as $year){
    //                                     $this->baseModel->whereYear('t_sap.mp_intake', $year);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('t_sap.mp_intake', $req->startOfMainProgramYear);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('endOfMainProgramMonth')){
    //                         if(!is_null($req->endOfMainProgramMonth) && !empty($req->endOfMainProgramMonth)){
    //                             if(is_array($req->endOfMainProgramMonth)){
    //                                 foreach($req->endOfMainProgramMonth as $month){
    //                                     $this->baseModel->whereMonth('t_sap.mp_end_intake', $month);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereMonth('t_sap.mp_end_intake', $req->endOfMainProgramMonth);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('endOfMainProgramYear')){
    //                         if(!is_null($req->endOfMainProgramYear) && !empty($req->endOfMainProgramYear)){
    //                             if(is_array($req->endOfMainProgramYear)){
    //                                 foreach($req->endOfMainProgramYear as $year){
    //                                     $this->baseModel->whereYear('t_sap.mp_end_intake', $year);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('t_sap.mp_end_intake', $req->endOfMainProgramYear);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('schoolOfOrigin')){
    //                         if(!is_null($req->schoolOfOrigin) && !empty($req->schoolOfOrigin)){
    //                             if(is_array($req->schoolOfOrigin)){
    //                                 $this->baseModel->whereIn('t_sap.precur_school_id', $req->schoolOfOrigin);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.precur_school_id', $req->schoolOfOrigin);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('currentYearOfStudy')){
    //                         if(!is_null($req->currentYearOfStudy) && !empty($req->currentYearOfStudy)){
    //                             if(is_array($req->currentYearOfStudy)){
    //                                 $this->baseModel->where('f_student.planning_year', 'LIKE', '%' . $req->currentYearOfStudy[0] . '%');
    //                                 foreach($req->currentYearOfStudy as $year){
    //                                     $this->baseModel->orWhere('f_student.planning_year', 'LIKE', '%' . $year . '%');
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('f_student.planning_year', $req->currentYearOfStudy);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('programStudy')){
    //                         if(!is_null($req->programStudy) && !empty($req->programStudy)){
    //                             if(is_array($req->programStudy)){
    //                                 $this->baseModel->whereIn('t_sap.precur_school', $req->schoolOfOrigin);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.precur_school', $req->schoolOfOrigin);
    //                             }
    //                             $this->baseModel->whereIn('t_sap.highest_edu', $req->programStudy);
    //                         }
    //                     }

    //                     if($req->has('studyClassification')){
    //                         if(!is_null($req->studyClassification) && !empty($req->studyClassification)){
    //                             if(is_array($req->studyClassification)){
    //                                 $this->baseModel->whereIn('t_sap.classification_id', $req->studyClassification);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.classification_id', $req->studyClassification);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('studySector')){
    //                         if(!is_null($req->studySector) && !empty($req->studySector)){
    //                             if(is_array($req->studySector)){
    //                                 $this->baseModel->whereIn('t_sap.study_sector_id', $req->studySector);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.study_sector_id', $req->studySector);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('eventYear')){
    //                         if(!is_null($req->eventYear) && !empty($req->eventYear)){
    //                             if(is_array($req->eventYear)){
    //                                 foreach($req->eventYear as $year){
    //                                     $this->baseModel->whereYear('event_date', $year);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('event_date', $req->eventYear);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('nameOfEvent')){
    //                         if(!is_null($req->nameOfEvent) && !empty($req->nameOfEvent)){
    //                             $this->baseModel->join('m_event','m_event.event_id','t_sap.event_id');
    //                             if(is_array($req->nameOfEvent)){
    //                                 $this->baseModel->whereIn('t_sap.event_name', $req->nameOfEvent);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.event_name', $req->nameOfEvent);
    //                             }
    //                         }
    //                     }

    //                     // if($req->has('boothVisited')){
    //                     //     // if(!is_null($req->boothVisited) && !empty($req->boothVisited)){
    //                     //         $this->baseModel->whereIn('t_sap.mp_institution_name', $req->boothVisited);
    //                     //     }
    //                     // }

    //                     if($req->has('marketingSource')){
    //                         if(!is_null($req->marketingSource) && !empty($req->marketingSource)){
    //                             if(is_array($req->marketingSource)){
    //                                 $this->baseModel->whereIn('t_sap.marketing_source', $req->marketingSource);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.marketing_source', $req->marketingSource);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('scholarshipSeeker')){
    //                         if(!is_null($req->scholarshipSeeker) && !empty($req->scholarshipSeeker)){
    //                             if($req->scholarshipSeeker == 'Yes'){
    //                                 $this->baseModel->where('f_student.is_scholarship', 1);
    //                             } else if($req->scholarshipSeeker == 'No'){
    //                                 $this->baseModel->where('f_student.is_scholarship', 0);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('applicationType')){
    //                         if(!is_null($req->applicationType) && !empty($req->applicationType)){
    //                             // $this->baseModel->whereIn('t_sap.status', $req->applicationType);
    //                             if(is_array($req->applicationType)){
    //                                 $this->baseModel->whereIn('t_sap.application_type', $req->applicationType);
    //                             } else {
    //                                 $this->baseModel->where('t_sap.application_type', $req->applicationType);
    //                             }
    //                         }
    //                     }

    //                     if($req->formType == 'check'){
    //                         $data = $this->baseModel->whereNotNull('t_sap.email')->where('t_sap.email','!=','')->select('t_sap.email as email','t_sap.full_name')->distinct('t_sap.email')->get()->count();
    //                     } else if($req->formType == 'validate' || $req->formType == 'import'){
    //                         $data = $this->baseModel->whereNotNull('t_sap.email')->where('t_sap.email','!=','')->select('t_sap.email as email','t_sap.full_name')->distinct('t_sap.email')->get();
    //                     }

    //                 } else if($req->typeLeads == 'Follow Up'){
    //                     // ===================== Start Follow Up =========================

    //                     $this->baseModel = FStudent::take(999999);

    //                     if($req->has('branch')){
    //                         if(!is_null($req->branch) && !empty($req->branch)){
    //                             $this->baseModel->join('m_branch','m_branch.branch_id','f_student.manage_by');
    //                             if(is_array($req->branch)){
    //                                 $this->baseModel->whereIn('f_student.manage_by', $req->branch);
    //                             } else {
    //                                 $this->baseModel->where('f_student.manage_by', $req->branch);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('counselor')){
    //                         if(!is_null($req->counselor) && !empty($req->counselor)){
    //                             // $this->baseModel->join('m_counselor','m_counselor.counselor_id','f_student.manage_by');
    //                             if(is_array($req->counselor)){
    //                                 $this->baseModel->whereIn('f_student.counselor_id', $req->counselor);
    //                             } else {
    //                                 $this->baseModel->where('f_student.counselor_id', $req->counselor);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('followUpStatus')){
    //                         if(!is_null($req->followUpStatus) && !empty($req->followUpStatus)){
    //                             if(is_array($req->followUpStatus)){
    //                                 $this->baseModel->whereIn('f_student.status', $req->followUpStatus);
    //                             } else {
    //                                 $this->baseModel->where('f_student.status', $req->followUpStatus);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('planningYear')){
    //                         if(!is_null($req->planningYear) && !empty($req->planningYear)){
    //                             if(is_array($req->planningYear)){
    //                                 foreach($req->planningYear as $year){
    //                                     $this->baseModel->whereYear('f_student.event_date', $year);
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('f_student.event_date', $req->planningYear);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('programInterested')){
    //                         if(!is_null($req->programInterested) && !empty($req->programInterested)){
    //                             $this->baseModel->whereYear('f_student.program_interested', $req->programInterested);
    //                         }
    //                     }

    //                     if($req->has('destinationOfStudy')){
    //                         if(!is_null($req->destinationOfStudy) && !empty($req->destinationOfStudy)){
    //                             $this->baseModel->whereYear('f_student.destination_of_study', $req->destinationOfStudy);
    //                         }
    //                     }

    //                     if($req->has('programInterested')){
    //                         if(!is_null($req->programInterested) && !empty($req->programInterested)){
    //                             $this->baseModel->whereYear('f_student.program_interested', $req->programInterested);
    //                         }
    //                     }

    //                     if($req->has('schoolOfOrigin')){
    //                         if(!is_null($req->schoolOfOrigin) && !empty($req->schoolOfOrigin)){
    //                             if(is_array($req->schoolOfOrigin)){
    //                                 $this->baseModel->whereIn('f_student.precur_school_id', $req->schoolOfOrigin);
    //                             } else {
    //                                 $this->baseModel->where('f_student.precur_school_id', $req->schoolOfOrigin);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('currentYearOfStudy')){
    //                         if(!is_null($req->currentYearOfStudy) && !empty($req->currentYearOfStudy)){
    //                             if(is_array($req->currentYearOfStudy)){
    //                                 $this->baseModel->where('f_student.planning_year', 'LIKE', '%' . $req->currentYearOfStudy[0] . '%');
    //                                 foreach($req->currentYearOfStudy as $year){
    //                                     $this->baseModel->orWhere('f_student.planning_year', 'LIKE', '%' . $year . '%');
    //                                 }
    //                             } else {
    //                                 $this->baseModel->whereYear('f_student.planning_year', $req->currentYearOfStudy);
    //                             }
    //                         }
    //                     }

    //                     if($req->has('studyClassification')){
    //                         if(!is_null($req->studyClassification) && !empty($req->studyClassification)){
    //                             if(is_array($req->studyClassification)){
    //                                 $this->baseModel->whereIn('f_student.major_interested', $req->studyClassification);
    //                             } else {
    //                                 $this->baseModel->where('f_student.major_interested', $req->studyClassification);
    //                             }
    //                         }
    //                     }


    //                     if($req->formType == 'check'){
    //                         $data = $this->baseModel->whereNotNull('f_student.email')->where('f_student.email','!=','')->select('f_student.email as email','f_student.full_name')->distinct('f_student.email')->get()->count();
    //                     } else if($req->formType == 'validate' || $req->formType == 'import'){
    //                         $data = $this->baseModel->whereNotNull('f_student.email')->where('f_student.email','!=','')->select('f_student.email as email','f_student.full_name')->distinct('f_student.email')->get();
    //                     }

    //                     // ===================== End. Follow Up =========================
    //                 }
    //             } else {
    //                 $count = 0;
    //             }
    //         } else {
    //             $count = 0;
    //         }
    //     } else if($req->targetProfile == 'Staff'){
    //         // $req->validate([
    //         //     'branch' => 'required',
    //         // ]);

    //         $this->baseModel = SyswebUser::join('sysweb_profile','sysweb_profile.user_id','sysweb_users.user_id');

    //         if($req->has('branch')){
    //             if(!is_null($req->branch) && !empty($req->branch)){
    //                 if(is_array($req->branch)){
    //                     // $this->baseModel->whereIn('f_student.major_interested', $req->branch);
    //                     $branch_ids =  $req->branch;
    //                     $this->baseModel->where(function ($query) use($branch_ids) {
    //                         foreach($branch_ids as $branch_id){
    //                             $query->orWhere('branch_ids', 'LIKE',  '%' . $branch_id .'%');
    //                         }
    //                     });
    //                 } else {
    //                     $this->baseModel->Where('branch_ids', 'LIKE',  '%' . $branch_id .'%');
    //                     // $this->baseModel->where('f_student.major_interested', $req->branch);
    //                 }
    //             }
    //         }

    //         if($req->has('role')){
    //             if(!is_null($req->role) && !empty($req->role)){
    //                 if(is_array($req->role)){
    //                     $this->baseModel->whereIn('f_student.major_interested', $req->role);
    //                 } else {
    //                     $this->baseModel->where('f_student.major_interested', $req->role);
    //                 }
    //             }
    //         }


    //         if($req->typeStaff == 'Role'){
    //             $userIds = SyswebUserInRole::whereIn('role_id', $req->role)->get()->pluck('user_id');
    //             $count = SyswebUser::find($userIds)->get()->count();

    //         } else if($req->typeStaff == 'Branch'){
    //             $branch_ids =  $req->branch;
    //             $count = SyswebProfile::where(function ($query) use($branch_ids) {
    //                 foreach($branch_ids as $branch_id){
    //                     $query->orWhere('branch_ids', 'like',  '%' . $branch_id .'%');
    //                 }
    //             })->get()->count();
    //         }
    //     } else if($req->targetProfile == 'Event'){
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'count' => $count,
    //     ]);
    // }

    public function submit(Request $req){
		// set_time_limit(0);
		// ini_set("max_input_time", "3600");
        // ini_set("memory_limit", "2G");

        $req->validate([
            'list_uid' => 'required',
            'public_key' => 'required',
            'private_key' => 'required',
            'formType' => 'required',
        ]);
        $list_uid = $req->list_uid;

        // ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
        // ini_set('memory_limit','2048M');

        // ky52342xon473
        $list = SMList::where('list_uid', $list_uid)->first();
        if(!is_null($list)){
            $listID = $list->list_id;
        } else {
            $listID = null;
        }

        if($req->targetProfile == 'Leads'){
            $req->validate([
                'typeLeads' => 'required',
            ]);

            // Setup Base Model
            if($req->has('typeLeads')){
                if(!is_null($req->typeLeads) && !empty($req->typeLeads)){
                    if($req->typeLeads == 'SAP'){
                        // Set Base Model
                        // $this->baseModel = TSAP::join('m_branch','m_branch.branch_id','t_sap.manage_by');
                        $this->baseModel = TSAP::join('f_student','f_student.leads_id','t_sap.leads_id');
                        // Start SAP

                        // Leads - SAP - Branch
                        if($req->has('branch')){
                            if(!is_null($req->branch) && !empty($req->branch)){
                                $this->baseModel->join('m_branch','m_branch.branch_id','t_sap.manage_by');
                                if(is_array($req->branch)){
                                    $this->baseModel->whereIn('t_sap.manage_by', $req->branch);
                                } else {
                                    $this->baseModel->where('t_sap.manage_by', $req->branch);
                                }
                            }
                        }

                        // Leads - SAP - SAP Status
                        if($req->has('SAPStatus')){
                            if(!is_null($req->SAPStatus) && !empty($req->SAPStatus)){
                                if(is_array($req->SAPStatus)){
                                    $this->baseModel->whereIn('t_sap.status', $req->SAPStatus);
                                } else {
                                    $this->baseModel->where('t_sap.status', $req->SAPStatus);
                                }
                            }
                        }

                        // Leads - SAP - Country
                        if($req->has('country')){
                            if(!is_null($req->country) && !empty($req->country)){
                                if(is_array($req->country)){
                                    $this->baseModel->whereIn('t_sap.mp_country_id', $req->country);
                                } else {
                                    $this->baseModel->where('t_sap.mp_country_id', $req->country);
                                }
                            }
                        }

                        // Leads - SAP - Main Institution
                        if($req->has('mainInstitution')){
                            if(!is_null($req->mainInstitution) && !empty($req->mainInstitution)){
                                if(is_array($req->mainInstitution)){
                                    $this->baseModel->whereIn('t_sap.mp_institution_name', $req->mainInstitution);
                                } else {
                                    $this->baseModel->whereIn('t_sap.mp_institution_name', $req->mainInstitution);
                                }
                            }
                        }

                        if($req->has('startOfMainProgramMonth') || $req->has('startOfMainProgramYear') || $req->has('endOfMainProgramMonth') || $req->has('endOfMainProgramYear')){
                            if(!is_null($req->startOfMainProgramMonth) && !empty($req->startOfMainProgramMonth) && !is_null($req->startOfMainProgramYear) && !empty($req->startOfMainProgramYear) && !is_null($req->endOfMainProgramMonth) && !empty($req->endOfMainProgramMonth) && !is_null($req->endOfMainProgramYear) && !empty($req->endOfMainProgramYear)){
                                $startDate = $req->startOfMainProgramYear . '-' . $req->startOfMainProgramMonth . '-01';
                                $endDate = $req->endOfMainProgramYear . '-' . $req->endOfMainProgramMonth . '-01';

                                $this->baseModel->whereBetween('t_sap.mp_intake', [$startDate, $endDate]);
                                $this->baseModel->whereBetween('t_sap.mp_end_intake', [$startDate, $endDate]);
                                $this->baseModel->where('t_sap.mp_intake','>=','t_sap.mp_end_intake');
                            }
                        }

                        if($req->has('schoolOfOrigin')){
                            if(!is_null($req->schoolOfOrigin) && !empty($req->schoolOfOrigin)){
                                if(is_array($req->schoolOfOrigin)){
                                    $this->baseModel->whereIn('t_sap.precur_school', $req->schoolOfOrigin);
                                } else {
                                    $this->baseModel->where('t_sap.precur_school', $req->schoolOfOrigin);
                                }
                            }
                        }

                        if($req->has('highestEdu')){
                            if(!is_null($req->highestEdu) && !empty($req->highestEdu)){
                                if(is_array($req->highestEdu)){
                                    $this->baseModel->whereIn('t_sap.highest_edu', $req->highestEdu);
                                } else {
                                    $this->baseModel->where('t_sap.highest_edu', $req->highestEdu);
                                }
                            }
                        }

                        if($req->has('programStudy')){
                            if(!is_null($req->programStudy) && !empty($req->programStudy)){
                                if(is_array($req->programStudy)){
                                    $this->baseModel->whereIn('t_sap.precur_school', $req->schoolOfOrigin);
                                } else {
                                    $this->baseModel->where('t_sap.precur_school', $req->schoolOfOrigin);
                                }
                                $this->baseModel->whereIn('t_sap.highest_edu', $req->programStudy);
                            }
                        }

                        if($req->has('studyClassification')){
                            if(!is_null($req->studyClassification) && !empty($req->studyClassification)){
                                if(is_array($req->studyClassification)){
                                    $this->baseModel->whereIn('t_sap.classification_id', $req->studyClassification);
                                } else {
                                    $this->baseModel->where('t_sap.classification_id', $req->studyClassification);
                                }
                            }
                        }

                        if($req->has('studySector')){
                            if(!is_null($req->studySector) && !empty($req->studySector)){
                                if(is_array($req->studySector)){
                                    $this->baseModel->whereIn('t_sap.study_sector_id', $req->studySector);
                                } else {
                                    $this->baseModel->where('t_sap.study_sector_id', $req->studySector);
                                }
                            }
                        }

                        if($req->has('eventYear')){
                            if(!is_null($req->eventYear) && !empty($req->eventYear)){
                                if(is_array($req->eventYear)){
                                    foreach($req->eventYear as $year){
                                        $this->baseModel->whereYear('event_date', $year);
                                    }
                                } else {
                                    $this->baseModel->whereYear('event_date', $req->eventYear);
                                }
                            }
                        }

                        if($req->has('nameOfEvent')){
                            if(!is_null($req->nameOfEvent) && !empty($req->nameOfEvent)){
                                $this->baseModel->join('m_event','m_event.event_id','t_sap.event_id');
                                if(is_array($req->nameOfEvent)){
                                    $this->baseModel->whereIn('t_sap.event_name', $req->nameOfEvent);
                                } else {
                                    $this->baseModel->where('t_sap.event_name', $req->nameOfEvent);
                                }
                            }
                        }

                        // if($req->has('boothVisited')){
                        //     // if(!is_null($req->boothVisited) && !empty($req->boothVisited)){
                        //         $this->baseModel->whereIn('t_sap.mp_institution_name', $req->boothVisited);
                        //     }
                        // }

                        if($req->has('marketingSource')){
                            if(!is_null($req->marketingSource) && !empty($req->marketingSource)){
                                if(is_array($req->marketingSource)){
                                    $this->baseModel->whereIn('t_sap.marketing_source', $req->marketingSource);
                                } else {
                                    $this->baseModel->where('t_sap.marketing_source', $req->marketingSource);
                                }
                            }
                        }

                        if($req->has('scholarshipSeeker')){
                            if(!is_null($req->scholarshipSeeker) && !empty($req->scholarshipSeeker)){
                                if($req->scholarshipSeeker == 'Yes'){
                                    $this->baseModel->where('f_student.is_scholarship', true);
                                } else if($req->scholarshipSeeker == 'No'){
                                    $this->baseModel->where('f_student.is_scholarship', false);
                                }
                            }
                        }

                        if($req->has('applicationType')){
                            if(!is_null($req->applicationType) && !empty($req->applicationType)){
                                // $this->baseModel->whereIn('t_sap.status', $req->applicationType);
                                if(is_array($req->applicationType)){
                                    $this->baseModel->whereIn('t_sap.application_type', $req->applicationType);
                                } else {
                                    $this->baseModel->where('t_sap.application_type', $req->applicationType);
                                }
                            }
                        }

                        // if($req->has('parentsName')){
                        //     if(!is_null($req->parentsName) && !empty($req->parentsName)){
                        //         $this->baseModel->join('m_family_sibling','m_family_sibling.leads_id','t_sap.leads_id');
                        //         $this->baseModel->join('m_family','m_family.family_card_id','m_family_sibling.family_card_id');
                        //         // $this->baseModel->join('m_family_parent as m_family_father','m_family_father.family_parent_id','m_family.father_id');
                        //         // $this->baseModel->join('m_family_parent as m_family_mother','m_family_mother.family_parent_id','m_family.mother_id');
                        //         if(is_array($req->parentsName)){
                        //             $this->baseModel->whereIn('m_family.parents_name', $req->parentsName);
                        //         } else {
                        //             $this->baseModel->where('m_family.parents_name', $req->parentsName);
                        //         }
                        //     }
                        // }

                        $this->baseModel->whereNotNull('t_sap.email')->where('t_sap.email','!=','')->select('t_sap.email as email','t_sap.full_name')->distinct('t_sap.email');

                    } else if($req->typeLeads == 'Follow Up'){
                        // ===================== Start Follow Up =========================

                        // $this->baseModel = DB::connection('mysql_sunnies')->table('f_student')->whereYear('created_date','>=','2017');
                        $this->baseModel = DB::connection('mysql_sunnies')->table('f_student');

                        if($req->has('branch')){
                            if(!is_null($req->branch) && !empty($req->branch)){
                                $this->baseModel->join('m_branch','m_branch.branch_id','f_student.manage_by');
                                if(is_array($req->branch)){
                                    $this->baseModel->whereIn('f_student.manage_by', $req->branch);
                                } else {
                                    $this->baseModel->where('f_student.manage_by', $req->branch);
                                }
                            }
                        }

                        if($req->has('counselor')){
                            if(!is_null($req->counselor) && !empty($req->counselor)){
                                // $this->baseModel->join('m_counselor','m_counselor.counselor_id','f_student.manage_by');
                                if(is_array($req->counselor)){
                                    $this->baseModel->whereIn('f_student.counselor_id', $req->counselor);
                                } else {
                                    $this->baseModel->where('f_student.counselor_id', $req->counselor);
                                }
                            }
                        }

                        if($req->has('followUpStatus')){
                            if(!is_null($req->followUpStatus) && !empty($req->followUpStatus)){
                                if(is_array($req->followUpStatus)){
                                    $this->baseModel->whereIn('f_student.status', $req->followUpStatus);
                                } else {
                                    $this->baseModel->where('f_student.status', $req->followUpStatus);
                                }
                            }
                        }

                        if($req->has('planningYear')){
                            if(!is_null($req->planningYear) && !empty($req->planningYear)){
                                if(is_array($req->planningYear)){
                                    $planningYear = $req->planningYear;
                                    // foreach($req->planningYear as $year){
                                    //     $this->baseModel->whereYear('f_student.event_date', $year);
                                    // }
                                    $this->baseModel->where(function ($query) use($planningYear) {
                                        foreach($planningYear as $year){
                                            $query->orWhere('f_student.planning_year', 'LIKE',  '%' . $year .'%');
                                        }
                                    });
                                } else {
                                    $this->baseModel->whereYear('f_student.planning_year', $req->planningYear);
                                }
                            } else {
                                $this->baseModel->where('f_student.planning_year', '>=', '2017');
                            }
                        }

                        if($req->has('programInterested')){
                            if(!is_null($req->programInterested) && !empty($req->programInterested)){
                                $this->baseModel->whereYear('f_student.program_interested', $req->programInterested);
                            }
                        }

                        if($req->has('destinationOfStudy')){
                            if(!is_null($req->destinationOfStudy) && !empty($req->destinationOfStudy)){
                                if(is_array($req->destinationOfStudy)){
                                    $this->baseModel->whereIn('f_student.destination_of_study', $req->destinationOfStudy);
                                } else {
                                    $this->baseModel->where('f_student.destination_of_study', $req->destinationOfStudy);
                                }
                            }
                        }

                        if($req->has('programInterested')){
                            if(!is_null($req->programInterested) && !empty($req->programInterested)){
                                $this->baseModel->whereYear('f_student.program_interested', $req->programInterested);
                            }
                        }

                        // Leads - Follow Up - School of Origin
                        if($req->has('schoolOfOrigin')){
                            if(!is_null($req->schoolOfOrigin) && !empty($req->schoolOfOrigin)){
                                if(is_array($req->schoolOfOrigin)){
                                    $this->baseModel->whereIn('f_student.precur_school', $req->schoolOfOrigin);
                                } else {
                                    $this->baseModel->where('f_student.precur_school', $req->schoolOfOrigin);
                                }
                            }
                        }

                        // Leads - Follow Up - Current Education Grade
                        if($req->has('highestEdu')){
                            if(!is_null($req->highestEdu) && !empty($req->highestEdu)){
                                if(is_array($req->highestEdu)){
                                    $this->baseModel->whereIn('f_student.highest_edu', $req->highestEdu);
                                } else {
                                    $this->baseModel->where('f_student.highest_edu', $req->highestEdu);
                                }
                            }
                        }

                        // Leads - Follow Up - Current Year of Study
                        // if($req->has('currentYearOfStudy')){
                        //     if(!is_null($req->currentYearOfStudy) && !empty($req->currentYearOfStudy)){
                        //         if(is_array($req->currentYearOfStudy)){
                        //             $this->baseModel->where('f_student.planning_year', 'LIKE', '%' . $req->currentYearOfStudy[0] . '%');
                        //             foreach($req->currentYearOfStudy as $year){
                        //                 $this->baseModel->orWhere('f_student.planning_year', 'LIKE', '%' . $year . '%');
                        //             }
                        //         } else {
                        //             $this->baseModel->whereYear('f_student.planning_year', $req->currentYearOfStudy);
                        //         }
                        //     }
                        // }

                        // if($req->has('studyClassification')){
                        //     if(!is_null($req->studyClassification) && !empty($req->studyClassification)){
                        //         if(is_array($req->studyClassification)){
                        //             $this->baseModel->whereIn('f_student.major_interested', $req->studyClassification);
                        //         } else {
                        //             $this->baseModel->where('f_student.major_interested', $req->studyClassification);
                        //         }
                        //     }
                        // }

                        // Leads - Follow Up - Leads Type
                        if($req->has('leadsType')){
                            if(!is_null($req->leadsType) && !empty($req->leadsType)){
                                if(is_array($req->leadsType)){
                                    $this->baseModel->whereIn('f_student.register_type', $req->leadsType);
                                } else {
                                    $this->baseModel->where('f_student.register_type', $req->leadsType);
                                }
                            }
                        }

                        // Leads - Follow Up - Event Year
                        if($req->has('eventYear')){
                            if(!is_null($req->eventYear) && !empty($req->eventYear)){
                                $this->baseModel->join('m_event','m_event.event_id','f_student.event_id');
                                if(is_array($req->eventYear)){
                                    foreach($req->eventYear as $year){
                                        $this->baseModel->whereYear('m_event.event_date', $year);
                                    }
                                } else {
                                    $this->baseModel->whereYear('m_event.event_date', $req->eventYear);
                                }
                            }
                        }

                        // Leads - Follow Up - Name of Study
                        if($req->has('nameOfEvent')){
                            if(!is_null($req->nameOfEvent) && !empty($req->nameOfEvent)){
                                $this->baseModel->join('m_event','m_event.event_id','f_student.event_id');
                                if(is_array($req->nameOfEvent)){
                                    $this->baseModel->whereIn('t_sap.event_name', $req->nameOfEvent);
                                } else {
                                    $this->baseModel->where('t_sap.event_name', $req->nameOfEvent);
                                }
                            }
                        }

                        // Leads - Follow Up - Marketing Source
                        if($req->has('marketingSource')){
                            if(!is_null($req->marketingSource) && !empty($req->marketingSource)){
                                if(is_array($req->marketingSource)){
                                    $this->baseModel->whereIn('f_student.marketing_source', $req->marketingSource);
                                } else {
                                    $this->baseModel->where('f_student.marketing_source', $req->marketingSource);
                                }
                            }
                        }

                        // Leads - Follow Up - Visit SUN (Has Contact Sun)
                        if($req->has('visitSUN')){
                            if(!is_null($req->visitSUN) && !empty($req->visitSUN)){
                                if($req->visitSUN == 'Yes'){
                                    $this->baseModel->where('f_student.has_contact_sun', 1);
                                } else if($req->visitSUN == 'No'){
                                    $this->baseModel->where('f_student.has_contact_sun', 0);
                                }
                            }
                        }

                        // Leads - Follow Up - Scholarship Seeker
                        if($req->has('scholarshipSeeker')){
                            if(!is_null($req->scholarshipSeeker) && !empty($req->scholarshipSeeker)){
                                if($req->scholarshipSeeker == 'Yes'){
                                    $this->baseModel->where('f_student.is_scholarship', true);
                                } else if($req->scholarshipSeeker == 'No'){
                                    $this->baseModel->where('f_student.is_scholarship', false);
                                }
                            }
                        }

                        $this->baseModel->whereNotNull('f_student.email')->where('f_student.email','!=','')->select('f_student.email as email','f_student.full_name')->distinct('f_student.email');

                        // ===================== End. Follow Up =========================
                    }
                }
            }
        } else if($req->targetProfile == 'Staff'){
            // $req->validate([
            //     'branch' => 'required',
            // ]);

            // $this->baseModel = SyswebUser::join('sysweb_profile','sysweb_profile.user_id','sysweb_users.user_id');
            $this->baseModel = SyswebUser::join('sysweb_profile','sysweb_profile.user_id','sysweb_users.user_id');

            if($req->has('branch')){
                if(!is_null($req->branch) && !empty($req->branch)){
                    if(is_array($req->branch)){
                        // $this->baseModel->whereIn('f_student.major_interested', $req->branch);
                        $branch_ids =  $req->branch;
                        $this->baseModel->where(function ($query) use($branch_ids) {
                            foreach($branch_ids as $branch_id){
                                $query->orWhere('branch_ids', 'LIKE',  '%' . $branch_id .'%');
                            }
                        });
                    } else {
                        $this->baseModel->where('branch_ids', 'LIKE',  '%' . $branch_id .'%');
                        // $this->baseModel->where('f_student.major_interested', $req->branch);
                    }
                }
            }

            if($req->has('role')){
                if(!is_null($req->role) && !empty($req->role)){
                    $userIds = SyswebUserInRole::whereIn('role_id', $req->role)->get()->pluck('user_id');
                    if(is_array($req->role)){
                        $this->baseModel->whereIn('sysweb_users.user_id', $userIds)->select('email','user_name as full_name');
                    } else {
                        $this->baseModel->where('sysweb_users.user_id', $userIds)->select('email','user_name as full_name');
                    }
                }
            }

            $this->baseModel->whereNotNull('sysweb_users.email')->where('sysweb_users.email','!=','')->select('sysweb_users.email as email','sysweb_users.user_name')->distinct('sysweb_users.email');

            // if($req->typeStaff == 'Role'){
            //     $userIds = SyswebUserInRole::whereIn('role_id', $req->role)->get()->pluck('user_id');
            //     $this->baseModel = SyswebUser::whereIn('user_id', $userIds)->select('email','user_name as full_name');
            // } else if($req->typeStaff == 'Branch'){
            //     $branch_ids =  $req->branch;
            //     $this->baseModel = SyswebProfile::where(function ($query) use($branch_ids) {
            //         foreach($branch_ids as $branch_id){
            //             $query->orWhere('branch_ids', 'like',  '%' . $branch_id .'%');
            //         }
            //     });
            // }


            // if($req->typeStaff == 'Role'){
                // $branch_ids =  $req->branch;
                // $userIds = SyswebUserInRole::whereIn('role_id', $req->role)->get()->pluck('user_id');
                // $this->baseModel = SyswebUser::whereIn('sysweb_users.user_id', $userIds)->select('email','user_name as full_name')
                //                     ->join('sysweb_profile','sysweb_profile.user_id','sysweb_users.user_id')
                //                     ->where(function ($query) use($branch_ids) {
                //                         foreach($branch_ids as $branch_id){
                //                             $query->orWhere('branch_ids', 'like',  '%' . $branch_id .'%');
                //                         }
                //                     });
            // } else if($req->typeStaff == 'Branch'){
                // $this->baseModel = SyswebProfile::where(function ($query) use($branch_ids) {
                //     foreach($branch_ids as $branch_id){
                //         $query->orWhere('branch_ids', 'like',  '%' . $branch_id .'%');
                //     }
                // });
            // }
        } else if($req->targetProfile == 'Event'){
            $this->baseModel = RStudent::join('m_event','m_event.event_id','r_student.event_id');

            if($req->has('eventYear')){
                if(!is_null($req->eventYear) && !empty($req->eventYear)){
                    if(is_array($req->eventYear)){
                        $evenYear = $req->eventYear;
                        // foreach($req->eventYear as $year){
                        //     $this->baseModel->whereYear('m_event.event_date', $year);
                        // }
                        $this->baseModel->where(function ($query) use($evenYear) {
                            foreach($evenYear as $year){
                                $query->orWhere('m_event.event_date', 'LIKE',  '%' . $year .'%');
                            }
                        });
                    } else {
                        $this->baseModel->whereYear('m_event.event_date', $req->eventYear);
                    }
                } else {
                    $this->baseModel->whereYear('m_event.event_date', '>=','2017');
                }
            }

            if($req->has('nameOfEvent')){
                if(!is_null($req->nameOfEvent) && !empty($req->nameOfEvent)){
                    // $this->baseModel->join('m_event','m_event.event_id','m_event.event_id');
                    if(is_array($req->nameOfEvent)){
                        $this->baseModel->whereIn('m_event.event_id', $req->nameOfEvent);
                    } else {
                        $this->baseModel->where('m_event.event_id', $req->nameOfEvent);
                    }
                }
            }

            if($req->has('boothVisited')){
                if(!is_null($req->boothVisited) && !empty($req->boothVisited)){
                    $this->baseModel->join('m_comment','m_comment.event_id','m_event.event_id');

                    if(is_array($req->boothVisited)){
                        $this->baseModel->whereIn('m_comment.institution_name', $req->boothVisited);
                    } else {
                        $this->baseModel->where('m_comment.institution_name', $req->boothVisited);
                    }
                }
            }

            if($req->has('marketingSource')){
                if(!is_null($req->marketingSource) && !empty($req->marketingSource)){
                    if(is_array($req->marketingSource)){
                        $this->baseModel->whereIn('r_student.marketing_source', $req->marketingSource);
                    } else {
                        $this->baseModel->where('r_student.marketing_source', $req->marketingSource);
                    }
                }
            }

            $this->baseModel->whereNotNull('r_student.email')->where('r_student.email','!=','')->select('r_student.email as email','r_student.full_name')->distinct('r_student.email');
        } else if($req->targetProfile == 'Institution'){
            // $this->baseModel = UniversityMS::join('universitydetail_ms','universitydetail_ms.univ_id','university_ms.univ_id');
            // $this->baseModel = InstitutionContact::join('contactuniv_ms','contactuniv_ms.univ_id','university_ms.univ_id');

            // $this->baseModel = new InstitutionContact;

            if($req->has('contactType')){
                if(!is_null($req->contactType) && !empty($req->contactType)){
                    if($req->contactType == 'Group'){
                        $this->baseModel = InstitutionContact::join('institution_groups','institution_groups.institution_group_id','institution_contacts.reference_id')->where('type','Group');
                        if(!is_null($req->institutionGroupMD) && !empty($req->institutionGroupMD)){
                            if(is_array($req->institutionGroupMD)){
                                $this->baseModel->whereIn('institution_contacts.reference_id', $req->institutionGroupMD);
                            } else {
                                $this->baseModel->where('institution_contacts.reference_id', $req->institutionGroupMD);
                            }
                        }
                    } else if($req->contactType == 'Institution'){
                        $this->baseModel = InstitutionContact::join('institutions','institutions.institution_id','institution_contacts.reference_id')->where('type','Institution');
                        if(!is_null($req->institutionMD) && !empty($req->institutionMD)){
                            if(is_array($req->institutionMD)){
                                $this->baseModel->whereIn('institution_contacts.reference_id', $req->institutionMD);
                            } else {
                                $this->baseModel->where('institution_contacts.reference_id', $req->institutionMD);
                            }
                        }
                    }
                }
            }

            $this->baseModel->whereNotNull('institution_contacts.email')->where('institution_contacts.email','!=','')->select('institution_contacts.email as email','institution_contacts.name as name','institution_contacts.name as full_name')->distinct('institution_contacts.email');

        } else if($req->targetProfile == 'Parents'){
            // $this->baseModel = UniversityMS::join('universitydetail_ms','universitydetail_ms.univ_id','university_ms.univ_id');
            $this->baseModel = FStudent::join('m_family_sibling','m_family_sibling.leads_id','f_student.leads_id');

            if($req->has('studentName')){
                if(!is_null($req->studentName) && !empty($req->studentName)){
                    if(is_array($req->studentName)){
                        $this->baseModel->whereIn('f_student.leads_id', $req->studentName);
                    } else {
                        $this->baseModel->where('f_student.leads_id', $req->studentName);
                    }
                }
            }
            $this->baseModel->whereNotNull('f_student.email')->where('f_student.email','!=','')->select('f_student.email as email','f_student.full_name as full_name')->distinct('f_student.email');
        } else {
            $fStudent = DB::connection('mysql_sunnies')->table('f_student')->select('email','full_name')->distinct('email');
            $tSAP = DB::connection('mysql_sunnies')->table('t_sap')->select('email','full_name')->distinct('email');
            // $syswebUser = DB::connection('mysql_sunnies')->table('sysweb_users')->select('email')->distinct('email');

            $this->baseModel = DB::connection('mysql_sunnies')->table('r_student')->select('email','full_name')->distinct('email')
                        ->union($fStudent)
                        ->union($tSAP);
                        // ->union($syswebUser);
        }

        if($req->formType == 'check'){
            return response()->json([
                // 'status' => true,
                // 'count' => $this->baseModel->get()->count(),

                'status' => true,
                'count' => [
                    'total' => $this->baseModel->get()->count(),
                    'ok' => 0,
                    'fail' => 0,
                    'unknown' => 0,
                ],

                // 'list_uid' => $list_uid,
                // 'name' => $leads->full_name,
                // 'email' => $leads->email,
                // 'percentage' => ($emailOk + $emailFail + $emailUnknown) / $emailCount * 100,
                // 'is_done' => $emailCount - $i == 1 ? true : false,
                // 'check' => ($req->formType == 'check' && $emailCount - $i == 1) ? true : false,
                // 'validate' => ($req->formType == 'validate' && $emailCount - $i == 1) ? true : false,
                // 'import' => ($req->formType == 'import' && $emailCount - $i == 1) ? true : false,
            ]);
        }

        // Import to Sun Mail Marketing
        $config = new MailWizzApi_Config(array(
            'apiUrl'        => 'http://mailapp.suneducationgroup.com/api/index.php',
            // 'apiUrl'        => 'http://192.168.100.87:8086/api/index.php',
            'publicKey'     => $req->public_key,
            'privateKey'    => $req->private_key,
            // 'publicKey'     => 'f9c77f7b153c2544a5eb449a144aba463ca04abc',
            // 'privateKey'    => 'fbae1af744a7b1f0565545f5780a13ab6a393cce'
        ));

        MailWizzApi_Base::setConfig($config);
        // date_default_timezone_set('UTC');

        $endpoint = new MailWizzApi_Endpoint_ListSubscribers();
        $sunniesLeads = $this->baseModel->get();

        $response = [];

        $emailCount = $sunniesLeads->count();
        $emailOk = 0;
        $emailFail = 0;
        $emailUnknown = 0;
        foreach($sunniesLeads as $i => $leads){
            // // Email Verification
            // // $emailVerification = EmailVerification::where('email', $leads->email)->first();
            // $emailVerification = EmailVerification::firstOrNew([
            //     'email' => $leads->email
            // ]);

            // // if(is_null($emailVerification)){
            //     $emailChecker = EmailChecker::check($leads->email);
            //     if($emailChecker){
            //         // $emailVerification = new EmailVerification();
            //         $emailVerification->email = $leads->email;
            //         $emailVerification->status = 'ok';
            //         $emailVerification->save();
            //     } else {
            //         // $emailVerification = new EmailVerification();
            //         $emailVerification->email = $leads->email;
            //         $emailVerification->status = 'fail';
            //         $emailVerification->save();
            //     }
            // // }
            // // return response()->json($emailVerification);

            // OLD - Email Verification
            $emailVerification = EmailVerification::where('email', $leads->email)->first();

            if(is_null($emailVerification) || $emailVerification->status == '' || is_null($emailVerification->status)){
                $client = new \GuzzleHttp\Client();
                $guzzleResponse = $client->request('GET', 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=' . $leads->email . '&ext=1'); // .

                // $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.my-addr.com/email/api.php?secret=3B9EE8463A8746FB0654D072A2D3B96C&email=' . $leads->email . '&ext=1');
                // $client->sendAsync($request)->then(function ($guzzleResponse) use ($emailVerification, $leads) {
                    // dd($guzzleResponse->getStatusCode());
                    if($guzzleResponse->getStatusCode() == 200){
                        // $verificationStatus = explode('|', $guzzleResponse->getBody());
                        // $emailVerification = new EmailVerification();
                        $emailVerification = EmailVerification::firstOrNew([
                                'email' => $leads->email
                        ]);
                        // $emailVerification->email = $leads->email;
                        if(!is_null($guzzleResponse->getBody()) && !empty($guzzleResponse->getBody())){
                            $verificationStatus = explode('|', $guzzleResponse->getBody());
                            $emailVerification->status = isset($verificationStatus[0]) ? $verificationStatus[0] : 'unknown';
                            $emailVerification->sub_status = isset($verificationStatus[1]) ? $verificationStatus[1] : 'unknown';
                        } else {
                            $emailVerification->status = 'unknown';
                            $emailVerification->sub_status = 'unknown';
                        }

                        try {
                            $emailVerification->save();
                            // Validate the value...
                        } catch (Exception $e) {
                            // report($e);
//
                            // return false;
                        }

                        // $emailVerification->save();
                        // if(is_null($emailVerification)){
                            // $emailVerification = EmailVerification::firstOrNew([
                            //     'email' => $leads->email
                            // ]);
                        // }
                    }
                    // echo 'I completed! ' . $response->getBody();

                // return dd($emailVerification);
                // });

            }

            if(is_null($leads->full_name) || empty($leads->full_name)){
                $full_name = $leads->contact_name;
            } else {
                $full_name = $leads->full_name;
            }

            if($emailVerification->status == 'ok'){
                $emailOk = ++$emailOk;
            } else if($emailVerification->status == 'fail'){
                $emailFail = ++$emailFail;
            }else if($emailVerification->status == 'unknown'){
                $emailFail = ++$emailFail;
            }

            event(new ImportEmailMarketingNotification([
                'list_uid' => $list_uid,
                'name' => $full_name,
                'email' => $leads->email,
                'status' => $emailVerification->status,
                'count' => [
                    'total' => $emailCount,
                    'ok' => $emailOk,
                    'fail' => $emailFail,
                    'unknown' => $emailUnknown,
                ],
                'percentage' => ($emailOk + $emailFail + $emailUnknown) / $emailCount * 100,
                'is_done' => $emailCount - $i == 1 ? true : false,
                'check' => ($req->formType == 'check' && $emailCount - $i == 1) ? true : false,
                'validate' => ($req->formType == 'validate' && $emailCount - $i == 1) ? true : false,
                'import' => ($req->formType == 'import' && $emailCount - $i == 1) ? true : false,
            ]));

            if($req->formType == 'import'){
                // Email Verification Status => ok, fail
                if($emailVerification->status == 'ok'){
                    $response[] = $endpoint->createUpdate($list_uid, array(
                        'EMAIL'    => $leads->email, // the confirmation email will be sent!!! Use valid email address
                        'FNAME'    => $leads->full_name,
                        'LNAME'    => ''
                    ));
                }
            }
        }

        // return response()->json($responses);

        return response()->json([
            'status' => true,
            'count' => [
                'total' => $emailCount,
                'ok' => $emailOk,
                'fail' => $emailFail,
                'unknown' => $emailUnknown,
            ],

            'list_uid' => $list_uid,
            'name' => $leads->full_name,
            'email' => $leads->email,
            'is_forced' => false,
            'percentage' => ($emailOk + $emailFail + $emailUnknown) / $emailCount * 100,
            'is_done' => $emailCount - $i == 1 ? true : false,
            'check' => ($req->formType == 'check' && $emailCount - $i == 1) ? true : false,
            'validate' => ($req->formType == 'validate' && $emailCount - $i == 1) ? true : false,
            'import' => ($req->formType == 'import' && $emailCount - $i == 1) ? true : false,
        ]);

        // return response()->json([
        //     'data' => $this->baseModel->select('t_sap.*')->orderBy('t_sap.modified_date', 'desc')->take(10)->get()
        // ]);

    }

    // Import Single Email (Force without validation)
    public function importEmail(Request $req){
        $req->validate([
            'list_uid' => 'required',
            'public_key' => 'required',
            'private_key' => 'required',
            'email' => 'required',
            'full_name' => 'required',
        ]);

        $list_uid = $req->list_uid;

        // ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
        // ini_set('memory_limit','2048M');

        // ky52342xon473
        $list = SMList::where('list_uid', $list_uid)->first();
        if(!is_null($list)){
            $listID = $list->list_id;
        } else {
            $listID = null;
        }

        // Import to Sun Mail Marketing
        $config = new MailWizzApi_Config(array(
            'apiUrl'        => 'http://mailapp.suneducationgroup.com/api/index.php',
            'publicKey'     => $req->public_key,
            'privateKey'    => $req->private_key,
        ));


        MailWizzApi_Base::setConfig($config);
        // date_default_timezone_set('UTC');

        $endpoint = new MailWizzApi_Endpoint_ListSubscribers();

        $response = $endpoint->createUpdate($list_uid, array(
            'EMAIL'    => $req->email, // the confirmation email will be sent!!! Use valid email address
            'FNAME'    => $req->full_name,
            'LNAME'    => ''
        ));

        return response()->json($response);

    }
}
