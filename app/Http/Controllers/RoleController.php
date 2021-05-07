<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $qtd_por_pagina = 5;

        $roles = Role::orderBy('id', 'DESC')->paginate($qtd_por_pagina);
        return view('roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * $qtd_por_pagina);
    }

    public function create()
    {
        $permission = Permisson::get();
        return view('roles.create', compact('permission'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,names',
            'permission' => 'required'
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('sucess', 'Perfil criado com sucesso');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permisson::join(
            'role_has_permissions',
            'role_has_permissions.permission_id',
            '=',
            'permissions.id'
        )->where('role_has_permissions.roles_id', $id)->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permission.role.id', $id)->pluck('role_has_permissions.permission_id')->all();
        return view('roles.edit', compact('role','permission','rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,names',
            'permission' => 'required'
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('sucess','perfil atualizado com sucesso');
    }

    public function destroy($id)
    {
        DB::table('roles')->where('id',$id)->delete();
        return redirect()->route('roles.index')->with('success','perfil apagado');
    }
}
