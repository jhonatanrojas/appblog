@extends('admin.template.main');

@section('title')
Lista Categorias

@endsection

 

@section('contect')


<div class="tab-content p-y-4">

 <div class="row">
 <div class="col-md-6 col-lg-offset-3">
  <div class="page-header" style="text-align: center;">
    <br>
      <h1>Lista de  Categorias</h1>
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
        <th>Nombre Categoria</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
      @foreach($categorias as $categoria)
        <td>{{$categoria->id}}</td>
        <td>{{$categoria->name}}</td>
       
        <td>
       


  <button class="btn btn-danger" data-catid={{$categoria->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-times"   ></i></button>

            <button class="btn btn-info" data-mytitle="{{$categoria->name}}" data-catid={{$categoria->id}} data-toggle="modal" data-target="#edit">Edit</button>

            {{-- <a href="{{route('categorias.edit',$categoria->id)}}"class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a> --}} 
             </td>
      </tr>
    @endforeach
    </tbody>
  </table>
    {!! $categorias->render()!!}

<div class="row"> 


<div class="col-md-6 col-lg-offset-3"> 
      <a href="{{route('categorias.create')}}" class="btn btn-info ">Registrar Categoria</a>
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
          
¿Estás seguro que quieres eliminar a "{{$categoria->name}}"?
        </p>
  

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancelar</button>
 <a href="{{route('admin.categoria.destroy', $categoria->id) }}"  class="btn btn-danger confirm-delete" ><i class="fa fa-times"   ></i> Si Eliminar</a>
       
        </div>
   
    </div>
  </div>
</div>

    </div>


<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
      </div>
      <form action="{{route('categorias.update','1')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
              <label for="title">Nombre</label>
              <input type="text" class="form-control" name="name" id="title" value="{{ 'categorias->name' }}">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>