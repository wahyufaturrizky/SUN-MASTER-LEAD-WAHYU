<?php

namespace App\Http\Resources\Integration\Sunnies;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MasterDataEventRegistrationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "count" => 0,
            "data"  => MasterDataEventRegistrationResource::collection($this->collection),
            // $collection->filter(function ($value) { return !is_null($value); });
            "end"   => 0,
            "page"  => "1",
            "pages" => 1,
            "query" => "",
            "start" => 1,
        ];

        // count: "55"
        // data: [{leads_id: "LEADS.19.05.22.0572", student_id: "", register_id: "SRB-MUI0004", ssa_no: "",…},…]
        // end: 55
        // page: "1"
        // pages: 1
        // query: "CALL SelectPaging('leads_id, student_id, register_id, parents_name, parents_mobile, full_name, nick_name, address, zip_code, kelurahan, kecamatan, dt2, kabupaten, provinsi, phone, mobile, email, DATE_FORMAT(birth,''%Y-%m-%d'') AS birth, gender, highest_edu_id, highest_edu, precur_school_id, precur_school, destination_of_study_id, destination_of_study, major_interested_id, major_interested, program_interested_id, program_interested, planning_year, marketing_source_id, marketing_source, has_contact_sun, branch_id, branch_name, other_branch_id, other_branch_name, register_type, comment_flag, is_commented, is_ielts_participant, ielts_result, manage_by, is_branching_auto, status, created_by, UPPER(created_by_name) AS created_by_name, modified_by, UPPER(modified_by_name) AS modified_by_name, DATE_FORMAT(created_date,''%Y-%m-%d %H:%i'') AS created_date, DATE_FORMAT(modified_date,''%Y-%m-%d %H:%i'') AS modified_date, event_id, event_name, DATE_FORMAT(event_date,''%Y-%m-%d'') AS event_date, pict_profile, (CASE WHEN created_date < '''' THEN ''1'' ELSE ''0'' END) AS is_prereg, (CASE WHEN FIND_IN_SET(''PreRegCome2Expo'',IFNULL(tags,''''))>0 THEN ''1'' ELSE ''0'' END) AS is_preregcome','leads_id','r_student',1,75,'(is_delete IS NULL OR is_delete IS FALSE) AND status IN (''register'',''branching'') AND (manage_by IS NULL OR manage_by='''') AND NOT FIND_IN_SET(''SendBack'',IFNULL(tags,'''')) AND NOW() >= DATE_ADD(event_date, INTERVAL 1 DAY)','full_name ASC','','')"
        // start: 1
    }
}
