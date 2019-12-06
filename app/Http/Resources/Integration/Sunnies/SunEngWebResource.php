<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\JsonResource;

class SunEngWebResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'leads_source' => 'Sun Eng Web',
            'is_duplicate' => false,

            // for sunnies
            'unit' => 'Live at ' . $this->address,
        ];
    }
}
