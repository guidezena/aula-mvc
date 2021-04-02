
@extends('layouts.externo')
@section('title', 'Quadro de Avisos da Empresa')
@section('sidebar')
    @parent
    <p>^ ^ Barra superior adicionada do layout pai/mãe ^ ^ </p>
@endsection
@section('content')
    <p>Quadro de Avisos da Empresa</p>
    <hr>
    <hr>
    <p>Ola, {{$nome}} ! veja os avisos abaixo<p>

    @if($mostrar)
        @foreach($avisos as $avisos)
            <p>Aviso #{{$avisos ['id']}}: {{$avisos ['texto']}}<p>
            @endforeach

        @else
            O aviso nao sera exibido
        @endif
@endsection