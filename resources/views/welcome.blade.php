<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eradco</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 54px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
 @extends('layouts.app')

@section('content')


<div class="container">

 
    @if (Route::has('login'))

    <!-------------------------------------------------->
    @auth

       <div class="flex-center position-ref full-height">
       <div class="links" style="position: absolute;top: 60px;"> <a style="font-size: 20px;font-weight: bold;color: green;" href="{{ url('/home') }}" >ابدأ مشروعك</a></div>
             <div class="content">
            <?php
              if(file_exists(storage_path().'/app/public/setting/')){
                $handle = opendir(storage_path().'/app/public/setting/');
                while($file = readdir($handle)){
                    if($file !== '.' && $file !== '..'){
                        //echo '<img src="pictures/'.$file.'" border="0" />';
                        echo'<img style=" margin-bottom: 135px;border-radius: 50%;display: block;margin-left: auto;margin-right: auto;width: 100%;" src='.asset("storage/setting/$file").' alt="" > ';
                    }
                }
            }else{
                echo'<img style=" margin-bottom: 135px;border-radius: 50%;display: block;margin-left: auto;margin-right: auto;width: 100%;" src='.asset("/images/logo.jpg").' alt="" > ';
            }
            ?>
            </div>
        </div>
    @else
     <div class="content">
            <?php
            if(file_exists(storage_path().'/app/public/setting/')){
                $handle = opendir(storage_path().'/app/public/setting/');

                while($file = readdir($handle)){
                    if($file !== '.' && $file !== '..'){
                        //echo '<img src="pictures/'.$file.'" border="0" />';
                        echo'<img style="border-radius: 50%;display: block;margin-left: auto;margin-right: auto;width:10%;" src='.asset("storage/setting/$file").' alt="" >  ';
                    }
                }
            }else{
                echo'<img style="border-radius: 50%;display: block;margin-left: auto;margin-right: auto;width:10%;" src='.asset("/images/logo.jpg").' alt="" >  ';

            }
            ?>
                
            </div>
   <!-------------------------------------------------->
       
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <!-- <div class="card-header">{{ __('Login') }}</div> -->
                <div class="card-header">تسجيل الدخول</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                            <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكترونى</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --> <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السـر</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                         <label class="form-check-label" for="remember" style="margin-right: 21px; color: #1d68a7;">
                                        <!-- {{ __('Remember Me') }} -->
                                        تذكرنى
                                    </label>
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                   
                                </div>
                            </div>
                        </div>

                      <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <!-- {{ __('Login') }} -->
                                    تسجيل الدخول
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <!-- {{ __('Forgot Your Password?') }} -->
                                        هل نسيت كلمة السر
                                        
                                    </a>
                                @endif
                            </div>
                        </div>
       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> @endauth
@endif
      <!------------------------------------------------------------------------->
      </body>
</html>

@endsection
