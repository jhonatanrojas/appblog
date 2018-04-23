
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   
    <title>@yield('title','Default')| Jhonatan</title>


    @include('admin.template.fuenteshead')


  <!-- Pace.js -->


  <!-- Custom styling -->
  <style>
    .page-signin-modal {
      position: relative;
      top: auto;
      right: auto;
      bottom: auto;
      left: auto;
      z-index: 1;
      display: block;
    }

    .page-signin-form-group { position: relative; }

    .page-signin-icon {
      position: absolute;
      line-height: 21px;
      width: 36px;
      border-color: rgba(0, 0, 0, .14);
      border-right-width: 1px;
      border-right-style: solid;
      left: 1px;
      top: 9px;
      text-align: center;
      font-size: 15px;
    }

    html[dir="rtl"] .page-signin-icon {
      border-right: 0;
      border-left-width: 1px;
      border-left-style: solid;
      left: auto;
      right: 1px;
    }
  </style>
</head>
<body>





 <div class="page-signin-modal modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="box m-a-0">
          <div class="box-row">

            <div class="box-cell col-md-5 bg-primary p-a-4">
              <div class="text-xs-center text-md-left">
                <a class="px-demo-brand px-demo-brand-lg" href="index.html"><span class="px-demo-logo bg-primary m-t-0"><span class="px-demo-logo-1"></span><span class="px-demo-logo-2"></span><span class="px-demo-logo-3"></span><span class="px-demo-logo-4"></span><span class="px-demo-logo-5"></span><span class="px-demo-logo-6"></span><span class="px-demo-logo-7"></span><span class="px-demo-logo-8"></span><span class="px-demo-logo-9"></span></span><span class="font-size-20 line-height-1">PixelAdmin</span></a>
                <div class="font-size-15 m-t-1 line-height-1">Simple. Flexible. Powerful.</div>
              </div>
              <ul class="list-group m-t-3 m-b-0 visible-md visible-lg visible-xl">
                <li class="list-group-item p-x-0 p-b-0 b-a-0"><i class="list-group-icon fa fa-sitemap text-white"></i> Flexible modular structure</li>
                <li class="list-group-item p-x-0 p-b-0 b-a-0"><i class="list-group-icon fa fa-file-text-o text-white"></i> SCSS source files</li>
                <li class="list-group-item p-x-0 p-b-0 b-a-0"><i class="list-group-icon fa fa-outdent text-white"></i> RTL direction support</li>
                <li class="list-group-item p-x-0 p-b-0 b-a-0"><i class="list-group-icon fa fa-heart text-white"></i> Crafted with love</li>
              </ul>
            </div>
                           

            <div class="box-cell col-md-7">
              

   <form action="POST" class="p-a-4" action="{{route('login')}}" id="page-signin-form">
                
                 <input name="_method" type="hidden" value="PATCH"> 
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Sign In to your Account</h4>
                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                  <input type="text"
                   name="name" 
                   class="page-signin-form-control form-control"
                    placeholder="Username or Email">

                        @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </fieldset>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                  <input type="password"
                   name="password" 
                   class="page-signin-form-control form-control"
                    placeholder="Password">

                     @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </fieldset>

                <div class="clearfix">
                  <label class="custom-control custom-checkbox pull-xs-left">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    Remember me
                  </label>
                  <a href="#" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Forgot your password?</a>
                </div>

                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
                                                 
              </form>

              <div class="p-y-3 p-x-4 b-t-1 bg-white darken" id="page-signin-social">
                <a href="index.html" class="btn btn-block btn-lg btn-info font-size-13"><span class="btn-label-icon left fa fa-twitter"></span>Sign In with <strong>Twitter</strong></a>
              </div>

              <!-- / Sign In form -->

            
              <!-- / Reset form -->

            </div>
          </div>
        </div>
      </div>

      <div class="text-xs-center m-t-2 font-weight-bold font-size-14 text-white" id="px-demo-signup-link">
        Not a member? <a href="pages-signup-v1.html" class="text-white"><u>Sign Up now</u></a>
      </div>
    </div>
  </div>











  <!-- Footer -->
  <footer class="px-footer px-footer-bottom">
    Copyright © 201 JHONATAN ROJAS. All rights reserved.
  </footer>
<script src="{{ asset('tema/js/app.js') }}"></script>
<script src="{{ asset('tema/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('tema/js/pixeladmin.min.js') }}"></script>

</body>
</html>


