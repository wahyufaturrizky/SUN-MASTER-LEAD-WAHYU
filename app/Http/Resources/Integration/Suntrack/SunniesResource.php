<?php

namespace App\Http\Resources\Integration\Suntrack;

use Illuminate\Http\Resources\Json\JsonResource;

// use App\Model\Suntrack\PostalCode as SuntrackPostalCode;
// use App\Model\Suntrack\BranchCoverage as SuntrackBranchCoverage;

use App\Branch as MasterDataBranch;
use App\Remote\Sunnies\MBranch as SunniesBranch;
use App\Remote\Suntrack\Branch as SuntrackBranch;

class SunniesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sunniesBranch = SunniesBranch::find($this->manage_by);
        if(is_null($sunniesBranch)){
            $preferredBranch = $this->getPreferredBranchByPostalCode();
        } else {
            $branchSunnies = $this->getSuntrackBranchCode($sunniesBranch->branch_id);
            if($branchSunnies != ''){
                $preferredBranch = $branchSunnies;
            } else {
                $preferredBranch = $this->getPreferredBranchByPostalCode();
            }
        }

        return [
            'id' => $this->leads_id,
            'student_id' => $this->student_id,
            'ssa_no' => $this->ssa_no,
            'promotion_fee' => $this->promotion_fee,
            'sun_english' => $this->sun_english,
            'is_scholarship' => $this->is_scholarship,
            'interest_aptitude' => $this->interest_aptitude,
            'status' => $this->status,
            'tm_status' => $this->tm_status,
            'visited_to' => $this->visited_to,
            'previous_status' => $this->previous_status,
            'visit_date' => $this->visit_date,
            'register_id' => $this->register_id,
            'parents_name' => $this->parents_name,
            'parents_mobile' => $this->parents_mobile,
            'overseas_number' => $this->overseas_number,
            'full_name' => $this->full_name,
            'nick_name' => $this->nick_name,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'kelurahan' => $this->kelurahan,
            'kecamatan' => $this->kecamatan,
            'dt2' => $this->dt2,
            'kabupaten' => $this->kabupaten,
            'provinsi' => $this->provinsi,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'birth' => $this->birth,
            'highest_edu_id' => $this->highest_edu_id,
            'highest_edu' => $this->highest_edu,
            'precur_school_id' => $this->precur_school_id,
            'precur_school' => $this->precur_school,
            'destination_of_study_id' => $this->destination_of_study_id,
            'destination_of_study' => $this->destination_of_study,
            'major_interested_id' => $this->major_interested_id,
            'major_interested' => $this->major_interested,
            'program_interested_id' => $this->program_interested_id,
            'program_interested' => $this->program_interested,
            'planning_year' => $this->planning_year,
            'intake' => $this->intake,
            'end_intake' => $this->end_intake,
            'recruitment_date' => $this->recruitment_date,
            'marketing_source_id' => $this->marketing_source_id,
            'marketing_source' => $this->marketing_source,
            'has_contact_sun' => $this->has_contact_sun,
            'branch_id' => $this->branch_id,
            'branch_name' => $this->branch_name,
            'other_branch_id' => $this->other_branch_id,
            'other_branch_name' => $this->other_branch_name,
            'register_type' => $this->register_type,
            'comment_flag' => $this->comment_flag,
            'is_commented' => $this->is_commented,
            'is_ielts_participant' => $this->is_ielts_participant,
            'ielts_result' => $this->ielts_result,
            'manage_by' => $this->manage_by,
            'is_branching_auto' => $this->is_branching_auto,
            'counselor_id' => $this->counselor_id,
            'admission_id' => $this->admission_id,
            'admission_add' => $this->admission_add,
            'tmstaff_id' => $this->tmstaff_id,
            'tmleader_id' => $this->tmleader_id,
            'event_id' => $this->event_id,
            'event_name' => $this->event_name,
            'event_date' => $this->event_date,
            'pict_profile' => $this->pict_profile,
            'is_delete' => $this->is_delete,
            'is_publish' => $this->is_publish,
            'is_import' => $this->is_import,
            'tags' => $this->tags,
            'passport_no' => $this->passport_no,
            'passport_exp' => $this->passport_exp,
            'callbp_via' => $this->callbp_via,
            'callbp_on' => $this->callbp_on,
            'is_sun_property' => $this->is_sun_property,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'modified_by' => $this->modified_by,
            'modified_date' => $this->modified_date,
            'created_by_name' => $this->created_by_name,
            'modified_by_name' => $this->modified_by_name,
            'tm_share_councelor_id' => $this->tm_share_councelor_id,
            'tm_share_councelor_date' => $this->tm_share_councelor_date,
            'tm_allocate_leader_id' => $this->tm_allocate_leader_id,
            'tm_allocate_leader_date' => $this->tm_allocate_leader_date,
            'sort_date' => $this->sort_date,
            'gender' => $this->gender,
            'leads_source' => 'Sunnies',

            // 'branch_suggestion' => $branch_uuid,
            'current_branch' => $this->manage_by,
            'preferred_branch' => $preferredBranch,

            'branch_uuid' => $this->getSuntrackBranchUUID($preferredBranch),
        ];
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

    public function getSuntrackBranchUUID($branch_code){
        $suntrackBranch = SuntrackBranch::where('branch_code', $branch_code)->first();
        if(!is_null($suntrackBranch)){
            return $suntrackBranch->branch_uuid;
        } else {
            return '';
        }
    }

    public function getPreferredBranchByPostalCode(){
        if(!is_null($this->zip_code) && !empty($this->zip_code)){
            $suntrackBranch = SuntrackBranch::whereRaw("FIND_IN_SET($this->zip_code,branch_coverage)")->first();
            if(is_null($suntrackBranch)){
                $preferredBranch = 'Coverage Area ' . $this->zip_code . ' Not Found';
            } else {
                $preferredBranch = $suntrackBranch->branch_id;
            }
        } else {
            $preferredBranch = 'Post Code not found';
        }

        return $preferredBranch;

    }
}
