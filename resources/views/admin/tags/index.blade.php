@extends('admin.template.main');

@section('title')
Lista tags

@endsection

 

@section('contect')




<div class="tab-content p-y-4">

  <div class="row">
  <div class="col-md-6 col-lg-offset-3">
   <div class="page-header">
     <br>
       <h1>Lista de Tags</h1>
     </div>
 
 
 
       <!-- ERRORES -->
       @include('admin.partes.errors')
       <!-- ERRORES -->
 
       <!-- alertas -->
       @include('admin.partes.alertmsj')
  <!-- alertas -->
 @if(empty($tags))


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


      
        <td id="cat"></td>
        <td ></td>
  
    
             <td>
            
  <a href=""class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>

             <a href=""class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            

           </td>
      </tr>


    </tbody>
  </table>




<div class="row"> 


<div class="col-md-6 col-lg-offset-3"> 
 <button class="btn btn-success"  data-toggle="modal" data-target="#registrar"><i class="fa fa-pencil"   ></i>Agregar Tags</button>
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
           {!! Form::open(['route'=>'tags.store','method'=>'POST'])  !!}

           <div class="form-group">
               <label>Nombre del tag </label>
             {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Agregar tag'])  !!}
       
             </div>

       </div>
       <div class="modal-footer">
       
       </div>
  
   </div>
 </div>

    </div>


 @else

 {!! Form::open(['route' =>'tags.index', 'method'=>'GET', 'class'=>'navbar-form pull-right'])  !!}
 <div class="input-group">     
 {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Buscar tag','arialdescribedby'=>'search'])  !!}
 <span class="input-group-addon" id="search"><span class="fa fa-search" arial-hidden="true"></span></span>
 </div>
{!! Form::close() !!}


 {!! Form::open(['route'=>'tags.store','method'=>'POST'])  !!}


{!! Form::close() !!}
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


      @foreach($tags as $tag)
        <td id="cat">{{$tag->id}}</td>
        <td >{{$tag->name}}</td>
  
    
             <td>
            
  <a href="{{route('admin.tags.destroy',$tag->id)}}"class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>

             <a href="{{route('tags.edit',$tag->id)}}"class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            

           </td>
      </tr>
    @endforeach

    </tbody>
  </table>



    {!! $tags->render() !!}   

<div class="row"> 


<div class="col-md-6 col-lg-offset-3"> 
 <button class="btn btn-success"  data-toggle="modal" data-target="#registrar"><i class="fa fa-pencil"   ></i>Agregar tag</button>
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
           {!! Form::open(['route'=>'tags.store','method'=>'POST'])  !!}

           <div class="form-group">
               <label>Nombre tag </label>
             {!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Ingrese tag'])  !!}
             </div>

       </div>
       <div class="modal-footer">
           {!! Form::submit('Registrar',['class'=>'btn  btn-primary m-t-3'])  !!}

{!! Form::close() !!}
       </div>
  
   </div>
 </div>

    </div>


 @endif
   
 
 
     