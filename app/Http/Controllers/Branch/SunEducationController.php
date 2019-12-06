<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BranchSunEducation;
use App\BranchSunEnglish;

class SunEducationController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $branches = BranchSunEducation::where('branch_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $branches = BranchSunEducation::paginate(50);
            $search = '';
        }

        return view('pages.branch.suneducation.index', compact('branches','search'));
    }

    public function add(){
        $sunEnglishBranches = BranchSunEnglish::all();
        return view('pages.branch.suneducation.add', compact('sunEnglishBranches'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'branch_area' => 'required',
        ]);

        $branch = new BranchSunEducation();
        $branch->branch_name = $req->branch_name;
        $branch->branch_code = $req->branch_code;
        $branch->branch_area = $req->branch_area;
        $branch->branch_coverage = $req->branch_coverage;
        $branch->branch_sun_english_id = $req->branch_sun_english_id;
        $branch->save();

        return redirect(route('indexBranchSunEducation'));
    }

    public function edit($id){
        $branch = BranchSunEducation::find($id);
        $sunEnglishBranches = BranchSunEnglish::all();
        if(!is_null($branch)){
            return view('pages.branch.suneducation.edit', compact('branch','sunEnglishBranches'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'branch_sun_education_id' => 'required',
            'branch_name' => 'required',
        ]);
        $sunEnglishBranches = BranchSunEnglish::all();

        $branch = BranchSunEducation::find($req->branch_sun_education_id);
        $branch->branch_sun_education_id = $req->branch_sun_education_id;
        $branch->branch_name = $req->branch_name;
        $branch->branch_code = $req->branch_code;
        $branch->branch_area = $req->branch_area;
        $branch->branch_coverage = $req->branch_coverage;
        $branch->branch_sun_english_id = $req->branch_sun_english_id;

        if($branch->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.branch.suneducation.edit', compact('branch', 'saved','sunEnglishBranches'));
    }

    public function delete($id){
        $branch = BranchSunEducation::find($id);
        $sunEnglishBranches = BranchSunEnglish::all();
        if(!is_null($branch)){
            return view('pages.branch.suneducation.delete', compact('branch','sunEnglishBranches'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'branch_sun_education_id' => 'required',
        ]);

        $branch = BranchSunEducation::find($req->branch_sun_education_id);
        $branch->delete();

        return redirect(route('indexBranchSunEducation'));
    }
}
