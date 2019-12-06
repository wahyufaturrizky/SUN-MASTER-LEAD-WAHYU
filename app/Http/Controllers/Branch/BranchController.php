<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Branch;

class BranchController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $branches = Branch::where('branch_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $branches = Branch::paginate(50);
            $search = '';
        }

        return view('pages.branch.index', compact('branches','search'));
    }

    public function add(){
        return view('pages.branch.add');
    }

    public function postAdd(Request $req){
        $req->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'branch_area' => 'required',
        ]);

        $branch = new Branch();
        $branch->fill($req->all());
        $branch->save();

        return redirect(route('indexBranch'));
    }

    public function edit($id){
        $branch = Branch::find($id);
        if(!is_null($branch)){
            return view('pages.branch.edit', compact('branch'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'branch_id' => 'required',
            'branch_name' => 'required',
        ]);

        $branch = Branch::find($req->branch_id);
        $branch->branch_id = $req->branch_id;
        $branch->branch_name = $req->branch_name;
        $branch->branch_code = $req->branch_code;
        $branch->branch_area = $req->branch_area;

        if($branch->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.branch.edit', compact('branch', 'saved'));
    }

    public function delete($id){
        $branch = Branch::find($id);
        if(!is_null($branch)){
            return view('pages.branch.delete', compact('branch'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'branch_id' => 'required',
        ]);

        $branch = Branch::find($req->branch_id);
        $branch->delete();

        return redirect(route('indexBranch'));
    }

}
