<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\HighestEduRemote;
use App\PrecurSchoolRemote;
use App\WilayahRemote;
use App\ProgramRemote;
use App\CountryRemote;
use App\MarketingSourceRemote;
use App\DestinationOfStudyRemote;
use App\ProgramInterestedRemote;
use App\FStudentRemote;
use App\SunniesBranchRemote;
use App\RStudentRemote;
use App\Country as CountryMD;
use App\Institution as InstitutionMD;
use App\InstitutionGroup as InstitutionGroupMD;

use App\School;
use App\PostalCode;

// Sunnies
use App\Remote\Sunnies\MBranch;
use App\Remote\Sunnies\MInstitution;
use App\Remote\Sunnies\MProgramInterested;
use App\Remote\Sunnies\MClassification;
use App\Remote\Sunnies\MStudySector;
use App\Remote\Sunnies\MEvent;
use App\Remote\Sunnies\SyswebRole;
use App\Remote\Sunnies\MComment;
use App\Remote\Sunnies\MFamily;

// SCN
use App\Remote\SCN\Country;
use App\Remote\SCN\UniversityMS;

use App\Http\Resources\WilayahResource;
use App\Http\Resources\WilayahCollection;

use App\Branch;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchCollection;
use App\Institution;
use DB;
use App\Model\Sunnies\FStudent;

class MasterDataController extends Controller
{
    public function getbranch(){
        // $branches = Branch::all();
        // return new BranchCollection($branches);
        return Branch::select('branch_id as id','branch_name as name')->get();
    }

    public function getHighestEdu(){
        // return HighestEduRemote::all();
        return HighestEduRemote::select('highest_edu_id as id','highest_edu as name')->get();
    }

    public function getPrecureSchool(){
        return PrecurSchoolRemote::select('precur_school_id as id','precur_school as name')->get();
    }

    public function getPostalCode($query = null){
        if(!is_null($query)){
            $wilayahs = WilayahRemote::where('zip_code','LIKE','%' . $query . '%')
                ->orWhere('kelurahan','LIKE','%' . $query . '%')
                ->orWhere('kecamatan','LIKE','%' . $query . '%')
                ->orWhere('dt2','LIKE','%' . $query . '%')
                ->orWhere('kabupaten','LIKE','%' . $query . '%')
                ->orWhere('provinsi','LIKE','%' . $query . '%')
                ->take(10)
                // ->select(DB::raw('CAST(zip_code as UNSIGNED) as id'),DB::raw('zip_code as name'))
                ->get();
        } else {
            $wilayahs = WilayahRemote::take(500)->get();
        }
        return new WilayahCollection($wilayahs);
    }

    public function getDestinationStudy(){
        return DestinationOfStudyRemote::select('destination_of_study_id as id','destination_of_study as name')->get();
    }

    public function getProgramInterested(){
        return ProgramInterestedRemote::select('program_interested_id as id','program_interested as name')->get();
    }

    public function getMarketingSource(){
        return MarketingSourceRemote::select('marketing_source_id as id','marketing_source as name')->get();
        // return MarketingSourceRemote::select('marketing_source_id as id','marketing_source as name')->where('marketing_source','LIKE','%' . 'Sun App' . '%')->get();
    }

    // public function getSchool(){
    //     return School::select('school_id as id','name')->get();
    // }

    public function getSchool($query = null){
        return School::select('school_id as id','name')->where('name','LIKE','%' . $query . '%')->take(10)->get();
    }

    public function getDataSchool(Request $req){
        // return School::select('school_id as id','name')->take(10)->get();
        if($req->has('q')){
            $q = explode(' ', $req->q);
            $query = $req->q;
            $queries = explode(' ', $req->q);

            $precurSchools = DB::connection('mysql_sunnies')->table('m_precur_school')
                                                            ->select('precur_school as name')
                                                            ->distinct('precur_school')
                                                            // ->where('precur_school','LIKE','%' . $query . '%')
                                                            ->where(function ($q) use ($queries){
                                                                foreach($queries as $query){
                                                                    $q->where('precur_school', 'LIKE', '%' . $query . '%');
                                                                }
                                                            })
                                                            ->take(100)
                                                            ->get();
            $fStudentRemote = DB::connection('mysql_sunnies')->table('f_student')
                                                            ->select('precur_school as name')
                                                            ->distinct('precur_school')
                                                            // ->where('precur_school','LIKE','%' . $query . '%')
                                                            ->where(function ($q) use ($queries){
                                                                foreach($queries as $query){
                                                                    $q->where('precur_school', 'LIKE', '%' . $query . '%');
                                                                }
                                                            })
                                                            ->take(100)
                                                            ->get();
            $rStudentRemote = DB::connection('mysql_sunnies')->table('r_student')
                                                            ->select('precur_school as name')
                                                            ->distinct('precur_school')
                                                            // ->where('precur_school','LIKE','%' . $query . '%')
                                                            ->where(function ($q) use ($queries){
                                                                foreach($queries as $query){
                                                                    $q->where('precur_school', 'LIKE', '%' . $query . '%');
                                                                }
                                                            })
                                                            ->take(100)
                                                            ->get();
            $schools = DB::connection('mysql')->table('schools')->select('name')
            ->where(function ($q) use ($queries){
                foreach($queries as $query){
                    $q->where('name', 'LIKE', '%' . $query . '%');
                }
            })
            // ->where('name','LIKE','%' . $queries[0] . '%')
            ->take(100)->whereNotNull('name')->where('name','!=','')->get();
            $schools = $schools->merge($precurSchools);
            return response()->json($schools->unique());

            $precurSchools = PrecurSchoolRemote::select(DB::raw("0 as id"), 'precur_school as name')
                                ->where(function ($query) use ($q) {
                                    foreach($q as $q2){
                                        $query->where('precur_school', 'LIKE', '%' . $q2 . '%');
                                    }
                                })
                                ->distinct('precur_school')->get();
            $fStudentRemote = FStudentRemote::select(DB::raw("0 as id"), 'precur_school as name')
                                ->where(function ($query) use ($q) {
                                    foreach($q as $q2){
                                        $query->where('precur_school', 'LIKE', '%' . $q2 . '%');
                                    }
                                })
                                ->distinct('precur_school')->get();
            $rStudentRemote = RStudentRemote::select(DB::raw("0 as id"), 'precur_school as name')
                                ->where(function ($query) use ($q) {
                                    foreach($q as $q2){
                                        $query->where('precur_school', 'LIKE', '%' . $q2 . '%');
                                    }
                                })
                                ->distinct('precur_school')->get();

            $schools = School::where(function ($query) use ($q) {
                foreach($q as $q2){
                    $query->where('name', 'LIKE', '%' . $q2 . '%');
                }
            })->select('school_id as id','name')->get();

            // $schools = DB::connection('mysql')->table('schools')->select(DB::raw("0 as id"), 'name')->whereNotNull('name')->where('name','!=','')->get();
            // $precurSchoolFStudentRemote = DB::connection('mysql_sunnies')->table('f_student')->select(DB::raw("0 as data"),'precur_school as value')->distinct('precur_school')->where('precur_school','LIKE','%' . $query . '%')->take(10)->get();
            $schools = $schools->merge($precurSchools);
            $schools = $schools->merge($fStudentRemote);
            $schools = $schools->merge($rStudentRemote);
            return $schools->toArray();
            // whereIn('name', 'LIKE', '%' . $query . '%')->select('school_id as id','name')->get();
            // if(is_array($query)){
                // return School::whereIn('name', 'LIKE', '%' . $query . '%')->select('school_id as id','name')->get();
            // } else {
                // return School::where('name', 'LIKE', '%' . $query . '%')->select('school_id as id','name')->get();
            // }
        } else {
            return School::select('school_id as id','name')->orderBy('created_at','desc')->take(0)->get();
        }
    }

    public function getCountry(){

    }

    public function getInstitution(Request $req){
        // return MInstitution::select('institution_id as id','institution_name as name')->take(10)->get();
        if($req->has('destinationOfStudy')){
            $mInstitution = MInstitution::select('institution_id as id','institution_name as name');

            if(!is_null($req->destinationOfStudy) && !empty($req->destinationOfStudy)){
                if(is_array($req->destinationOfStudy)){
                    $mInstitution->whereIn('country_id', $req->destinationOfStudy);
                } else {
                    $mInstitution->where('country_id', $req->destinationOfStudy);
                }
            }
            if($req->has('q')){
                $q = explode(' ', $req->q);
                $query = $req->q;
                $queries = explode(' ', $req->q);

                $mInstitution->where(function ($q) use ($queries){
                    foreach($queries as $query){
                        $q->where('institution_name', 'LIKE', '%' . $query . '%');
                    }
                });
            }
            return $mInstitution->take(10)->get();
        } else {
            return MInstitution::select('institution_id as id','institution_name as name')->take(10)->get();
        }
    }

    public function getProgramStudy(){
        return MProgramInterested::select('program_interested_id as id','program_interested as name')->get();
    }

    public function getStudyClassification(){
        return MClassification::select('classification_id as id','classification_name as name')->get();
    }

    public function getStudySector(){
        return MStudySector::select('study_sector_id as id','study_sector_name as name')->get();
    }

    public function getEvent(Request $req){
        if($req->has('eventYear')){
            if(!is_null($req->eventYear) && !empty($req->eventYear)){
                if(is_array($req->eventYear)){
                    $event = MEvent::select('event_id as id',DB::raw('CONCAT(event_name, " (", DATE_FORMAT(event_date, "%e %b"), ")") AS name'));
                    foreach($req->eventYear as $year){
                        $event->whereYear('event_date', '=', $year, 'or');
                    }
                    return $event->orderBy('event_date','desc')->get();
                } else {
                    return MEvent::whereYear('event_date', $req->eventYear)->select('event_id as id',DB::raw('CONCAT(event_name, " (", DATE_FORMAT(event_date, "%e %b"), ")") AS name'))->orderBy('event_date','desc')->get();
                }
            }

            // if(is_array($req->year)){
            //     $event = MEvent::whereYear('event_date', $req->year)->select('event_id as id',DB::raw('CONCAT(event_name, " (", DATE_FORMAT(event_date, "%e %b"), ")") AS name'))->take(10)->get();
            //     foreach($req->year as $year){

            //     }
            // } else {
            //     return MEvent::whereYear('event_date', $req->year)->select('event_id as id',DB::raw('CONCAT(event_name, " (", DATE_FORMAT(event_date, "%e %b"), ")") AS name'))->take(10)->get();
            // }
        } else {
            return MEvent::select('event_id as id',DB::raw('CONCAT(event_name, " (", DATE_FORMAT(event_date, "%e %b"), ")") AS name'))->orderBy('event_date','desc')->get();
        }

    }

    public function getCounselor($branch_ids = null){
        $counselors = SyswebRole::join('sysweb_usersinroles','sysweb_usersinroles.role_id','sysweb_roles.role_id')
                        ->join('sysweb_users','sysweb_users.user_id','sysweb_usersinroles.user_id')
                        ->where('sysweb_roles.role_name','Counselor');

        return $counselors->select('sysweb_users.user_id as id','sysweb_users.user_name as name')->get();
    }

    public function postGetCounselor(Request $req){
        $req->validate([
            'branch_ids' => 'required',
        ]);
        $branch_ids = $req->branch_ids;

        $counselors = SyswebRole::join('sysweb_usersinroles','sysweb_usersinroles.role_id','sysweb_roles.role_id')
                        ->join('sysweb_users','sysweb_users.user_id','sysweb_usersinroles.user_id')
                        ->where('sysweb_roles.role_name','Counselor');

        $counselors->join('sysweb_profile','sysweb_profile.user_id','sysweb_users.user_id')
                    ->where(function ($query) use($branch_ids) {
                        foreach($branch_ids as $branch_id){
                            $query->orWhere('sysweb_profile.branch_ids', 'like',  '%' . $branch_id .'%');
                        }
                    });

        return $counselors->select('sysweb_users.user_id as id','sysweb_users.user_name as name')->get();
    }

    public function getMajorInterested(){

    }

    public function getBranchSunnies(){
        // $branches = Branch::all();
        // return new BranchCollection($branches);
        return MBranch::select('branch_id as id','branch_name as name')->get();
    }

    public function getDataAjaxSchool(Request $req){
        if($req->has('q')){
            $query = str_replace('+',' ', $req->q);
            $queries = explode(' ', $query);
            return response()->json(School::where(function ($q) use ($queries){
                                        foreach($queries as $query){
                                            $q->where('name', 'LIKE', '%' . $query . '%');
                                        }
                                    })
                                    ->select('school_id as id','name as text')
                                    ->take(200)
                                    ->get());
        } else {
            return response()->json(School::select('school_id as id','name as text')->take(200)->get());
        }
    }

    public function getDataAjaxPostalCode(Request $req){
        if($req->has('q')){
            return response()->json(PostalCode::where('postal_code_number','LIKE','%' . $req->q . '%')
                            ->orWhere('kelurahan','LIKE','%' . $req->q . '%')
                            ->orWhere('kecamatan','LIKE','%' . $req->q . '%')
                            ->orWhere('kabupaten','LIKE','%' . $req->q . '%')
                            ->orWhere('propinsi','LIKE','%' . $req->q . '%')
                            ->select('postal_code_id as id',DB::raw("CONCAT(postal_code_number, ' - ', kelurahan, ', ', kecamatan, ', ', kabupaten, ', ', propinsi) AS text"))
                            ->take(200)
                            ->get());
        } else {
            return response()->json(PostalCode::select('postal_code_id as id',DB::raw("CONCAT(postal_code_number, ' - ', kelurahan, ', ', kecamatan, ', ', kabupaten, ', ', propinsi) AS text"))
                            ->take(200)
                            ->get());
        }
    }

    public function getDataAjaxBranchCoverage(Request $req){
        if($req->has('q')){
            return response()->json(PostalCode::where('postal_code_number','LIKE','%' . $req->q . '%')
                            ->select('postal_code_number as id','postal_code_number as text')
                            ->take(100)
                            ->get());
        } else {
            return response()->json(PostalCode::select('postal_code_number as id','postal_code_number as text')
                            ->take(100)
                            ->get());
        }
    }

    public function getRoleSunnies(){
        return SyswebRole::select('role_id as id','role_name as name')->get();
    }

    public function getCountrySCN(){
        return Country::select('country_id as id','country_name as name')->get();
    }

    public function getUniversitySCN(Request $req){
        // return UniversityMS::select('univ_id as id','univ_name as name')->get();
        if($req->has('countrySCN')){
            // $countrySCN = explode(' ', $req->countrySCN);
            $countrySCN = $req->countrySCN;
            // return UniversityMS::where(function ($query) use ($q) {
            //     foreach($q as $q2){
            //         $query->where('name', 'LIKE', '%' . $q2 . '%');
            //     }
            // })->select('school_id as id','name')->get();

            if(!is_null($req->countrySCN) && !empty($req->countrySCN)){
                if(is_array($req->countrySCN)){
                    return UniversityMS::join('universitydetail_ms','universitydetail_ms.univ_id','university_ms.univ_id')
                        ->join('country_ms','country_ms.city_id','universitydetail_ms.city_id')
                        ->join('country','country.country_id','country_ms.country_id')
                        // ->where(function ($query) use ($countrySCN) {
                        //     foreach($countrySCN as $country){
                        //         $query->orWhere('country.country_id', $country);
                        //     }
                        // })
                        ->whereIn('country.country_id', $req->countrySCN)
                        ->select('university_ms.univ_id as id','university_ms.univ_name as name')
                        ->get();
                } else {
                    return UniversityMS::join('universitydetail_ms','universitydetail_ms.univ_id','university_ms.univ_id')
                        ->join('country_ms','country_ms.city_id','universitydetail_ms.city_id')
                        ->join('country','country.country_id','country_ms.country_id')
                        ->where('country.country_id', $req->countrySCN)
                        ->select('university_ms.univ_id as id','university_ms.univ_name as name')
                        ->get();
                }
            } else {
                return UniversityMS::select('univ_id as id','univ_name as name')->get();
            }
        } else {
            return UniversityMS::select('univ_id as id','univ_name as name')->get();
        }
    }

    public function getBooth(Request $req){
        $booths = MComment::select('institution_id as id','institution_name as name');

        if($req->has('nameOfEvent')){
            if(!is_null($req->nameOfEvent) && !empty($req->nameOfEvent)){
                if(is_array($req->nameOfEvent)){
                    $booths->whereIn('event_id', $req->nameOfEvent);
                } else {
                    $booths->where('event_id', $req->nameOfEvent);
                }
            }
        }

        if($req->has('q')){
            $q = explode(' ', $req->q);
            $query = $req->q;
            $queries = explode(' ', $req->q);

            if(!is_null($req->q) && !empty($req->q)){
                $booths->where(function ($q) use ($queries){
                    foreach($queries as $query){
                        $q->where('institution_name', 'LIKE', '%' . $query . '%');
                    }
                });
            }
        }

        return $booths->where('institution_name','!=','')->distinct('institution_name')->take(10)->get();
    }

    public function getParentsName(Request $req){
        $booths = MFamily::select('family_card_id as id','parents_name as name');

        if($req->has('q')){
            $q = explode(' ', $req->q);
            $query = $req->q;
            $queries = explode(' ', $req->q);

            if(!is_null($req->q) && !empty($req->q)){
                $booths->where(function ($q) use ($queries){
                    foreach($queries as $query){
                        $q->where('parents_name', 'LIKE', '%' . $query . '%');
                    }
                });
            }
        }

        return $booths->where('parents_name','!=','')->distinct('parents_name')->get();
    }

    public function getStudentName(Request $req){
        $results = FStudent::join('m_family_sibling','m_family_sibling.leads_id','f_student.leads_id')->select('f_student.leads_id as id','f_student.full_name as name');

        if($req->has('q')){
            $q = explode(' ', $req->q);
            $query = $req->q;
            $queries = explode(' ', $req->q);

            if(!is_null($req->q) && !empty($req->q)){
                $results->where(function ($q) use ($queries){
                    foreach($queries as $query){
                        $q->where('f_student.full_name', 'LIKE', '%' . $query . '%');
                    }
                });
            }
        }

        return $results->where('f_student.full_name','!=','')->distinct('f_student.leads_id')->take(100)->get();
    }

    public function getCountryMD(){
        return CountryMD::where('sun_destination','Yes')->select('country_code as id','country_name as name')->get();
    }

    public function getInstitutionGroupMD(){
        return InstitutionGroupMD::select('institution_group_id as id','institution_group_name as name')->get();
    }

    public function getInstitutionMD(Request $req){
        if($req->has('countryMD')){
            $countryMD = $req->countryMD;

            if(!is_null($req->countryMD) && !empty($req->countryMD)){
                if(is_array($req->countryMD)){
                    return InstitutionMD::whereIn('country_id', $req->countryMD)
                        ->select('institution_id as id','institution_name as name')
                        ->get();
                } else {
                    return InstitutionMD::where('country_id', $req->countryMD)
                        ->select('institution_id as id','institution_name as name')
                        ->get();
                }
            } else {
                return InstitutionMD::select('institution_id as id','institution_name as name')->get();
            }
        } else {
            return InstitutionMD::select('institution_id as id','institution_name as name')->get();
        }
    }
}
