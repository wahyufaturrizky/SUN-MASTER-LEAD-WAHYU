<?php

namespace App\Http\Controllers\School;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Imports\SchoolImport;
use Maatwebsite\Excel\Facades\Excel;

use App\School;
use App\SchoolType;
use App\Country;

class SchoolController extends Controller
{
    public function index(Request $req)
    {
        $count = $this->getCount();
        $schoolTypes = SchoolType::all();
        $countries = Country::all();

        if($req->has('search')){
            $schools = School::where("name", "like", "%{$req->search}%")
                ->orwhere("kecamatan", "like", "%{$req->search}%")
                ->orwhere("kabupaten", "like", "%{$req->search}%")
                ->orwhere("propinsi", "like", "%{$req->search}%")
                ->paginate(100);
        } else {
            $schools = School::paginate(100);
        }

        return view('pages.school.index', compact('schools', 'schoolTypes', 'countries', 'count'));
    }

    public function getByType($type)
    {
        switch ($type) {
            case 'sma':
                $schools = School::where('name', 'like', "%SMA%")->paginate(100);
                break;
            case 'smk':
                $schools = School::where('name', 'like', "%SMK%")->paginate(100);
                break;
            case 'akademi':
                // $schools = School::where('name', 'like', "%AMIK%")->paginate(100);
                $schools = School::where('name', 'like', "%Akademi%")
                    ->where("name", "not like", "%SD%")
                    ->where("name", "not like", "%SMP%")
                    ->where("name", "not like", "%SMA%")
                    ->where("name", "not like", "%SMK%")
                    ->where("name", "not like", "%STM%")
                    ->paginate(100);
                break;
            case 'sekolah-tinggi':
                $schools = School::where('name', 'like', "%Sekolah Tinggi%")
                    ->where("name", "not like", "%SMP%")
                    ->where("name", "not like", "%SMA%")
                    ->where("name", "not like", "%SMK%")
                    ->paginate(100);
                break;
            case 'institut':
                $schools = School::where('name', 'like', "%Institut%")
                    ->where("name", "not like", "%SMP%")
                    ->where("name", "not like", "%SMA%")
                    ->where("name", "not like", "%SMK%")
                    ->paginate(100);
                break;
            case 'politeknik':
                $schools = School::where('name', 'like', "%Politeknik%")
                    ->where("name", "not like", "%SMP%")
                    ->where("name", "not like", "%SMA%")
                    ->where("name", "not like", "%SMK%")
                    ->paginate(100);
                break;
            case 'universitas':
                $schools = School::where('name', 'like', "%Universitas%")
                    ->where("name", "not like", "%SMP%")
                    ->where("name", "not like", "%SMA%")
                    ->where("name", "not like", "%SMK%")
                    ->paginate(100);
                break;
            case 'other':
                $schools = School::where('name', 'like', "%SMP%")
                    ->orwhere('name', 'like', "%SD%")
                    ->paginate(100);
                break;
            default:
                return back();
        }

        $schoolTypes = SchoolType::all();
        $countries = Country::all();
        $count = $this->getCount();
        return view('pages.school.index', compact('schools', 'count','schoolTypes', 'countries'));
    }

    public function add()
    {
        $schoolTypes = SchoolType::all();
        $countries = Country::all();

        return view('pages.school.add', compact('schoolTypes', 'countries'));
    }

    public function postAdd(Request $req)
    {
        $req->validate([
            'name' => 'required',
        ]);

        $school = new School();
        $school->fill($req->all());
        $school->save();

        return redirect(route('indexSchool'));
    }

    public function edit($id)
    {
        $school = School::find($id);
        $schoolTypes = SchoolType::all();
        $countries = Country::all();

        if (!is_null($school)) {
            return view('pages.school.edit', compact('school','schoolTypes', 'countries'));
        }
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'name' => 'required',
        ]);

        $school = School::find($id);
        $school->name = $req->name;
        $school->address = $req->address;
        $school->school_type_id = $req->school_type_id;

        if ($school->save()) {
            $saved = true;
        } else {
            $saved = false;
        }

        $schoolTypes = SchoolType::all();
        $countries = Country::all();

        return view('pages.school.edit', compact('school', 'saved','schoolTypes', 'countries'));
    }

    public function import(Request $req)
    {
        $req->validate([
            'file' => 'required',
        ]);

        Excel::import(new SchoolImport, $req->file('file'));
    }

    public function getCount()
    {
        $data = [
            'sd' => School::where('name', 'like', "%SD%")->count(),
            'smp' => School::where('name', 'like', "%SMP%")->count(),
            'sma' => School::where('name', 'like', "%SMA%")->count(),
            'smk' => School::where('name', 'like', "%SMK%")->count(),
            'akademi' => School::where('name', 'like', "%Akademi%")
                ->where("name", "not like", "%SD%")
                ->where("name", "not like", "%SMP%")
                ->where("name", "not like", "%SMA%")
                ->where("name", "not like", "%SMK%")
                ->where("name", "not like", "%STM%")
                ->count(),
            'sekolahTinggi' => School::where('name', 'like', "%ST%")
                ->where("name", "not like", "%SMP%")
                ->where("name", "not like", "%SMA%")
                ->where("name", "not like", "%SMK%")
                ->count(),
            'institut' => School::where('name', 'like', "%Institut%")
                ->where("name", "not like", "%SMP%")
                ->where("name", "not like", "%SMA%")
                ->where("name", "not like", "%SMK%")
                ->count(),
            'politeknik' => School::where('name', 'like', "%Politeknik%")
                ->where("name", "not like", "%SMP%")
                ->where("name", "not like", "%SMA%")
                ->where("name", "not like", "%SMK%")
                ->count(),
            'universitas' => School::where('name', 'like', "%Universitas%")
                ->where("name", "not like", "%SMP%")
                ->where("name", "not like", "%SMA%")
                ->where("name", "not like", "%SMK%")
                ->count(),
        ];
        return $data;
    }

    public function delete($id){
        $school = School::find($id);
        if(!is_null($school)){
            return view('pages.school.delete', compact('school'));
        }
    }

    public function confirmDelete(Request $req){
        // $req->validate([
        //     'school_id' => 'required',
        // ]);

        $school = School::find($req->school_id);
        $school->delete();

        return redirect(route('indexSchool'));
    }

}
