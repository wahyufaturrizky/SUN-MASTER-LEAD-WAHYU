<?php

namespace App\Http\Controllers\Institution;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Institution;
use App\InstitutionGroup;
use App\InstitutionContact;

class ContactController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $institutionContacts = InstitutionContact::where('name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $institutionContacts = InstitutionContact::paginate(50);
            $search = '';
        }

        return view('pages.institution.contact.index', compact('institutionContacts','search'));
    }

    public function add(){
        $institutions = Institution::all();
        $institutionGroups = InstitutionGroup::all();
        return view('pages.institution.contact.add', compact('institutions','institutionGroups'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'type' => 'required',
            // 'reference_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            // 'address' => 'required',
            // 'phone' => 'required',
            // 'email' => 'required',
        ]);

        $institutionContact = new InstitutionContact();

        if($req->type == 'Institution'){
            $req->validate([
                'institution_id' => 'required',
            ]);

            $institutionContact->reference_id = $req->institution_id;
        }

        if($req->type == 'Group'){
            $req->validate([
                'institution_group_id' => 'required',
            ]);

            $institutionContact->reference_id = $req->institution_group_id;
        }

        $institutionContact->fill($req->all());
        $institutionContact->save();

        return redirect(route('indexInstitutionContact'));
    }

    public function edit($id){
        $institutions = Institution::all();
        $institutionGroups = InstitutionGroup::all();
        $institutionContact = InstitutionContact::find($id);
        if(!is_null($institutionContact)){
            return view('pages.institution.contact.edit', compact('institutionContact','institutions','institutionGroups'));
        } else {
            return redirect(route('indexInstitutionContact'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'institution_contact_id' => 'required',
            'type' => 'required',
            // 'reference_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            // 'address' => 'required',
            // 'phone' => 'required',
            // 'email' => 'required',
        ]);

        $institutions = Institution::all();
        $institutionGroups = InstitutionGroup::all();

        $institutionContact = InstitutionContact::find($req->institution_contact_id);

        if($req->type == 'Institution'){
            $req->validate([
                'institution_id' => 'required',
            ]);

            $institutionContact->reference_id = $req->institution_id;
        }

        if($req->type == 'Group'){
            $req->validate([
                'institution_group_id' => 'required',
            ]);

            $institutionContact->reference_id = $req->institution_group_id;
        }

        $institutionContact->fill($req->all());

        if($institutionContact->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.institution.contact.edit', compact('institutionContact', 'institutions', 'institutionGroups', 'saved'));
    }

    public function delete($id){
        $institutions = Institution::all();
        $institutionGroups = InstitutionGroup::all();
        $institutionContact = InstitutionContact::find($id);
        if(!is_null($institutionContact)){
            return view('pages.institution.contact.delete', compact('institutionContact','institutions','institutionGroups'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'institution_contact_id' => 'required',
        ]);

        $institutionContact = InstitutionContact::find($req->institution_contact_id);
        $institutionContact->delete();

        return redirect(route('indexInstitutionContact'));
    }

}
