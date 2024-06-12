@extends('layouts.app')

@section('content')
    <div class="d-flex" style="min-height: 100vh">
        <div class="col-4" style="background-color: #940b92">
            {{-- <h1><strong>Sekolah Rabbani</strong></h1> --}}
            <a href="/" style="text-decoration: none;"> <h3 class="text-white center" style="margin-top: 5rem"><strong>Sekolah Rabbani</strong></h3></a>
            <img src="{{ asset('assets/images/illustration-login1.png') }}" alt="" class="my-4" width="80%" >
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
                            <form role="form" method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        
                                        <input class="form-control form-control-login" placeholder="{{ __('email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        
                                        <input class="form-control form-control-login" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4 text-white">{{ __('Sign in') }}</button>
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
@endsection
