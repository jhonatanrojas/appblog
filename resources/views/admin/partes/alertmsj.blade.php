       @if(session()->has('msj'))
<div class="alert alert-success">
  <strong>{{ session('msj')}} </strong> 
</div>
@elseif (session()->has('error'))

<div class="alert alert-danger">
  <strong>{{ session('error')}} </strong> 
</div>

@endif