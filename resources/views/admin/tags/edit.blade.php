@extends('admin.template.main');

@section('title')

Crear Usuario

@endsection



@section('contect')


<div class="page-header" style="text-align: center">
      <h1>Editar tags {{$tags->name}}</h1>
    </div>
   
    {!! Form::model($tags,array('route'=>['tags.update',$tags->id],'method'=>'PUT')) !!}
 <div class="tab-content p-y-4">

      <!-- Profile tab -->

      <div class="tab-pane fade in active" id="account-profile">
        <div class="row">
          <div class="col-md-6 col-lg-offset-3">
    


      <!-- ERRORES -->
      @include('admin.partes.errors')
      <!-- ERRORES -->

      <!-- alertas -->
      @include('admin.partes.alertmsj')
 <!-- alertas -->
            <div class="p-x-1">
       
<div class="form-group">
  <label>Nombre tags</label>
{!! Form::text('name', $tags->name,['class'=>'form-control','placeholder'=>'Ingrese tags'])  !!}
</div>

            </div>

           <div class="row">       
                 <div class="col-md-3 col-lg-offset-3">   
{!! Form::submit('Modificar',['class'=>'btn btn-lg btn-primary m-t-3'])  !!}
{!! Form::close() !!}
  </div>
  </div>
  </div>
         </div>

@endsection