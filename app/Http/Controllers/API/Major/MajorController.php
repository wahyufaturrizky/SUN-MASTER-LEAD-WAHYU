<?php

namespace App\Http\Controllers\API\Major;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Major;
use DB;

class MajorController extends Controller
{
    public function getDataForSunnies(){
        if(isset($_GET['query'])){
            $query = str_replace('+',' ',$_GET['query']);
            $majors = Major::join('field_of_studies','field_of_studies.field_of_study_id','majors.field_of_study_id')->where('major_name','LIKE', '%' . $query . '%')->select('major_id as data', DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS value"))->take(100)->get();
        } else {
            $majors = Major::join('field_of_studies','field_of_studies.field_of_study_id','majors.field_of_study_id')->select('major_id as data', DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS value"))->take(100)->get();
        }

        return response()->json([
            'data' => [],
            'query' => $query,
            'suggestions' => $majors,
        ]);
    }
    public function getDataForSunnies2(){
        if(isset($_GET['query'])){
            $query = str_replace('+',' ',$_GET['query']);
            $majors = Major::join('field_of_studies','field_of_studies.field_of_study_id','majors.field_of_study_id')->where('major_name','LIKE', '%' . $query . '%')->select(DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS id"), DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS text"))->take(100)->get();
        } else {
            $majors = Major::join('field_of_studies','field_of_studies.field_of_study_id','majors.field_of_study_id')->select(DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS id"), DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS text"))->take(100)->get();
        }

        return response()->json([
            'data' => $majors,
            'query' => $query,
        ]);
    }

    public function checkMajorSunnies(Request $req){
        $req->validate([
            'major_interested' => 'required',
        ]);

        $majorInterested = explode(' - ', $req->major_interested);
        if(sizeof($majorInterested) <= 1){
            return response()->json([
                'status' => 'Not Found',
            ]);
        } else {
            $school = Major::join('field_of_studies','field_of_studies.field_of_study_id','majors.field_of_study_id')->select('major_name as id', DB::raw("CONCAT(major_name , ' - ' , field_of_study_name) AS text"))->where('major_name', $majorInterested[0])->where('field_of_study_name', $majorInterested[1])->first();
            if(!is_null($school)){
                return response()->json([
                    'status' => 'Found',
                ]);
            } else {
                return response()->json([
                    'status' => 'Not Found',
                ]);
            }

        }
    }
}
