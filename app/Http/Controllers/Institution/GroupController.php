<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Institution;
use App\InstitutionGroup;
use App\InstitutionGroupDetail;

class GroupController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $institutionGroups = InstitutionGroup::where('institution_group_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $institutionGroups = InstitutionGroup::paginate(50);
            $search = '';
        }

        return view('pages.institution.group.index', compact('institutionGroups','search'));
    }

    public function add(){
        $institutions = Institution::all();
        return view('pages.institution.group.add', compact('institutions'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'institution_group_name' => 'required',
            'institution_ids' => 'required',
        ]);

        $institutionGroup = new InstitutionGroup();
        $institutionGroup->institution_group_name = $req->institution_group_name;
        if($institutionGroup->save()){
            if(is_array($req->institution_ids)){
                foreach($req->institution_ids as $institution_id){
                    $groupDetail = new InstitutionGroupDetail();
                    $groupDetail->institution_group_id = $institutionGroup->institution_group_id;
                    $groupDetail->institution_id = $institution_id;
                    $groupDetail->save();
                }
            }
        }

        return redirect(route('indexInstitutionGroup'));
    }

    public function edit($id){
        $institutions = Institution::all();
        $institutionGroup = InstitutionGroup::find($id);
        if(!is_null($institutionGroup)){
            return view('pages.institution.group.edit', compact('institutionGroup','institutions'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'institution_group_id' => 'required',
            'institution_group_name' => 'required',
            'institution_ids' => 'required',
        ]);

        $institutions = Institution::all();

        $institutionGroup = InstitutionGroup::find($req->institution_group_id);
        $institutionGroup->institution_group_name = $req->institution_group_name;
        if($institutionGroup->save()){
            if(is_array($req->institution_ids)){
                InstitutionGroupDetail::where('institution_group_id', $req->institution_group_id)->delete();
                foreach($req->institution_ids as $institution_id){
                    $groupDetail = new InstitutionGroupDetail();
                    $groupDetail->institution_group_id = $institutionGroup->institution_group_id;
                    $groupDetail->institution_id = $institution_id;
                    $groupDetail->save();
                }
            }
        }

        if($institutionGroup->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.institution.group.edit', compact('institutionGroup', 'institutions', 'saved'));
    }

    public function delete($id){
        $institutions = Institution::all();
        $institutionGroup = InstitutionGroup::find($id);
        if(!is_null($institutionGroup)){
            return view('pages.institution.group.delete', compact('institutionGroup','institutions'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'institution_group_id' => 'required',
        ]);

        $institutionGroup = InstitutionGroup::find($req->institution_group_id);
        $institutionGroup->delete();

        return redirect(route('indexInstitutionGroup'));
    }

}
