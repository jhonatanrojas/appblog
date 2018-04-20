

  <!-- Nav -->
  <nav class="px-nav px-nav-left">
    <button type="button" class="px-nav-toggle" data-toggle="px-nav">
      <span class="px-nav-toggle-arrow"></span>
      <span class="navbar-toggle-icon"></span>
      <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
    </button>

    <ul class="px-nav-content">
      
      <li class="px-nav-item px-nav-dropdown">
          <a href="#"><i class="px-nav-icon ion-person-stalker"></i><span class="px-nav-label">Usuarios</span></a>
  
          <ul class="px-nav-dropdown-menu">
            <li class="px-nav-item"><a href="{{route('users.create')}}"><span class=""><i class="fa fa-address-card" aria-hidden="true"> Registrar</i> </span></a></li>
            <li class="px-nav-item"><a href="{{route('users.index')}}"><span class="px-nav-label"> <i class="fa fa-search" aria-hidden="true">Consultar</i></span></a></li>
  
          </ul>
        </li>
      

              
      <li class="px-nav-item px-nav-dropdown">
          <a href="#"><i class="px-nav-icon ion-monitor"></i><span class="px-nav-label">Categorias</span></a>
  
          <ul class="px-nav-dropdown-menu">
            <li class="px-nav-item"><a href="{{route('categorias.create')}}"><span class=""> <i class="fa fa-address-card" aria-hidden="true">Registrar</i>
              </span></a></li>
            <li class="px-nav-item"><a href="{{route('categorias.index')}}"><span class="px-nav-label" > <i class="fa fa-search" aria-hidden="true">Consultar</i></span></a></li>
  
          </ul>
        </li>
    </ul>
  </nav>

  <!-- Navbar -->