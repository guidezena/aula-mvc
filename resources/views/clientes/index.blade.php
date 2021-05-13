@extends('layouts.app')

@section('content')

<div class="row">
    <div>
        <div class="col-lg-12 marigin-tb">
            <div class="pull-left">
                <h2>Usuarios</h2>
            </div>
            <div class="pull-rigth">
                <a class="btn btn-success" href="{{route ('clientes.create')}}">+ Novo usuario</a>
            </div>
        </div>
    </div>
</div>
<br>

@if($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{$message}}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Perfil</th>
        <th width="280px">Ação</th>
    </tr>

    @foreach($data as $key=> $user)
    <tr>
        <td>{{++$i}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>

            @if(!empty($clientes->getRoleNames()))
            @foreach($clientes->getRoleNames() as $v)
            <label class="badge badge-success">{{$v}}</label>
            @endforeach
            @endif
        </td>

        <td>
            <a class="btn btn-info" href="{{route('clientes.show','$clientes->id')}}">Mostrar</a>
            <a class="btn btn-primary" href="{{route('clientes.edit','$clientes->id')}}">Editar</a>
            {!! Form::open(['method'=>'DELETE','route'=>['clientes.destroy',$clientes->id],'style'=>'display:inline'])!!}
            {!! Form::submit('apagar',['class'=>'btn btn-danger'])!!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>
{!! $data->render()!!}
@endsection