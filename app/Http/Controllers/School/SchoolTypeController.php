<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SchoolType;

class SchoolTypeController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $schoolTypes = SchoolType::where("name", "like", "%{$req->search}%")
                ->paginate(100);
        } else {
            $schoolTypes = SchoolType::paginate(100);
        }

        return view('pages.schooltype.index', compact('schoolTypes'));
    }

    public function add(){
        return view('pages.schooltype.add');
    }

    public function postAdd(Request $req){
        $req->validate([
            'name' => 'required',
        ]);

        $schoolType = new SchoolType();
        $schoolType->fill($req->all());
        $schoolType->save();

        return redirect(route('indexSchoolType'));
    }

    public function edit($id){
        $schoolType = SchoolType::find($id);

        if (!is_null($schoolType)) {
            return view('pages.schooltype.edit', compact('schoolType'));
        }
    }

    public function update(Request $req, $id){
        $req->validate([
            'name' => 'required',
        ]);

        $schoolType = SchoolType::find($id);
        $schoolType->name = $req->name;

        if ($schoolType->save()) {
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.schooltype.edit', compact('schoolType','saved'));
    }

    public function delete($id){
        $schoolType = SchoolType::find($id);
        if(!is_null($schoolType)){
            return view('pages.schooltype.delete', compact('schoolType'));
        }
    }

    public function confirmDelete(Request $req){
        // $req->validate([
        //     'school_id' => 'required',
        // ]);

        $schoolType = SchoolType::find($req->school_id);
        $schoolType->delete();

        return redirect(route('indexSchoolType'));
    }
}
