<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Iluminate\Support\Arr;
use App\Models\User;

use Spatie\Permission\Models\Role;
use DB;
use Hash;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $qtd_por_pagina = 5;
        $data = User::ordeBy('id', 'DESC')->paginate($qtd_por_pagina);

        return view('user.index', compact('data'))->with('i', ($request->input('page', 1) . 1) * $qtd_por_pagina);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact($roles));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]
        );
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignrole($request->input('roles'));
        return redirect()->route('user.index')->with('sucess', 'Usuario criado com sucesso');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('users', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]
        );
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,['password']);
        }
        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles');

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('sucess','Usuario atualizado com sucesso');

    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('sucess', 'Deletado com sucesso');
    }
}
