<?php

namespace App\Http\Controllers\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\RegistrationMail;
use App\Mail\UserRegistrationMail;
use Illuminate\Support\Facades\Mail;

use App\Branch;
use App\Registration;
use App\ProgramRemote;
use App\WilayahRemote;
use App\HighestEduRemote;
use App\PrecurSchoolRemote;
use App\CountryRemote;
use App\MarketingSourceRemote;
use App\DestinationOfStudyRemote;
use App\ProgramInterestedRemote;

use App\School;

class RegistrationController extends Controller
{
    public function add(Request $req){
        $req->validate([
            'registration_type' => 'required',
        ]);

        $formType = '';

        switch($req->registration_type){
            case 'sun-edu-general-registration':
                $this->validateForm1($req);
                $formType = 'form1';
                break;
            case 'sun-edu-apply-program':
                $this->validateForm2($req);
                $formType = 'form2';
                break;
            case 'sun-edu-info-session':
                $this->validateForm3($req);
                $formType = 'form3';
                break;
            case 'sun-edu-seminar':
                $this->validateForm3($req);
                $formType = 'form3';
                break;
            case 'sun-edu-workshop':
                $this->validateForm3($req);
                $formType = 'form3';
                break;
            case 'sun-eng-general-registration':
                $this->validateForm5($req);
                $formType = 'form5';
                break;
            case 'sun-eng-ielts':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'IELTS';
                break;
            case 'sun-eng-toefl':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'TOEFL iBT';
                break;
            case 'sun-eng-gmat':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'GMAT';
                break;
            case 'sun-eng-gre':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'GRE';
                break;
            case 'sun-eng-sat':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'SAT';
                break;
            case 'sun-eng-pte':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'PTE Academic';
                break;
            case 'sun-eng-general-english':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'General English';
                break;
            case 'sun-eng-conversation':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'English Conversation';
                break;
            case 'sun-eng-business':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'Business English';
                break;
            case 'sun-eng-versant':
                $this->validateForm4($req);
                $formType = 'form4';
                $programName = 'Versant';
                break;
            case 'sun-eng-info-session':
                $this->validateSunEngInfoSession($req);
                break;
            case 'sun-eng-seminar':
                $this->validateSunEngSeminar($req);
                break;
            case 'sun-eng-workshop':
                $this->validateSunEngWorkshop($req);
                break;
            case 'sun-eng-intl-ielts':
                $this->validateForm5($req);
                $formType = 'form5';
                break;
            case 'sun-eng-intl-toefl':
                $this->validateForm5($req);
                $formType = 'form5';
                break;
        }

        if($req->registration_type == 'sun-eng-general-registration'){
            $req->validate([
                'form_type' => 'required|in:simple,advance',
            ]);

            if($req->form_type == 'simple'){
                $formType = 'form5';
            } else if($req->form_type == 'advance'){
                $formType = 'form6';
            }
        }

        if($formType == 'form1'){
            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->birth = $req->birth;
            $registration->gender = $req->gender;
            $registration->parents_name = $req->parents_name;
            $registration->parents_mobile = $req->parents_mobile;
            $registration->parents_email = $req->parents_email;
            $registration->address = $req->address;
            $registration->fixed_phone = $req->fixed_phone;
            
            $postalCode = WilayahRemote::find($req->zip_code);
            if(!is_null($postalCode)){
                $registration->zip_code = $postalCode->zip_code;
                $registration->kelurahan = $postalCode->kelurahan;
                $registration->kecamatan = $postalCode->kecamatan;
                $registration->dt2 = $postalCode->dt2;
                $registration->kabupaten = $postalCode->kabupaten;
                $registration->provinsi = $postalCode->provinsi;
            } else {
                return responder()->error(500, 'Postal Code not found, please check again.')->respond();
            }

            $highestEdu = HighestEduRemote::find($req->highest_edu_id);
            if(!is_null($highestEdu)){
                $registration->highest_edu_id = $req->highest_edu_id;
                $registration->highest_edu = $highestEdu->highest_edu;
            } else {
                return responder()->error(500, 'Highest Edu ID not found, please check again.')->respond();
            }

            $precurSchool = School::find($req->precur_school_id);
            if(!is_null($precurSchool)){
                $registration->precur_school_id = $precurSchool->school_id;
                $registration->precur_school = $precurSchool->name;
            } else {
                return responder()->error(500, 'Precur School ID not found, please check again.')->respond();
            }

            $registration->major_interested_id = 0;
            $registration->major_interested = $req->major_interested;

            $registration->fixed_phone = $req->fixed_phone;

            $destinationOfStudy = DestinationOfStudyRemote::find($req->destination_of_study_id);
            if(!is_null($destinationOfStudy)){
                $registration->destination_of_study_id = $destinationOfStudy->destination_of_study_id;
                $registration->destination_of_study = $destinationOfStudy->destination_of_study;
            } else {
                return responder()->error(500, 'Destination of Study ID not found, please check again.')->respond();
            }

            $programInterested = ProgramInterestedRemote::find($req->program_interested_id); // LevelOfStudy
            if(!is_null($programInterested)){
                $registration->program_interested_id = $programInterested->program_interested_id;
                $registration->program_interested = $programInterested->program_interested;
            } else {
                return responder()->error(500, 'Program Interested ID not found, please check again.')->respond();
            }

            $registration->planning_year = $req->planning_year;

            // $marketingSource = MarketingSourceRemote::find($req->marketing_source_id);
            // if(!is_null($marketingSource)){
            //     $registration->marketing_source_id = $marketingSource->marketing_source_id;
            //     $registration->marketing_source = $marketingSource->marketing_source;
            // } else {
            //     return responder()->error(500, 'Marketing Source ID not found, please check again.')->respond();
            // }
            $registration->marketing_source_id = 63;
            $registration->marketing_source = 'Sun App';

            $branch = Branch::find($req->branch_id);
            if(!is_null($branch)){
                $registration->branch_id = $branch->branch_id;
            } else {
                return responder()->error(500, 'Branch ID not found, please check again.')->respond();
            }
            
            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        } else if($formType == 'form2'){
            $program = ProgramRemote::where('program_id', $req->program_id)
                    ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    ->join('university_ms','university_ms.univ_id','program_ms.univ_id')
                    ->join('universitydetail_ms','universitydetail_ms.univ_id','university_ms.univ_id')
                    ->join('country_ms','country_ms.city_id','universitydetail_ms.city_id')
                    ->join('country','country.country_id','country_ms.country_id')

                    // ->join('program_ms','program_ms.univ_id','university_ms.univ_id')
                    // ->join('levelofstudy_ms','levelofstudy_ms.levelofstudy_id','program_ms.levelofstudy_id')
                    // ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    // ->join('fieldofstudy_ms','fieldofstudy_ms.fos_id','major_ms.fos_id')
                    // ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    // ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    // ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    // ->join('major_ms','major_ms.major_id','program_ms.major_id')
                    ->first();

                    // zip_code
                    // major_interested_id => major_id
                    // destination_of_study_id => country_id
                    // program_interested_id => program_id
                    // marketing_source_id

            if(is_null($program)){
                return responder()->error(500, 'Program ID not found, please check again.')->respond();
            }

            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            // $registration->apply_type = 'program';
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->birth = $req->birth;
            $registration->gender = $req->gender;
            $registration->parents_name = $req->parents_name;
            $registration->parents_mobile = $req->parents_mobile;
            $registration->parents_email = $req->parents_email;
            $registration->address = $req->address;

            $postalCode = WilayahRemote::find($req->zip_code);
            if(!is_null($postalCode)){
                $registration->zip_code = $postalCode->zip_code;
                $registration->kelurahan = $postalCode->kelurahan;
                $registration->kecamatan = $postalCode->kecamatan;
                $registration->dt2 = $postalCode->dt2;
                $registration->kabupaten = $postalCode->kabupaten;
                $registration->provinsi = $postalCode->provinsi;
            } else {
                return responder()->error(500, 'Postal Code not found, please check again.')->respond();
            }

            $registration->fixed_phone = $req->fixed_phone;

            $highestEdu = HighestEduRemote::find($req->highest_edu_id);
            if(!is_null($highestEdu)){
                $registration->highest_edu_id = $req->highest_edu_id;
                $registration->highest_edu = $highestEdu->highest_edu;
            } else {
                return responder()->error(500, 'Highest Edu ID not found, please check again.')->respond();
            }

            $precurSchool = School::find($req->precur_school_id);
            if(!is_null($precurSchool)){
                $registration->precur_school_id = $precurSchool->school_id;
                $registration->precur_school = $precurSchool->name;
            } else {
                return responder()->error(500, 'Precur School ID not found, please check again.')->respond();
            }

            $registration->major_interested_id = $program->major->major_id;
            $registration->major_interested = $program->major->major_name;

            $country = CountryRemote::find($program->country_id);
            if(!is_null($country)){
                $registration->destination_of_study_id = $country->country_id;
                $registration->destination_of_study = $country->country_name;
            } else {
                return responder()->error(500, 'Destination of Study ID not found, please check again.')->respond();
            }

            if(!is_null($program)){
                $registration->reference_program_id = $program->program_id;
                $registration->reference_program_name = $program->program_name;
                $registration->reference_university_id = $program->univ_id;
                $registration->reference_university_name = $program->univ_name;
            } else {
                return responder()->error(500, 'Program ID not found, please check again.')->respond();
            }

            // $programInterested = ProgramInterestedRemote::find($req->program_interested_id); // LevelOfStudy
            // if(!is_null($programInterested)){
            //     $registration->program_interested_id = $programInterested->program_interested_id;
            //     $registration->program_interested = $programInterested->program_interested;
            // } else {
            //     return responder()->error(500, 'Program Interested ID not found, please check again.')->respond();
            // }

            $registration->planning_year = $req->planning_year;

            $marketingSource = MarketingSourceRemote::find($req->marketing_source_id);
            if(!is_null($marketingSource)){

            } else {
                return responder()->error(500, 'Marketing Source ID not found, please check again.')->respond();
            }

            $registration->marketing_source_id = $marketingSource->marketing_source_id;
            $registration->marketing_source = $marketingSource->marketing_source;

            if($registration->has_contact_sun == 'true' || $registration->has_contact_sun == 1){
                $registration->has_contact_sun = true;
            } else if($registration->has_contact_sun == 'false' || $registration->has_contact_sun == 0){
                $registration->has_contact_sun = false;
            } else {
                $registration->has_contact_sun = $req->has_contact_sun;
            }

            $branch = Branch::find($req->branch_id);
            if(!is_null($branch)){
                $registration->branch_id = $branch->branch_id;
            } else {
                return responder()->error(500, 'Branch ID not found, please check again.')->respond();
            }
            
            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        } else if($formType == 'form3'){
            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->birth = $req->birth;
            $registration->gender = $req->gender;
            $registration->parents_name = $req->parents_name;
            $registration->parents_mobile = $req->parents_mobile;
            $registration->parents_email = $req->parents_email;
            $registration->address = $req->address;
            $registration->fixed_phone = $req->fixed_phone;
            
            $postalCode = WilayahRemote::find($req->zip_code);
            if(!is_null($postalCode)){
                $registration->zip_code = $postalCode->zip_code;
                $registration->kelurahan = $postalCode->kelurahan;
                $registration->kecamatan = $postalCode->kecamatan;
                $registration->dt2 = $postalCode->dt2;
                $registration->kabupaten = $postalCode->kabupaten;
                $registration->provinsi = $postalCode->provinsi;
            } else {
                return responder()->error(500, 'Postal Code not found, please check again.')->respond();
            }

            $highestEdu = HighestEduRemote::find($req->highest_edu_id);
            if(!is_null($highestEdu)){
                $registration->highest_edu_id = $req->highest_edu_id;
                $registration->highest_edu = $highestEdu->highest_edu;
            } else {
                return responder()->error(500, 'Highest Edu ID not found, please check again.')->respond();
            }

            $precurSchool = School::find($req->precur_school_id);
            if(!is_null($precurSchool)){
                $registration->precur_school_id = $precurSchool->school_id;
                $registration->precur_school = $precurSchool->name;
            } else {
                return responder()->error(500, 'Precur School ID not found, please check again.')->respond();
            }

            $registration->major_interested_id = 0;
            $registration->major_interested = $req->major_interested;

            $registration->fixed_phone = $req->fixed_phone;

            $destinationOfStudy = DestinationOfStudyRemote::find($req->destination_of_study_id);
            if(!is_null($destinationOfStudy)){
                $registration->destination_of_study_id = $destinationOfStudy->destination_of_study_id;
                $registration->destination_of_study = $destinationOfStudy->destination_of_study;
            } else {
                return responder()->error(500, 'Destination of Study ID not found, please check again.')->respond();
            }

            $programInterested = ProgramInterestedRemote::find($req->program_interested_id); // LevelOfStudy
            if(!is_null($programInterested)){
                $registration->program_interested_id = $programInterested->program_interested_id;
                $registration->program_interested = $programInterested->program_interested;
            } else {
                return responder()->error(500, 'Program Interested ID not found, please check again.')->respond();
            }

            $registration->planning_year = $req->planning_year;

            // $marketingSource = MarketingSourceRemote::find($req->marketing_source_id);
            // if(!is_null($marketingSource)){
            //     $registration->marketing_source_id = $marketingSource->marketing_source_id;
            //     $registration->marketing_source = $marketingSource->marketing_source;
            // } else {
            //     return responder()->error(500, 'Marketing Source ID not found, please check again.')->respond();
            // }
            $registration->marketing_source_id = 63;
            $registration->marketing_source = 'Sun App';

            if($registration->has_contact_sun == 'true' || $registration->has_contact_sun == 1){
                $registration->has_contact_sun = true;
            } else if($registration->has_contact_sun == 'false' || $registration->has_contact_sun == 0){
                $registration->has_contact_sun = false;
            } else {
                $registration->has_contact_sun = $req->has_contact_sun;
            }
            
            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        } else if($formType == 'form4'){
            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->birth = $req->birth;
            $registration->gender = $req->gender;
            $registration->parents_name = $req->parents_name;
            $registration->parents_mobile = $req->parents_mobile;
            $registration->parents_email = $req->parents_email;
            $registration->address = $req->address;
            $registration->fixed_phone = $req->fixed_phone;
            $registration->program_name = $programName;
            
            $postalCode = WilayahRemote::find($req->zip_code);
            if(!is_null($postalCode)){
                $registration->zip_code = $postalCode->zip_code;
                $registration->kelurahan = $postalCode->kelurahan;
                $registration->kecamatan = $postalCode->kecamatan;
                $registration->dt2 = $postalCode->dt2;
                $registration->kabupaten = $postalCode->kabupaten;
                $registration->provinsi = $postalCode->provinsi;
            } else {
                return responder()->error(500, 'Postal Code not found, please check again.')->respond();
            }

            $highestEdu = HighestEduRemote::find($req->highest_edu_id);
            if(!is_null($highestEdu)){
                $registration->highest_edu_id = $req->highest_edu_id;
                $registration->highest_edu = $highestEdu->highest_edu;
            } else {
                return responder()->error(500, 'Highest Edu ID not found, please check again.')->respond();
            }

            $precurSchool = School::find($req->precur_school_id);
            if(!is_null($precurSchool)){
                $registration->precur_school_id = $precurSchool->school_id;
                $registration->precur_school = $precurSchool->name;
            } else {
                return responder()->error(500, 'Precur School ID not found, please check again.')->respond();
            }

            $registration->major_interested_id = 0;
            $registration->major_interested = $req->major_interested;

            $registration->fixed_phone = $req->fixed_phone;

            // $destinationOfStudy = DestinationOfStudyRemote::find($req->destination_of_study_id);
            // if(!is_null($destinationOfStudy)){
            //     $registration->destination_of_study_id = $destinationOfStudy->destination_of_study_id;
            //     $registration->destination_of_study = $destinationOfStudy->destination_of_study;
            // } else {
            //     return responder()->error(500, 'Destination of Study ID not found, please check again.')->respond();
            // }

            // $programInterested = ProgramInterestedRemote::find($req->program_interested_id); // LevelOfStudy
            // if(!is_null($programInterested)){
            //     $registration->program_interested_id = $programInterested->program_interested_id;
            //     $registration->program_interested = $programInterested->program_interested;
            // } else {
            //     return responder()->error(500, 'Program Interested ID not found, please check again.')->respond();
            // }

            // $registration->planning_year = $req->planning_year;

            // $marketingSource = MarketingSourceRemote::find($req->marketing_source_id);
            // if(!is_null($marketingSource)){
            //     $registration->marketing_source_id = $marketingSource->marketing_source_id;
            //     $registration->marketing_source = $marketingSource->marketing_source;
            // } else {
            //     return responder()->error(500, 'Marketing Source ID not found, please check again.')->respond();
            // }
            // $registration->marketing_source_id = 63;
            // $registration->marketing_source = 'Sun App';

            $branch = Branch::find($req->branch_id);
            if(!is_null($branch)){
                $registration->branch_id = $branch->branch_id;
            } else {
                return responder()->error(500, 'Branch ID not found, please check again.')->respond();
            }

            // $registration->has_contact_sun = $req->has_contact_sun;
            
            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        } else if($formType == 'form5'){
            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->program_name = $req->program_name;
            $registration->kabupaten = $req->kabupaten;

            $branch = Branch::find($req->branch_id);
            if(!is_null($branch)){
                $registration->branch_id = $branch->branch_id;
            } else {
                return responder()->error(500, 'Branch ID not found, please check again.')->respond();
            }
            
            $registration->message = $req->message;

            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        } else if($formType == 'form6'){
            $registration = new Registration();
            $registration->registration_type = $req->registration_type;
            $registration->full_name = $req->full_name;
            $registration->mobile = $req->mobile;
            $registration->email = $req->email;
            $registration->program_name = $req->program_name;
            $registration->kabupaten = $req->kabupaten;

            $branch = Branch::find($req->branch_id);
            if(!is_null($branch)){
                $registration->branch_id = $branch->branch_id;
            } else {
                return responder()->error(500, 'Branch ID not found, please check again.')->respond();
            }
            
            $registration->message = $req->message;

            if(!empty($req->address) && !is_null($req->address)){
                $registration->address = $req->address;
            }

            if(!empty($req->zip_code) && !is_null($req->zip_code)){
                $registration->zip_code = $req->zip_code;
            }

            if(!empty($req->gender) && !is_null($req->gender)){
                $registration->gender = $req->gender;
            }

            if(!empty($req->birth) && !is_null($req->birth)){
                $registration->birth = $req->birth;
            }

            if(!empty($req->parents_name) && !is_null($req->parents_name)){
                $registration->parents_name = $req->parents_name;
            }

            if(!empty($req->parents_mobile) && !is_null($req->parents_mobile)){
                $registration->parents_mobile = $req->parents_mobile;
            }

            if(!empty($req->parents_email) && !is_null($req->parents_email)){
                $registration->parents_email = $req->parents_email;
            }

            if(!empty($req->grade) && !is_null($req->grade)){
                $registration->grade = $req->grade;
            }

            if(!empty($req->fixed_phone) && !is_null($req->fixed_phone)){
                $registration->fixed_phone = $req->fixed_phone;
            }

            if(!empty($req->highest_edu_id) && !is_null($req->highest_edu_id)){
                $registration->highest_edu_id = $req->highest_edu_id;
            }


            // if($registration->save()){
            //     return responder()->success(['message','Successfully saved'])->respond();
            // } else {
            //     return responder()->success('error','Not saved')->respond();
            // }
        }
        if($registration->save()){
            Mail::to('wahyusigitpriyadi@gmail.com')->send(new RegistrationMail($registration));
            Mail::to('wahyusigitpriyadi@gmail.com')->send(new UserRegistrationMail($registration));

            // Mail::to('riman@dns.co.id')->send(new RegistrationMail($registration));
            // Mail::to('riman@dns.co.id')->send(new UserRegistrationMail($registration));

            // Email to User Registration
            Mail::to($registration->email)->send(new UserRegistrationMail($registration));

            // Email to Admin Sun Edu / Sun English
            if($registration->registration_type == 'sun-edu-general-registration'){
                $adminMail = 'info@suneducationgroup.com';
            } else if($registration->registration_type == 'sun-edu-apply-program'){
                $adminMail = 'info@suneducationgroup.com';
            } else if($registration->registration_type == 'sun-edu-info-session'){
                $adminMail = 'info@suneducationgroup.com';
            } else if($registration->registration_type == 'sun-edu-seminar'){
                $adminMail = 'info@suneducationgroup.com';
            } else if($registration->registration_type == 'sun-edu-workshop'){
                $adminMail = 'info@suneducationgroup.com';
            } else if($registration->registration_type == 'sun-eng-general-registration'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-ielts'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-toefl'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-gmat'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-gre'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-sat'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-pte'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-general-english'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-conversation'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-business'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-versant'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-info-session'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-seminar'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-workshop'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-intl-ielts'){
                $adminMail = 'info@sunenglish.co.id';
            } else if($registration->registration_type == 'sun-eng-intl-toefl'){
                $adminMail = 'info@sunenglish.co.id';
            } else {
                $adminMail = 'wahyusigitpriyadi@gmail.com';
            }
            // Temporarly Disable
            Mail::to($adminMail)->send(new RegistrationMail($registration));

            return responder()->success(['message','Successfully saved'])->respond();
        } else {
            return responder()->success('error','Not saved')->respond();
        }
    }

    // public function add(Request $req){
    //     $req->validate([
    //         'registration_type' => 'required',
    //         'full_name' => 'required',
    //         'mobile' => 'required',
    //         'birth' => 'required',
    //         'gender' => 'required',
    //         'parents_name' => 'required',
    //         'parents_mobile' => 'required',
    //         'address' => 'required',
    //         'zip_code' => 'required',
    //         'phone' => 'required',
    //         'highest_edu_id' => 'required',
    //         // 'highest_edu' => 'required',
    //         'precur_school_id' => 'required',
    //         // 'precur_school' => 'required',
    //         'major_interested_id' => 'required',
    //         'major_interested' => 'required',
    //         'destination_of_study_id' => 'required',
    //         'destination_of_study' => 'required',
    //         'program_interested_id' => 'required',
    //         'program_interested' => 'required',
    //         'marketing_source_id' => 'required',
    //         'marketing_source' => 'required',
    //         'planning_year' => 'required',
    //         'has_contact_sun' => 'required',
    //     ]);

    //     $reg = new Registration();
    //     $req->fill($req->all());
    //     if($req->save()){
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data successfully saved'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Data not saved'
    //         ]);
    //     }
    // }

    public function validateForm1($req){
        $req->validate([
            // Section 1
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'birth' => 'required|date_format:"Y-m-d"',
            'gender' => 'required|in:m,f',

            // Section 2
            'parents_name' => 'required',
            'parents_mobile' => 'required|between:10,16',
            'parents_email' => 'required|email',
            'address' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',

            // Section 3
            'highest_edu_id' => 'required|numeric',
            'precur_school_id' => 'required',
            'major_interested' => 'required',
            'fixed_phone' => 'required|between:8,16',

            // Section 4
            'destination_of_study_id' => 'required',
            'program_interested_id' => 'required', // Level
            'planning_year' => 'required',
            // 'marketing_source_id' => 'required',
            'has_contact_sun' => 'required',
            'branch_id' => 'required',

            // 'precur_school' => 'required', // Asal Sekolah
            // 'major_interested_id' => 'required',
            // 'major_interested' => 'required',
            // 'destination_of_study_id' => 'required',
            // 'destination_of_study' => 'required',
            // 'program_interested' => 'required', 
            // 'marketing_source_id' => 'required', 
            // 'marketing_source' => 'required',
        ]);
    }

    public function validateForm2($req){
        $req->validate([
            'program_id' => 'required',

            // Section 1
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'birth' => 'required|date_format:"Y-m-d"',
            'gender' => 'required|in:m,f',

            // Section 2
            'parents_name' => 'required',
            'parents_mobile' => 'required|between:10,16',
            'parents_email' => 'required|email',
            'address' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',

            // Section 3
            'highest_edu_id' => 'required|numeric',
            'precur_school_id' => 'required',
            // 'major_interested' => 'required',
            'fixed_phone' => 'required|between:8,16',

            // Section 4
            // 'destination_of_study_id' => 'required', // Auto
            // 'program_interested_id' => 'required', // Level
            'planning_year' => 'required',
            // 'marketing_source_id' => 'required',
            'has_contact_sun' => 'required',
            'branch_id' => 'required',

            // 'precur_school' => 'required', // Asal Sekolah
            // 'major_interested_id' => 'required',
            // 'major_interested' => 'required',
            // 'destination_of_study_id' => 'required',
            // 'destination_of_study' => 'required',
            // 'program_interested' => 'required',
            // 'marketing_source_id' => 'required',
            // 'marketing_source' => 'required',
        ]);
    }

    public function validateForm3($req){
        $req->validate([
            // Section 1
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'birth' => 'required|date_format:"Y-m-d"',
            'gender' => 'required|in:m,f',

            // Section 2
            'parents_name' => 'required',
            'parents_mobile' => 'required|between:10,16',
            'parents_email' => 'required|email',
            'address' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',

            // Section 3
            'highest_edu_id' => 'required|numeric',
            'precur_school_id' => 'required',
            'major_interested' => 'required',
            'fixed_phone' => 'required|between:8,16',

            // Section 4
            'destination_of_study_id' => 'required',
            'program_interested_id' => 'required', // Level
            'planning_year' => 'required',
            // 'marketing_source_id' => 'required', 

            // 'precur_school' => 'required', // Asal Sekolah
            // 'major_interested_id' => 'required',
            // 'major_interested' => 'required',
            // 'destination_of_study_id' => 'required',
            // 'destination_of_study' => 'required',
            // 'program_interested' => 'required', 
            // 'marketing_source_id' => 'required', 
            // 'marketing_source' => 'required',
        ]);
    }

    public function validateForm4($req){
        $req->validate([            
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'birth' => 'required|date_format:"Y-m-d"',
            'gender' => 'required|in:m,f',
            'parents_name' => 'required',
            'parents_mobile' => 'required|between:10,16',
            // 'parents_email' => 'required|email',
            'address' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',
            'fixed_phone' => 'required|between:8,16',
            'highest_edu_id' => 'required|numeric',
            'precur_school_id' => 'required',
            // 'program_name' => 'required',
            'branch_id' => 'required',
        ]);
    }

    public function validateForm5($req){
        $req->validate([
            // SIMPLE
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'program_name' => 'required',
            'kabupaten' => 'required',
            'branch_id' => 'required',
            'message' => 'required',

            // ADVANCED
            // 'address' => 'required',
            // 'zip_code' => 'required|numeric|min:10000|max:99999',
            // 'gender' => 'required|in:m,f',
            // 'birth' => 'required|date_format:"Y-m-d"',
            // 'parents_name' => 'required',
            // 'parents_mobile' => 'required|between:10,16',
            // 'parents_email' => 'required|email',
            // 'grade' => 'required',
            // 'fixed_phone' => 'required|between:8,16',
            // 'highest_edu_id' => 'required|numeric',
        ]);
    }

    public function validateForm6($req){
        $req->validate([
            // SIMPLE
            'full_name' => 'required|string',
            'mobile' => 'required|between:10,16',
            'email' => 'required|email',
            'program_name' => 'required',
            'kabupaten' => 'required',
            'branch_id' => 'required',
            'message' => 'required',

            // ADVANCED

            'address' => 'required',
            'zip_code' => 'required|numeric|min:10000|max:99999',
            'gender' => 'required|in:m,f',
            'birth' => 'required|date_format:"Y-m-d"',
            'parents_name' => 'required',
            'parents_mobile' => 'required|between:10,16',
            'parents_email' => 'required|email',
            'fixed_phone' => 'required|between:8,16',
            'highest_edu_id' => 'required|numeric',
            'precur_school_id' => 'required|numeric',
            'grade' => 'required', // Kela/Angkatan misal Kelas 12
            'marketing_source_id' => 'required',

            // 'address' => 'required',
            // 'zip_code' => 'required|numeric|min:10000|max:99999',
            // 'gender' => 'required|in:m,f',
            // 'birth' => 'required|date_format:"Y-m-d"',
            // 'parents_name' => 'required',
            // 'parents_mobile' => 'required|between:10,16',
            // 'parents_email' => 'required|email',
            // 'grade' => 'required',
            // 'fixed_phone' => 'required|between:8,16',
            // 'highest_edu_id' => 'required|numeric',
        ]);
    }

    public function validateSunEduGeneralRegistration(){

    }

    public function validateSunEduApplyProgram(){

    }

    public function validateSunEduInfoSession(){

    }

    public function validateSunEduSeminar(){

    }

    public function validateSunEduWorkshop(){

    }

    public function validateSunEngGeneralRegistration(){

    }

    public function validateSunEngIelts(){

    }

    public function validateSunEngToefl(){

    }

    public function validateSunEngGmat(){

    }

    public function validateSunEngGre(){

    }

    public function validateSunEngSat(){

    }

    public function validateSunEngPte(){

    }

    public function validateSunEngGeneralEnglish(){

    }

    public function validateSunEngConversation(){

    }

    public function validateSunEngBusiness(){

    }

    public function validateSunEngVersant(){

    }

    public function validateSunEngInfoSession(){

    }

    public function validateSunEngSeminar(){

    }

    public function validateSunEngWorkshop(){

    }

    public function validateSunEngIntlIelts(){

    }

    public function validateSunEngIntlToefl(){

    }

}
