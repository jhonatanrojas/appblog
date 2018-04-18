@extends('admin.template.main');

@section('title')

Crear Usuario

@endsection



@section('contect')


<div class="page-header">
      <h1>Crear Usuario</h1>
    </div>
   
{!! Form::open(['route'=>'users.store','method'=>'POST'])  !!}
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
{!! Form::text('name', null,['class'=>'form-control','placeholder'=>'nombre'])  !!}
</div>

<div class="form-group">
{!! Form::email('email', null,['class'=>'form-control','placeholder'=>'email'])  !!}
</div>

<div class="form-group">
{!! Form::password('password', ['class'=>'form-control','placeholder'=>'clave'])  !!}
</div>


<div class="form-group">
{!! Form::select('type',['admin'=>'Administrador',
                        'meber'=>'Mienbro'], null,['class'=>'form-control'])  !!}
</div>
            </div>

           <div class="row">       
                 <div class="col-md-3 col-lg-offset-3">   
{!! Form::submit('Registrar',['class'=>'btn btn-lg btn-primary m-t-3'])  !!}
{!! Form::close() !!}
  </div>
  </div>
  </div>
         </div>

@endsection