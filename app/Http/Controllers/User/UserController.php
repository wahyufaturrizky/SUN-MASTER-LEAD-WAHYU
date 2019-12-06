<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(Request $req){
        if($req->has('search')){
            $users = User::where('email','!=','admin@admin.com')->where('name','LIKE', '%' . $req->search . '%')->paginate(50);
            $search = $req->search;
        } else {
            $users = User::where('email','!=','admin@admin.com')->paginate(50);
            $search = '';
        }

        return view('pages.user.index', compact('users','search'));
    }

    public function add(){
        $roles = Role::where('name','!=','Super Admin')->get();
        return view('pages.user.add', compact('roles'));
    }

    public function postAdd(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role_name' => 'required',
        ]);

        $user = new User();
        $user->fill($req->all());
        $user->password = bcrypt($req->password);
        $user->save();
        $user->assignRole($req->role_name);

        return redirect(route('indexUser'));
    }

    public function edit($id){
        $roles = Role::where('name','!=','Super Admin')->get();
        $user = User::find($id);
        if(!is_null($user)){
            return view('pages.user.edit', compact('user','roles'));
        }
    }

    public function update(Request $req){
        $req->validate([
            'id' => 'required',
        ]);

        $roles = Role::where('name','!=','Super Admin')->get();
        $user = User::find($req->id);
        if($req->has('password')){
            if(!is_null($req->password) && !empty($req->password)){
                $user->password = bcrypt($req->password);
            }
        }
        $user->fill($req->all());
        $user->assignRole($req->role_name);

        if($user->save()){
            $saved = true;
        } else {
            $saved = false;
        }

        return view('pages.user.edit', compact('user', 'saved', 'roles'));
    }

    public function delete($id){
        $roles = Role::where('name','!=','Super Admin')->get();
        $user = User::find($id);
        if(!is_null($user)){
            return view('pages.user.delete', compact('user','roles'));
        }
    }

    public function confirmDelete(Request $req){
        $req->validate([
            'id' => 'required',
        ]);

        $user = User::find($req->id);
        $user->delete();

        return redirect(route('indexUser'));
    }

}
