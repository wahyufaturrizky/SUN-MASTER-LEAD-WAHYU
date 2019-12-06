<?php

namespace App\Http\Resources\Integration\Suntrack;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Branch as MasterDataBranch;
use App\Remote\Sunnies\MBranch as SunniesBranch;
use App\Remote\Suntrack\Branch as SuntrackBranch;

class SunmobileApplyProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $preferredBranch = $this->getPreferredBranchByPostalCode();

        // return parent::toArray($request);
        return [
            'id' => 'sunmobile-apply-' . $this->apply_id,
            'user_id' => $this->user_id,
            'apply_type' => $this->apply_type,
            'program_id' => $this->program_id,
            'event_type' => $this->event_type,
            'event_id' => $this->event_id,
            // 'register_id' => $this->register_id,
            'full_name' => $this->full_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'birth' => date_format(date_create($this->birth), 'd F Y'),
            'gender' => $this->gender,
            'parents_name' => $this->parents_name,
            'parents_mobile' => $this->parents_mobile,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'kelurahan' => $this->kelurahan,
            'kecamatan' => $this->kecamatan,
            'dt2' => $this->dt2,
            'phone' => $this->phone,
            'highest_edu_id' => $this->highest_edu_id,
            'highest_edu' => $this->highest_edu,
            'precur_school_id' => $this->precur_school_id,
            'precur_school' => $this->precur_school,
            'major_interested_id' => $this->major_interested_id,
            'major_interested' => $this->major_interested,
            'destination_of_study_id' => $this->destination_of_study_id,
            'destination_of_study' => $this->destination_of_study,
            'program_interested_id' => $this->program_interested_id,
            'program_interested' => $this->program_interested,
            'marketing_source_id' => $this->marketing_source_id,
            'marketing_source' => $this->marketing_source,
            // 'barcode' => $this->barcode,
            // 'qrcode' => $this->qrcode,

            'updated_at' => $this->updated_at,
            'created_at' => date_format(date_create($this->created_at), 'd.M.y H:i'),
            'leads_source' => 'Sun Mobile App - Apply',
            'is_duplicate' => false,
            'preferred_branch' => $preferredBranch,
            'branch_uuid' => $this->getSuntrackBranchUUID($preferredBranch),
            // 'can_auto_branching' => $this->checkBranchCoverageSunnies() ? 'Yes' : 'No',

            // for sunnies
            'unit' => 'Live at ' . $this->address . ' ' . $this->zip_code  . ' ' . $this->provinsi . '. Previous/ Current School at ' . $this->precur_school ,
        ];
    }

    public function getSuntrackBranchUUID($branch_code){
        $suntrackBranch = SuntrackBranch::where('branch_code', $branch_code)->first();
        if(!is_null($suntrackBranch)){
            return $suntrackBranch->branch_uuid;
        } else {
            return '';
        }
    }

    // public function getPreferredBranchByPostalCode(){
    //     $sunniesBranch = SunniesBranch::whereRaw("FIND_IN_SET($this->zip_code,coverage_area)")->first();
    //     if(is_null($sunniesBranch)){
    //         $preferredBranch = 'Coverage Area ' . $this->zip_code . ' Not Found';
    //     } else {
    //         $preferredBranch = $sunniesBranch->branch_id;
    //     }

    //     return $preferredBranch;
    // }

    public function getPreferredBranchByPostalCode(){
        if(!is_null($this->zip_code) && !empty($this->zip_code)){
            $suntrackBranch = SuntrackBranch::whereRaw("FIND_IN_SET($this->zip_code,branch_coverage)")->first();
            if(is_null($suntrackBranch)){
                $preferredBranch = 'Coverage Area ' . $this->zip_code . ' Not Found';
            } else {
                $preferredBranch = $suntrackBranch->branch_code;
            }
        } else {
            $preferredBranch = 'Post Code not found';
        }

        return $preferredBranch;
    }
}
