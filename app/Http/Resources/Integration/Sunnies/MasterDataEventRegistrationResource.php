<?php

namespace App\Http\Resources\Integration\Sunnies;

use App\EventRegistration;
use Illuminate\Http\Resources\Json\JsonResource;

use App\FStudentRemote;
use App\Branch as MasterDataBranch;
use App\Remote\Sunnies\MBranch as SunniesBranch;

class MasterDataEventRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $checkSunniesLeads = FStudentRemote::where('email', $this->email)->where('birth', $this->birth);
        // if($checkSunniesLeads->count() > 1){

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

            // $count = EventRegistration::where('is_sunnies_leads', false)->where('event_id', $this->event_id)->where('email', $this->email)->where('birth', $this->birth)->get()->count();
            // if($count > 1){
            //     $isDuplicate = true;
            // } else {
            //     $isDuplicate = false;
            // }

            $res = [
                'id' => 'master-data-event-' . $this->event_registration_id,
                'event_id' => $this->event_id,
                'event_type_id' => $this->event_type_id,
                'register_id' => $this->register_id,
                'full_name' => $this->full_name,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'birth' => date_format(date_create($this->birth), 'd.M.y'),
                'gender' => $this->gender,
                'parents_name' => $this->parents_name,
                'parents_mobile' => $this->parents_mobile,
                'address' => $this->address,
                'zip_code' => $this->zip_code,
                'kelurahan' => $this->kelurahan,
                'kecamatan' => $this->kecamatan,
                'dt2' => $this->dt2,
                'kabupaten' => $this->kabupaten,
                'propinsi' => $this->propinsi,
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
                'planning_year' => $this->planning_year,
                'marketing_source_id' => $this->marketing_source_id,
                'marketing_source' => $this->marketing_source,
                'has_contact_sun' => $this->has_contact_sun == 'Yes' ? true : false,
                'branch_id' => $this->branch_id,
                'branch_name' => $this->branch_name,
                'created_at' => date_format(date_create($this->created_at), 'd.M.y H:i'),
                'updated_at' => $this->updated_at,
                'leads_source' => 'Master Data Event',
                'is_duplicate' => false,
                'preferred_branch' => $preferredBranch,
                // 'is_manual_branching' => $isManualBranching,

                // for sunnies
                'unit' => 'Live at ' . $this->address . ' ' . $this->zip_code  . ' ' . $this->propinsi . '. Previous/ Current School at ' . $this->precur_school ,
            ];

            $eventRegistrations = EventRegistration::where('email', $this->email)->where('birth', $this->birth)->select('email','birth')->orderBy('created_at','desc');
            if($eventRegistrations->count() > 1){
                if($eventRegistrations->first()->created_date == $this->created_date){
                    return $res;
                }
            } else {
                return $res;
            }
        // }

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
