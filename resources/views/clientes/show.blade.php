@extends('layouts.app')

@section('content')

<div class="row">
    <div>
        <div class="col-lg-12 marigin-tb">
            <div class="pull-left">
                <h2>Detalhes dos clientes</h2>
            </div>
            <div class="pull-rigth">
                <a class="btn btn-primary" href="{{route ('clientes.index')}}">voltar</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 marigin-tb">
        <p></p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>

            {{$clientes->nome}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{$clientes->email}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nascimento:</strong>
            {{$clientes->nascimento}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>endereço:</strong>
            {{$clientes->endereço}}
        </div>
    </div>


</div>

<br>