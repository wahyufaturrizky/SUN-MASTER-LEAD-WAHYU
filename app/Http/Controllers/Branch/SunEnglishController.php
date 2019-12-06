<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BranchSunEducation;
use App\BranchSunEnglish;
use App\Remote\Suntrack\Branch as SuntrackBranch;

class SunEnglishController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $branches = BranchSunEnglish::where('branch_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $branches = BranchSunEnglish::paginate(50);
            $search = '';
        }

        return view('pages.branch.sunenglish.index', compact('branches','search'));
    }

    public function add(){
        $sunEducationBranches = BranchSunEducation::all();
        return view('pages.branch.sunenglish.add', compact('sunEducationBranches'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'branch_name' => 'required',
            'branch_code' => 'required|max:10',
            'branch_area' => 'required',
        ]);

        // Master Data Branch
        $branch = new BranchSunEnglish();
        $branch->branch_name = $req->branch_name;
        $branch->branch_code = $req->branch_code;
        $branch->branch_area = $req->branch_area;
        $branch->branch_coverage = $req->branch_coverage;
        $branch->branch_sun_education_id = $req->branch_sun_education_id;
        if($branch->save()){
            $branchSuntrack = new SuntrackBranch();
            $branchSuntrack->branch_name = $branch->branch_name;
            $branchSuntrack->branch_code = $branch->branch_code;
            $branchSuntrack->branch_area = $branch->branch_area;
            $branchSuntrack->branch_coverage = $branch->branch_coverage;
            $branchSuntrack->is_enabled = 'Yes';
            if($branchSuntrack->save()){
                $branch->branch_uuid = $branchSuntrack->branch_uuid;
                $branch->save();
            }
        }

        // Sun Track Branch


        return redirect(route('indexBranchSunEnglish'));
    }

    public function edit($id){
        $branch = BranchSunEnglish::find($id);
        $sunEducationBranches = BranchSunEducation::all();
        if(!is_null($branch)){
            return view('pages.branch.sunenglish.edit', compact('branch','sunEducationBranches'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'branch_sun_english_id' => 'required',
            'branch_code' => 'max:10',
            'branch_name' => 'required',
        ]);
        $sunEducationBranches = BranchSunEducation::all();

        $branch = BranchSunEnglish::find($req->branch_sun_english_id);
        $branch->branch_sun_english_id = $req->branch_sun_english_id;
        $branch->branch_name = $req->branch_name;
        $branch->branch_code = $req->branch_code;
        $branch->branch_area = $req->branch_area;
        $branch->branch_coverage = $req->branch_coverage;
        $branch->branch_sun_education_id = $req->branch_sun_education_id;

        if($branch->save()){
            $branchSuntrack = SuntrackBranch::where('branch_uuid', $branch->branch_uuid)->first();
            $branchSuntrack->branch_name = $branch->branch_name;
            $branchSuntrack->branch_code = $branch->branch_code;
            $branchSuntrack->branch_area = $branch->branch_area;
            $branchSuntrack->branch_coverage = $branch->branch_coverage;
            $branchSuntrack->save();
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.branch.sunenglish.edit', compact('branch', 'saved','sunEducationBranches'));
    }

    public function delete($id){
        $branch = BranchSunEnglish::find($id);
        $sunEducationBranches = BranchSunEducation::all();
        if(!is_null($branch)){
            return view('pages.branch.sunenglish.delete', compact('branch','sunEducationBranches'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'branch_sun_english_id' => 'required',
        ]);

        $branch = BranchSunEnglish::find($req->branch_sun_english_id);
        $branch_uuid = $branch->branch_uuid;

        if($branch->delete()){
            $branchSuntrack = SuntrackBranch::find($branch_uuid);
            $branchSuntrack->is_enabled = 'No';
            $branchSuntrack->save();
        }

        return redirect(route('indexBranchSunEnglish'));
    }
}
