@extends('admin.template.main');

@section('title')
Articulos

@endsection



@section('contect')


<div class="page-header" style=" text-align: center;">
      <h1>Publicar Articulos</h1>
    </div>
   

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
     

              {!! Form::open(array('route'=>['articulos.store'],'method'=>'POST')) !!}
 
<div class="form-group">
  <label> Titulo</label>
{!! Form::text('titulo', null,['class'=>'form-control','placeholder'=>'Titulo del articulos'])  !!}
</div>

<div class="form-group">
    <label> Categoria</label>
    {!! Form::select('categoria_id',$categoria,null,['class'=>'form-control',
    'placeholder'=>'Selecione una opción','required'])  !!}
    </div>
<div class="form-group">

{!! Form::textarea('contenido', null,['class'=>'form-control','placeholder'=>'Contenido'])  !!}
</div>


<div class="form-group">
    <label> Tags</label>
    {!! Form::select('categoria_id',$tags,null,['class'=>'form-control',
    'multiple','required'])  !!}
          </div>

                          <div class="form-group">
                              {!! Form::file('image') !!}
                  
                        </div>

<div class="form-group col-lg-offset-5">
    {!! Form::submit('Publicar',['class'=>'btn btn-lg btn-primary m-t-3'])  !!}
    {!! Form::close() !!}
  </div>
            </div>



  </div>
         </div>

@endsection