
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
    <title>@yield('title','Default')| Jhonatan</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/pixeladmin.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/widgets.min.css')}}">

      <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/css/themes/clean.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('tema/pace/pace.min.js')}}">

<script src="{{ asset('tema/js/jquery.js') }}"></script>
  

  <!-- Theme -->
  <link href="css/themes/clean.min.css" rel="stylesheet" type="text/css">

  <!-- Pace.js -->
  <script src="pace/pace.min.js"></script>
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


<script src="{{ asset('tema/js/pixeladmin.min.js') }}"></script>

</body>
</html>