<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Branch as MasterDataBranch;
use App\Remote\Sunnies\MBranch as SunniesBranch;
use App\Remote\Suntrack\Branch as SuntrackBranch;

class SuntrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $suntrackBranch = SuntrackBranch::find($this->branch_uuid);
        $branchSunnies = $this->getSunniesBranchCode($suntrackBranch->branch_code);
            if($branchSunnies != ''){
                $preferredBranch = $branchSunnies;
            } else {
                $preferredBranch = $this->getPreferredBranchByPostalCode();
            }

        return [
            'id' => $this->leads_uuid,
            'leads_id' => $this->leads_id,
            'created_by' => $this->created_by,
            'branch_uuid' => $this->branch_uuid,
            'student_id' => $this->student_id,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'dob' => date_format(date_create($this->dob), 'd.M.y'),
            'email' => $this->email,
            'telephone' => $this->telephone,
            'mobile_phone' => $this->mobile_phone,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'postal_code_uuid' => $this->postal_code_uuid,
            'parents_name' => $this->parents_name,
            'parents_phone' => $this->parents_phone,
            'marketing_source_type' => $this->marketing_source_type,
            'marketing_source_online' => $this->marketing_source_online,
            'marketing_source_offline' => $this->marketing_source_offline,
            'marketing_source_event' => $this->marketing_source_event,
            'marketing_source_detail' => $this->marketing_source_detail,
            'marketing_source_note' => $this->marketing_source_note,
            'type_student' => $this->type_student,
            'type_student_value' => $this->type_student_value,
            'type_student_note' => $this->type_student_note,
            'intake' => $this->intake,
            'notes' => $this->notes,
            'profile_image' => $this->profile_image,
            'status' => $this->status,
            'is_cancel' => $this->is_cancel,
            'is_student' => $this->is_student,
            'updated_at' => $this->updated_at,
            'created_at' => date_format(date_create($this->created_at), 'd.M.y H:i'),
            'leads_source' => 'Sun Track',
            'is_duplicate' => false,
            'preferred_branch' => $preferredBranch,

            // for sunnies
            'unit' => 'Live at ' . $this->address . ' and current status in suntrack is ' . $this->status,
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
