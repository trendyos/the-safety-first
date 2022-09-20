<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login</title>
    <link rel="icon" href="{{env('APP_URL')}}public/fav-icon1.png" sizes="32x32" />
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Report Login Form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //Meta tag Keywords -->
    {{Html::style('public/assest/login/css/style.css')}}
    {{Html::style('public/assest/login/css/font-awesome.min.css')}}
    
    <link href="//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    
    <style>.sep {
    height: 3px;
    width: 53px;
    background: linear-gradient(45deg,  #8dbc5a,  #499a9f);
    margin: 10px 0px;
}</style>
    <!--//Style-CSS -->


</head>

<body>

    <!-- form section start -->
    <section class="w3l-hotair-form">
        
        <div class="container">
            <!-- /form -->
           
            <div class="workinghny-form-grid">
                <div class="main-hotair">
                    <div class="content-wthree">
                        <!--<div class="logo" style="text-align:center;"><img src="{{env('APP_URL')}}public/assest/login/images/tos-LOGO-new.png" height="80px" width="170px"></img></div>  --->
                        <div class="logo" style="text-align:left; padding: 10px 0px;"><img src="https://www.thesafetyfirst.in/wp-content/uploads/2022/07/safety-first-web.png" width="170px"></div>
                        <div class="sep"></div>
                        <h5 style="font-family: 'Noto Sans JP';
    color: #5a5a5a;
    font-size: 16px;
    font-weight: 400;">Login As a Admin User</h5>
                        @if(Session::has('success'))
                        <div class="alert alert-success" style="color:green">
                            <strong>Success!</strong> {{ Session::get('success') }}
                        </div>
                        @elseif(Session::has('failed'))
                        <div class="alert alert-danger" style="color:red">
                            <strong>Danger!</strong> {{ Session::get('failed') }}
                        </div>
                        @elseif(Session::has('error'))
                        <div class="alert alert-danger" style="color:red"> 
                            <strong></strong> {{ Session::get('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <input type="email" class="text  @error('email') is-invalid @enderror" name="email" placeholder="User Name" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input type="password" class="password @error('password') is-invalid @enderror" name="password" placeholder="User Password" required autocomplete="current-password">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                        </form>
                        
                        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                    </div>
                    
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            {{Html::image('public/assest/login/images/side_login.png')}}
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
        <!-- copyright-->
        <div class="copyright text-center">
            <p class="copy-footer-29">© <strong>Copyright</strong> The Safety First India.</p>
        </div>
        <!-- //copyright-->
    </section>
    <!-- //form section start -->
</body>

</html>