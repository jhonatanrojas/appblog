
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
    <title>@yield('title','Default')| Jhonatan</title>


    @include('admin.template.fuenteshead')


  <!-- Pace.js -->

</head>
<body>
    @include('admin.partes.nav')

    @include('admin.partes.navbar')


<div class="px-content">
  
    <section> 
    @yield('contect')

    </section>

  </div>
 

  <!-- Footer -->
  <footer class="px-footer px-footer-bottom">
    Copyright © 201 JHONATAN ROJAS. All rights reserved.
  </footer>
<script src="{{ asset('tema/js/app.js') }}"></script>
<script src="{{ asset('tema/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('plugin/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('tema/js/pixeladmin.min.js') }}"></script>
<script> 
    $(".chosen").chosen({
      max_selected_options: 3
    });
  
      </script>
</body>
</html>