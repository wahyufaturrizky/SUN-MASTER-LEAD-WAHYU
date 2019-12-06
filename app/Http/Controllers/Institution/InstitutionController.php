<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Institution;
use App\Country;

class InstitutionController extends Controller
{
    public function index(Request $req){
        // dd();
        $institutions = Institution::where('institution_name','!=','');
        $countries = Country::whereIn('country_code', Institution::select('country_id')->distinct('country_id')->get()->pluck('country_id')->toArray())->get();
        if($req->has('search')){
            $institutions->where('institution_name','LIKE', '%' . $req->search . '%');
            $search = $req->search;
        } else {
            $search = '';
        }

        if($req->has('country_id')){
            $institutions->where('country_id','LIKE', '%' . $req->country_id . '%');
            $country_id = $req->country_id;
        } else {
            $country_id = '';
        }

        $institutions = $institutions->paginate(50);

        return view('pages.institution.index', compact('institutions','countries','search','country_id'));
    }

    public function add(){
        $countries = Country::all();
        return view('pages.institution.add', compact('countries'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'institution_name' => 'required',
            // 'acronym' => 'required',
            'country_id' => 'required',
            'is_partnership' => 'required',
        ]);

        $institution = new Institution();
        $institution->fill($req->all());
        $institution->save();

        return redirect(route('indexInstitution'));
    }

    public function edit($id){
        $countries = Country::all();
        $institution = Institution::find($id);
        if(!is_null($institution)){
            return view('pages.institution.edit', compact('institution','countries'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'institution_id' => 'required',
            'institution_name' => 'required',
            // 'acronym' => 'required',
            'country_id' => 'required',
            'is_partnership' => 'required',
        ]);

        $countries = Country::all();

        $institution = Institution::find($req->institution_id);
        $institution->fill($req->all());

        if($institution->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.institution.edit', compact('institution', 'countries', 'saved'));
    }

    public function delete($id){
        $countries = Country::all();
        $institution = Institution::find($id);
        if(!is_null($institution)){
            return view('pages.institution.delete', compact('institution','countries'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'institution_id' => 'required',
        ]);

        $institution = Institution::find($req->institution_id);
        $institution->delete();

        return redirect(route('indexInstitution'));
    }

}
