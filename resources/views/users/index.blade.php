 @extends('layouts.app')

 @section('content')

 <div class="row">
     <div>
         <div class="col-lg-12 marigin-tb">
             <div class="pull-left">
                 <h2>Usuarios</h2>
             </div>
             <div class="pull-rigth">
                 <a class="btn btn-success" href="{{route ('users.create')}}">+ Novo usuario</a>
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

             @if(!empty($users->getRoleNames()))
             @foreach($users->getRoleNames() as $v)
             <label class="badge badge-success">{{$v}}</label>
             @endforeach
             @endif
         </td>

         <td>
             <a class="btn btn-info" href="{{route('users.show','$users->id')}}">Mostrar</a>
             <a class="btn btn-primary" href="{{route('users.edit','$users->id')}}">Editar</a>
             {!! Form::open(['method'=>'DELETE','route'=>['users.destroy',$users->id],'style'=>'display:inline'])!!}
             {!! Form::submit('apagar',['class'=>'btn btn-danger'])!!}
             {!! Form::close() !!}
         </td>
     </tr>
     @endforeach
 </table>
 {!! $data->render()!!}
 @endsection