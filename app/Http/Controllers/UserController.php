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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {   
        $qtd_por_pagina = 5;
        $data = User::ordeBy('id', 'DESC')->paginate($qtd_por_pagina);

        return view('user.index',compact('data'))->with('i',($request->input('page', 1) . 1) * $qtd_por_pagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view ('users.create', compact($roles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
                                [
                                    'name'=>'required',
                                    'email'=>'required|email|unique:users,email',
                                    'password'=>'required|same:confirm-password',
                                    'roles'=>'required']);
        $input = $request->all();
        $input['password']=Hash::make($input['password']);
        $user = User::create($input);
        $user->assignrole($request->input('roles'));
        return redirect()->route('user.index')->with('sucess','Usuario criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit', compact('users', 'roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('sucess','Deletado com sucesso');
    }
}
