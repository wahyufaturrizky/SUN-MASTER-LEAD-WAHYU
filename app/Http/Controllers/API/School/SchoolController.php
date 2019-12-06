<?php

namespace App\Http\Controllers\API\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\School;

use DB;

class SchoolController extends Controller
{
    public function getDataForSunnies(){
        // $query = $_GET['query'];
        if(isset($_GET['query'])){
            $query = str_replace('+',' ',$_GET['query']);
            $queries = explode(' ', $query);
            // DB::raw("CONCAT(name , ' - ' , kabupaten) AS value")
            // DB::raw("CONCAT(name , ' - ' , kabupaten) AS value")
            // $precurSchoolFStudentRemote = DB::connection('mysql_sunnies')->table('f_student')->select(DB::raw("0 as data"),'precur_school as value')->distinct('precur_school')->where('precur_school','LIKE','%' . $query . '%')->take(10)->get();
            $schools = DB::connection('mysql')->table('schools')->select(DB::raw("0 as data"), 'name as value')
            ->where(function ($q) use ($queries){
                foreach($queries as $query){
                    $q->where('name', 'LIKE', '%' . $query . '%');
                }
            })
            // ->where('name','LIKE','%' . $queries[0] . '%')
            ->take(100)->whereNotNull('name')->where('name','!=','')->get();
            // $schools = $schools->merge($precurSchoolFStudentRemote);
        } else {
            $query = '';
            $schools = DB::connection('mysql')->table('schools')->select(DB::raw("0 as data"), 'name as value')->take(100)->whereNotNull('name')->where('name','!=','')->get();
        }
        return response()->json([
            'data' => [],
            'query' => $query,
            'suggestions' => $schools,
        ]);
        // return response()->json($schools);
    }

    public function getDataForSunnies2(){
        // $query = $_GET['query'];
        if(isset($_GET['query'])){
            $query = str_replace('+',' ',$_GET['query']);
            $queries = explode(' ', $query);
            // DB::raw("CONCAT(name , ' - ' , kabupaten) AS value")
            // DB::raw("CONCAT(name , ' - ' , kabupaten) AS value")
            // $precurSchoolFStudentRemote = DB::connection('mysql_sunnies')->table('f_student')->select(DB::raw("0 as data"),'precur_school as value')->distinct('precur_school')->where('precur_school','LIKE','%' . $query . '%')->take(10)->get();
            $schools = DB::connection('mysql')->table('schools')->select('name as id', 'name as text')
            ->where(function ($q) use ($queries){
                foreach($queries as $query){
                    $q->where('name', 'LIKE', '%' . $query . '%');
                }
            })
            // ->where('name','LIKE','%' . $queries[0] . '%')
            ->take(100)->whereNotNull('name')->where('name','!=','')->get()->toArray();
            // $schools = $schools->merge($precurSchoolFStudentRemote);
        } else {
            $query = '';
            $schools = DB::connection('mysql')->table('schools')->select('name as id', 'name as text')->take(100)->whereNotNull('name')->where('name','!=','')->get()->toArray();
        }

        // if(isset($_GET['current'])){
        //     $current = str_replace('+',' ',$_GET['current']);
        //     $school = School::where('name', $current)->count();
        //     $arr = [
        //         'id' => $current,
        //         'text' => $current,
        //     ];
        //     array_unshift($schools, $arr);
        //     // if($school < 1){
        //     //     $arr = [
        //     //         'id' => $current,
        //     //         'text' => $current,
        //     //     ];
        //     //     array_push($schools, $arr);
        //     // }
        // } else {
        //     $current = '';
        // }

        return response()->json([
            'data' => $schools,
            'query' => $query,
        ]);
    }

    public function checkSchoolSunnies(Request $req){
        $req->validate([
            'precur_school' => 'required',
        ]);

        $school = School::where('name', $req->precur_school)->first();
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
