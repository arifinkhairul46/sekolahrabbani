<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Rabbani | Login</title>
    <link href="{{ asset('assets/images/logo-yayasan_1.png') }}" rel="icon" type="image/jpg">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"  type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>


<body>
    <div class="d-flex">
        <div class="col-4" style="background-color: #940b92">
            {{-- <h1><strong>Sekolah Rabbani</strong></h1> --}}
            <h3 class="text-white center" style="margin-top: 5rem"><strong>Sekolah Rabbani</strong></h3>
            <img src="{{ asset('assets/images/illustration-login1.png') }}" alt="" class="my-4" width="80%" height="80%" >
        </div>
        <div class="col mt-4">
            <div class="login center">
                <div class="container px-4">
                    <a class="brand-image" href="">
                        <img src="{{ asset('assets/images/logo-yayasan_1.png') }}" width="100px" />
                    </a>
                </div>
                <div class="login-box">   
                    <span><strong> Selamat Datang di Sekolah Rabbani</strong></span>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <p class="login-box-msg">Silahkan masuk dengan akun anda</p>            
                            <form role="form" method="POST" action="">
                                @csrf
                    
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control form-control-sm" placeholder="{{ __('email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input class="form-control form-control-sm" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn-login my-4 text-white">{{ __('Sign in') }}</button>
                                </div>
                            </form>                           
                        <p class="mb-3">
                            <a href="{{route('register')}}" class="text-center">Register a new membership</a>
                        </p>
                        <p> Or login with </p>
                        <div class="social-auth-links text-center">
                            <a href="{{route ('auth.google')}}">
                                <i class="fa-brands fa-google" style="color: red"></i>
                            </a>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>
    <div class="d-flex">
    @include('layouts.footer.footer')
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>

