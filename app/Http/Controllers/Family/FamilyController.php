<?php

namespace App\Http\Controllers\Family;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Family;
use App\Sibling;

class FamilyController extends Controller
{
    public function index(){
        // $families = Family::paginate(100);
        // return view('pages.family.index', compact('families')); 

        $families = Family::paginate(100);
        return view('pages.family.index', compact('families'));

    }

    public function add(Request $request)
    {

        // \App\Family::create($request->all());        
        // \App\Sibling::create($request->all());

    //    \App\Family::create(['familyCard_id' => $request->$familyCard_id]);
        
        // $id = \App\Family::create([

        //     'familyCard_id' => $request->familyCard_id,
        //     'familyName' => $request->familyName,
        //     'email' => $request->email,
        //     'familyMobilePhone' => $request->familyMobilePhone,
        //     'homeAddressPhone' => $request->homeAddressPhone,
        //     'fatherName' => $request->fatherName,
        //     'dobf' => $request->dobf,
        //     'motherName' => $request->motherName,
        //     'dobm' => $request->dobm,
        //     'postCode' => $request->postCode,
        //     'address' => $request->address
            
        //     ]);

        

        // $gambar = Gambar::create(['file'=> $nama_file]);
      
        // $post = Post::create(['idgambar'=>$gambar->id]);
        
        // \App\Sibling::create(['siblingName' => $request->siblingName, 'id_families' => $id->id_families]);
        
        return redirect(route('indexFamily'));

    }

    public function delete($familyCard_id){
        $family = Family::find($familyCard_id);
        $family->delete($family);

        return redirect(route('indexFamily'));
    }

    public function form(){

        return view('pages.family.add');
    }

    public function view($id_families){
       
        // $detail = \App\Family::where('id_families', $id_families)->get(); 
        $detail = \App\Family::find($id_families);
        return view('pages.family.view', compact('detail'));
    }

    // public function edit($id){
    //     $family = Family::find($id);
    //     if(!is_null($family)){
    //         return view('pages.family.edit', compact('family'));
    //     }
    // }

    // public function update(Request $req, $id){
    //     $req->validate([
    //         'name' => 'required',
    //         'slug' => 'required',
    //     ]);

    //     $family = Family::find($id);
    //     $family->name = $req->name;
    //     $family->slug = $req->slug;

    //     if($family->save()){
    //         $saved = true;
    //     } else {
    //         $saved = false;
    //     }

    //     return view('pages.family.edit', compact('family', 'saved'));
    // }
}
