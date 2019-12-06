<?php

namespace App\Http\Controllers\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Country;

class CountryController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $countries = Country::where('country_name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $countries = Country::paginate(50);
            $search = '';
        }

        return view('pages.country.index', compact('countries','search'));
    }

    public function add(){
        return view('pages.country.add');
    }

    public function postAdd(Request $req){
        $req->validate([
            'country_name' => 'required',
            'country_code' => 'required',
            'sun_destination' => 'required',
        ]);
        // Check Country Code
        if(Country::where('country_code', $req->country_code)->count() > 0){
            $error = 'Duplicated country code. Please check country code and submit again.';
            $country = $req;
            return view('pages.country.add', compact('error','country'));
        }

        $country = new Country();
        $country->fill($req->all());
        $country->save();

        return redirect(route('indexCountry'));
    }

    public function edit($id){
        $country = Country::find($id);
        if(!is_null($country)){
            return view('pages.country.edit', compact('country'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'country_id' => 'required',
            'country_name' => 'required',
            'country_code' => 'required',
            'sun_destination' => 'required',
        ]);

        $country = Country::find($req->country_id);

        // Check Country Code
        $countryCode = Country::where('country_code', $req->country_code)->first();
        if($countryCode->country_id != $country->country_id){
            $error = 'Duplicated country code. Please check country code and submit again.';
            return view('pages.country.edit', compact('error','country'));
        }

        $country->country_id = $req->country_id;
        $country->fill($req->all());

        if($country->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.country.edit', compact('country', 'saved'));
    }

    public function delete($id){
        $country = Country::find($id);
        if(!is_null($country)){
            return view('pages.country.delete', compact('country'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'country_id' => 'required',
        ]);

        $country = Country::find($req->country_id);
        $country->delete();

        return redirect(route('indexCountry'));
    }

}
