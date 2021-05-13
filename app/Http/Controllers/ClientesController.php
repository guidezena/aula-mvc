<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listar(){
        $clientes = Clientes::all();
        return view('clientes.listar', ['clientes' => $clientes]);
    }
    public function index( Request $request){
        $qtd_por_pagina = 5;
        $data = Clientes::orderBy('id','DESC')->paginate($qtd_por_pagina);
        return view('clientes.index',compact('data'))->with('i',($request->input('page', 1) - 1) * $qtd_por_pagina);
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('users.create', compact($roles));
    }
}
