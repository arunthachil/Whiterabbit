<?php

namespace App\Http\Controllers;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::query()->select([
            'users.id','users.name','users.email',
            'roles.id as role_id',
            'roles.name as role_name'
        ])->leftJoin('model_has_roles', function ($join) {
            $join->on('model_has_roles.model_id', '=', 'users.id')
            ->where('model_has_roles.model_type', '=', 'App\User');
        })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')->get()->toArray();
        return view('auth/users/list',compact('users'));
    }

    public function edit($id)
    {
        $data = array();
        $data['user'] = User::query()->select([
            'users.name','users.email',
            'roles.id as role_id',
            'roles.name as role_name'
        ])->leftJoin('model_has_roles', function ($join) {
            $join->on('model_has_roles.model_id', '=', 'users.id')
            ->where('model_has_roles.model_type', '=', 'App\User');
        })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')->where('users.id',$id)->first()->toArray();
        $data['roles'] = Role::select('id','name')->get()->toarray();
        return view('auth/users/update',compact('data','id'));
    }
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => "email:filter|unique:users,email,{$id},id",
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
        ], []);

        if ($validator->fails()) {
            return redirect('users')->with('status','Validation error');
        }
        $user =  User::where('id', $id)->first();
        $update = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles([$request->role]);
        return redirect('users')->with('status','Successfully updated');
        // return view('auth/users/list',compact('users'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return true;
    }
}
