@extends('admin.template.main');

@section('title')
Lista Categorias

@endsection

 

@section('contect')




<div class="tab-content p-y-4">

  <div class="row">
  <div class="col-md-6 col-lg-offset-3">
   <div class="page-header">
     <br>
       <h1>Lista de Categorias</h1>
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
 
              <th>Accion</th>
       </tr>
     </thead>
     <tbody>
       <tr>
       @foreach($categorias as $categoria)
         <td id="cat">{{$categoria->id}}</td>
         <td >{{$categoria->name}}</td>
   

              <td>
 
 
   
   <a href="{{route('admin.categorias.destroy',$categoria->id)}}"class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>

              <a href="{{route('categorias.edit',$categoria->id)}}"class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
             

            </td>
       </tr>
     @endforeach
     </tbody>
   </table>
     {!! $categorias->render()!!}
 
 <div class="row"> 
 
 
 <div class="col-md-6 col-lg-offset-3"> 
  <button class="btn btn-success"  data-toggle="modal" data-target="#registrar"><i class="fa fa-pencil"   ></i>Agregar Categoria</button>
     </div>
 
 
 
 
 
     </div>
   </div>
   
 </div>
 
 </div>
 
 
 <div class="modal modal-warnin fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
   
          
      </div>

        <div class="modal-body">
            {!! Form::open(['route'=>'categorias.store','method'=>'POST'])  !!}

            <div class="form-group">
                <label>Nombre Categoria </label>
              {!! Form::text('name', $categoria->name,['class'=>'form-control','placeholder'=>'Ingrese Categoria'])  !!}
              </div>
             
         
        

        </div>
        <div class="modal-footer">
            {!! Form::submit('Registrar',['class'=>'btn  btn-primary m-t-3'])  !!}

 {!! Form::close() !!}
        </div>
   
    </div>
  </div>
 
     </div>
 
 
     