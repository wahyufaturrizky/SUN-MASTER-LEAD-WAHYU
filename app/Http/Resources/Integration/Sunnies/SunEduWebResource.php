<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Branch as MasterDataBranch;
use App\Remote\Sunnies\MBranch as SunniesBranch;

class SunEduWebResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $masterDataBranch = MasterDataBranch::find($this->branch_id);
        if(!is_null($masterDataBranch)){
            $branchSunnies = $this->getSunniesBranchCode($masterDataBranch->branch_code);
            if($branchSunnies != ''){
                $preferredBranch = $branchSunnies;
            } else {
                $preferredBranch = $this->getPreferredBranchByPostalCode();
            }
        } else {
            $preferredBranch = $this->getPreferredBranchByPostalCode();
        }

        return [
            'id' => 'sun-eng-web-' . $this->registration_id,
            'registration_id' => $this->registration_id,
            'marketing_source_type' => $this->marketing_source_type,
            'registration_type' => $this->registration_type,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'birth' => date_format(date_create($this->birth), 'd.M.y'),
            'gender' => $this->gender,
            'parents_name' => $this->parents_name,
            'parents_mobile' => $this->parents_mobile,
            'parents_email' => $this->parents_email,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'kelurahan' => $this->kelurahan,
            'kecamatan' => $this->kecamatan,
            'dt2' => $this->dt2,
            'kabupaten' => $this->kabupaten,
            'provinsi' => $this->provinsi,
            'fixed_phone' => $this->fixed_phone,
            'highest_edu_id' => $this->highest_edu_id,
            'highest_edu' => $this->highest_edu,
            'precur_school_id' => $this->precur_school_id,
            'precur_school' => $this->precur_school,
            'reference_program_id' => $this->reference_program_id,
            'reference_program_name' => $this->reference_program_name,
            'reference_university_id' => $this->reference_university_id,
            'reference_university_name' => $this->reference_university_name,
            'major_interested_id' => $this->major_interested_id,
            'major_interested' => $this->major_interested,
            'destination_of_study_id' => $this->destination_of_study_id,
            'destination_of_study' => $this->destination_of_study,
            'program_interested_id' => $this->program_interested_id,
            'program_interested' => $this->program_interested,
            'marketing_source_id' => $this->marketing_source_id,
            'marketing_source' => $this->marketing_source,
            'planning_year' => $this->planning_year,
            'has_contact_sun' => $this->has_contact_sun,
            'branch_id' => $this->branch_id,
            'form_id' => $this->form_id,
            'type_student' => $this->type_student,
            'program_name' => $this->program_name,
            'message' => $this->message,
            'grade' => $this->grade,
            'created_at' => date_format(date_create($this->created_at), 'd.M.y H:i'),
            'updated_at' => $this->updated_at,
            'leads_source' => 'Sun Eng Web',
            'is_duplicate' => false,
            // 'is_manual_branching' => $isManualBranching,
            'preferred_branch' => $preferredBranch,

            // for sunnies
            'unit' => 'Live at ' . $this->address . ' ' . $this->zip_code  . ' ' . $this->provinsi . '. Previous/ Current School at ' . $this->precur_school ,
        ];
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

    public function getPreferredBranchByPostalCode(){
        $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($this->zip_code,coverage_area)")->first();
        if(is_null($sunniesBranch)){
            $preferredBranch = 'Coverage Area ' . $this->zip_code . ' Not Found';
        } else {
            $preferredBranch = $sunniesBranch->branch_id;
        }

        return $preferredBranch;
    }
}

