<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $roles = Role::where('name','!=','admin')->where('name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $roles = Role::where('name','!=','admin')->paginate(50);
            $search = '';
        }

        return view('pages.user.role.index', compact('roles','search'));
    }

    public function add(){
        $roles = Role::where('name','!=','admin')->get();
        return view('pages.user.role.add', compact('roles'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'name' => 'required',
        ]);

        $user = new Role();
        $user->name = $req->name;
        $user->save();

        return redirect(route('indexRoleUser'));
    }

    public function edit($id){
        $roles = Role::where('name','!=','admin')->get();
        $user = Role::find($id);
        if(!is_null($user)){
            return view('pages.user.role.edit', compact('user','roles'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'id' => 'required',
        ]);

        $roles = Role::where('name','!=','admin')->get();
        $user = Role::find($req->id);
        if($req->has('password')){
            if(!is_null($req->password) && !empty($req->password)){
                $user->password = bcrypt($req->password);
            }
        }
        $user->fill($req->all());

        if($user->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.user.role.edit', compact('user', 'saved', 'roles'));
    }

    public function delete($id){
        $roles = Role::where('name','!=','admin')->get();
        $user = Role::find($id);
        if(!is_null($user)){
            return view('pages.user.role.delete', compact('user','roles'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'id' => 'required',
        ]);

        $user = Role::find($req->id);
        $user->delete();

        return redirect(route('indexRoleUser'));
    }

}
