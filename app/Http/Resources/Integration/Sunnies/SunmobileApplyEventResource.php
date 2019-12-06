<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\JsonResource;

class SunmobileApplyEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->apply_event_id,
            'user_id' => $this->user_id,
            'register_id' => $this->register_id,
            'event_type' => $this->event_type,
            'event_id' => $this->event_id,
            'event_name_sunnies' => $this->event_name_sunnies,
            'full_name' => $this->full_name,
            'email' => $this->user,
            'mobile' => $this->mobile,
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
            'provinsi' => $this->provinsi,
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
            'planning_year' => $this->planning_year,
            // 'barcode' => $this->barcode,
            // 'qrcode' => $this->qrcode,

            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'leads_source' => 'Sun Mobile App - Event',
            'is_duplicate' => false,

            // for sunnies
            'unit' => 'Live at ' . $this->address . ' ' . $this->zip_code  . ' ' . $this->provinsi . '. Previous/ Current School at ' . $this->precur_school ,
        ];
    }
}
