<?php

namespace App\Http\Controllers\Major;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Major;
use App\FieldOfStudy;

class MajorController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $majors = Major::where('major_name','LIKE', '%' . $req->search . '%')->paginate(50);
        } else {
            $majors = Major::paginate(50);
        }
        
        $fieldOfStudies = FieldOfStudy::all();

        return view('pages.major.index', compact('majors','fieldOfStudies'));
    }


    public function getDataByFieldOfStudy(Request $req, $field_of_study_id = null){
        if($req->has('search')){
            $majors = Major::where('field_of_study_id', $field_of_study_id)->where('major_name','LIKE', '%' . $req->search . '%')->paginate(50);
        } else {
            $majors = Major::where('field_of_study_id', $field_of_study_id)->paginate(50);
        }
        
        $fieldOfStudies = FieldOfStudy::all();

        return view('pages.major.index', compact('majors','fieldOfStudies'));
    }

    public function add(){
        $fieldOfStudies = FieldOfStudy::all();

        return view('pages.major.add', compact('fieldOfStudies'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'field_of_study_id' => 'required',
            'major_name' => 'required',
        ]);

        $school = new Major();
        $school->fill($req->all());
        $school->save();

        return redirect(route('indexMajor'));
    }

    public function edit($id){
        $major = Major::find($id);
        $fieldOfStudies = FieldOfStudy::all();

        if(!is_null($major)){
            return view('pages.major.edit', compact('major','fieldOfStudies'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'major_id' => 'required',
            'major_name' => 'required',
        ]);

        $fieldOfStudies = FieldOfStudy::all();

        $major = Major::find($req->major_id);
        $major->major_id = $req->major_id;
        $major->major_name = $req->major_name;

        if($major->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.major.edit', compact('major', 'saved','fieldOfStudies'));
    }
}
