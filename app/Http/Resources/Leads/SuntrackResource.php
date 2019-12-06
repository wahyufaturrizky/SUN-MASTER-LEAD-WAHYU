<?php

namespace App\Http\Resources\Leads;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->leads_uuid,
            'leads_id' => $this->leads_id,
            'created_by' => $this->created_by,
            'branch_uuid' => $this->branch_uuid,
            'student_id' => $this->student_id,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'dob' => $this->dob,
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
            'created_at' => $this->created_at,

            // for sunnies
            'unit' => 'Live at ' . $this->address . ' and current status in suntrack is ' . $this->status,
        ];
    }
}
