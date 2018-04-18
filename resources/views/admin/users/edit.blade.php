@extends('admin.template.main');

@section('title')

Crear Usuario

@endsection



@section('contect')
<div class="page-header " style="text-align: center;">
      <h1 >Editar Datos Usuario de {{$user->name}}</h1>
    </div>



 <div class="tab-content p-y-4">

      <!-- Profile tab -->

      <div class="tab-pane fade in active" id="account-profile">
        <div class="row">
          <div class="col-md-4 col-lg-offset-3">
       

                {!! Form::model($user,array('route'=>['users.update',$user->id],'method'=>'PUT')) !!}
                            <div class="form-group">

                        <label> Nombre</label>
                               {!! Form::text('name', $user->name,['class'=>'form-control','placeholder'=>'nombre'])  !!}
                              
                            </div>

                             <div class="form-group">
                              
                        <label> Correo</label>
                               {!! Form::text('email', $user->email,['class'=>'form-control','placeholder'=>'nombre'])  !!}
                              
                            </div>


                            <div class="form-group">
                                {!! Form::button('Update',['type'=>'submit','class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
         

           <div class="row">       
                 <div class="col-md-3 col-lg-offset-3">   
               

  </div>
  </div>
  </div>
         </div>

@endsection