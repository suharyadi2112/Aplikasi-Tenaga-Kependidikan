<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script>
    var laravel = @json(['baseURL' => url('/')])
</script>
<head>
    <title>Universitas Universal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/app.js') }}" defer></script>
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ URL::asset('loginnew/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('loginnew/css/main.css')}}">
    <link href="{{ URL::asset('admin/dist/css/font_google_nomito.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/nprogress.css') }}" rel="stylesheet" />
    <script src="{{ asset('admin/dist/js/nprogress.js') }}"></script>
  
<!--===============================================================================================-->
</head>
<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url({{ URL::asset('admin/dist/img/logo2.png') }})">
            <div class="wrap-login100 p-t-50 p-b-30">
                <form class="login100-form validate-form" id="FormLogin" method="POST" action="{{ route('login') }}">
                     @csrf
                    <div class="login100-form-avatar">
                        <img src="{{ URL::asset('admin/dist/img/logo2.png') }}" style="height: 50%" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                        Kepegawaian<br> Universitas Universal
                    </span>
                      
                        <div class="wrap-input100 validate-input m-b-10" data-validate= "Username is required" >
                            <input class="input100 " type="text" name="username" value="{{ old('username') }}" placeholder="Username" autocomplete="off">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                    
                        @error('username')<script type="text/javascript">alert('<?php echo $message ?>'); </script>@enderror

                        <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password" autocomplete="off">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>

                        @error('password')<script type="text/javascript">alert('<?php echo $message ?>'); </script>@enderror

                        <div class="container-login100-form-btn p-t-10">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::displaySubmit('FormLogin', ' <div class="container-login100-form-btn p-t-10">
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>', ['data-theme' => 'dark']) !!}
                            @error('g-recaptcha-response')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                       
                     
                        <!--div class="text-center w-full p-t-25 p-b-230">
                            <a href="#" class="txt1">
                                Forgot Username / Password?
                            </a>
                        </div-->

                   
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="{{ URL::asset('loginnew/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{ URL::asset('loginnew/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{ URL::asset('loginnew/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{ URL::asset('loginnew/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{ URL::asset('loginnew/js/main.js')}}"></script>

</body>
</html>
