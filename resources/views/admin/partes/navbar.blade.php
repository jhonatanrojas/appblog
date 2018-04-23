<!-- Navbar -->
  <nav class="navbar px-navbar">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Blog Laravel</a>
    </div>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse" aria-expanded="false"><i class="navbar-toggle-icon"></i></button>

    <div class="collapse navbar-collapse" id="px-navbar-collapse">
      <ul class="nav navbar-nav">
       
      </ul>
@if(Auth::user())
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name}}
          </a>
          <ul class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
              </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>
        
          </ul>
        </li>
      </ul>
      @endif
    </div>
  </nav>