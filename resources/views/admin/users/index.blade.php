@extends('admin.template.main');

@section('title')
Lista de Usuarios

@endsection

 

@section('contect')


 <div class="tab-content p-y-4">

 <div class="row">
 <div class="col-md-6 col-lg-offset-3">
  <div class="page-header">
    <br>
      <h1>Lista de Usuarios</h1>
    </div>



      <!-- ERRORES -->
      @include('admin.partes.errors')
      <!-- ERRORES -->

      <!-- alertas -->
      @include('admin.partes.alertmsj')
 <!-- alertas -->

  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
            <th>Correo</th>
             <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      @foreach($users as $user)
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
         <td>{{$user->email}}</td>
        <td>
        
        @if($user->type=="admin")
         <span class="label label-primary">     {{$user->type}} </span>

         @else
<span class="label label-success">  {{$user->type}}</span>
         @endif
     </td>
             <td>



  <button class="btn btn-danger" data-catid={{$user->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-times"   ></i></button>

          

             <a href="{{route('users.edit',$user->id)}}"class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
             </td>
      </tr>
    @endforeach
    </tbody>
  </table>
    {!! $users->render()!!}

<div class="row"> 


<div class="col-md-6 col-lg-offset-3"> 
      <a href="{{route('users.create')}}" class="btn btn-info ">Registrar Usuario</a>
    </div>





    </div>
  </div>
  
</div>

</div>


<div class="modal modal-warnin fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Confirme Eliminar</h4>
      </div>


        <div class="modal-body">
        <p class="text-center">
          
¿Estás seguro que quieres eliminar a "{{$user->name}}"?
        </p>
  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancelar</button>
 <a href="{{route('admin.users.destroy', $user->id)}}"  class="btn btn-danger confirm-delete" ><i class="fa fa-times"   ></i> Si Eliminar</a>
       
        </div>
   
    </div>
  </div>
</div>

    </div>


