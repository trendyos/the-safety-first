<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login</title>
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
    <!--//Style-CSS -->


</head>

<body>

    <!-- form section start -->
    <section class="w3l-hotair-form">
        <h1>Welcome Back</h1>
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-hotair">
                    <div class="content-wthree">
                        <h2>Log In</h2>
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
                            {{Html::image('public/assest/login/images/1.png')}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
        <!-- copyright-->
        <div class="copyright text-center">
            <p class="copy-footer-29">© 2022 TOS. All rights reserved | Design by <a
                        href="#">TOS</a></p>
        </div>
        <!-- //copyright-->
    </section>
    <!-- //form section start -->
</body>

</html>