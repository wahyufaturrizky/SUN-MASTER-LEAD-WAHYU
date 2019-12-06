<?php

namespace App\Http\Controllers\PostalCode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PostalCode;

class PostalCodeController extends Controller
{
    public function index(Request $request){
        $search = $request->search;
        if($search){
            $postalCodes = PostalCode::where("kelurahan", "like", "%{$search}%")
                ->orwhere("postal_code_number", "like", "%{$search}%")
                ->orwhere("kecamatan", "like", "%{$search}%")
                ->orwhere("kabupaten", "like", "%{$search}%")
                ->orwhere("propinsi", "like", "%{$search}%")
                ->paginate(100);
            return view('pages.postalcode.index', compact('postalCodes'));
        } else {
            $postalCodes = PostalCode::paginate(100);
            return view('pages.postalcode.index', compact('postalCodes'));
        } ;
    }

    public function add(Request $req){
        $req->validate([
            'postal_code_number' => 'required',
        ]);

        $school = new PostalCode();
        $school->fill($req->all());
        $school->save();

        return redirect(route('indexPostalCode'));
    }

    public function edit($id){
        $postalCode = PostalCode::find($id);
        if(!is_null($postalCode)){
            return view('pages.postalcode.edit', compact('postalCode'));
        }
    }

    public function update(Request $req, $id){
        $req->validate([
            'postal_code_id' => 'required',
        ]);

        $postalCode = PostalCode::find($req->postal_code_id);
        $postalCode->postal_code_number = $req->postal_code_number;
        $postalCode->kelurahan = $req->kelurahan;
        $postalCode->kecamatan = $req->kecamatan;
        $postalCode->jenis = $req->jenis;
        $postalCode->kabupaten = $req->kabupaten;
        $postalCode->propinsi = $req->propinsi;

        if($postalCode->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.postalcode.edit', compact('postalCodes', 'saved'));
    }
}
