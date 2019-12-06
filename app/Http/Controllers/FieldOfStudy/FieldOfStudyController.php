<?php

namespace App\Http\Controllers\FieldOfStudy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\FieldOfStudy;

class FieldOfStudyController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $fieldOfStudies = FieldOfStudy::where('field_of_study_name','LIKE', '%' . $req->search . '%')->paginate(50);
        } else {
            $fieldOfStudies = FieldOfStudy::paginate(50);
        }

        return view('pages.fieldofstudy.index', compact('fieldOfStudies'));
    }

    public function add(){
        return view('pages.fieldofstudy.add');
    }

    public function postAdd(Request $req){
        $req->validate([
            'field_of_study_name' => 'required',
        ]);

        $fieldOfStudy = new FieldOfStudy();
        $fieldOfStudy->fill($req->all());
        $fieldOfStudy->save();

        return redirect(route('indexFieldOfStudy'));
    }

    public function edit($id){
        $fieldOfStudy = FieldOfStudy::find($id);
        if(!is_null($fieldOfStudy)){
            return view('pages.fieldofstudy.edit', compact('fieldOfStudy'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'field_of_study_id' => 'required',
            'field_of_study_name' => 'required',
        ]);

        $fieldOfStudy = FieldOfStudy::find($req->field_of_study_id);
        $fieldOfStudy->field_of_study_id = $req->field_of_study_id;
        $fieldOfStudy->field_of_study_name = $req->field_of_study_name;

        if($fieldOfStudy->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.fieldofstudy.edit', compact('fieldOfStudy', 'saved'));
    }
}
