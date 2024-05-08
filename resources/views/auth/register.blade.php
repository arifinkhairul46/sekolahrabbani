<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Rabbani | Login</title>
    <link href="{{ asset('assets/images/logo-yayasan_1.png') }}" rel="icon" type="image/jpg">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
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
                <div class="card mt-3">
                    <div class="card-body">
                        <p class="login-box-msg">Silahkan daftar dengan akun anda</p>
                        <form role="form" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('name') }}" type="name" name="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-at"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('username') }}" type="username" name="username"
                                        value="{{ old('username') }}" required>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('email') }}" type="email" name="email"
                                        value="{{ old('email') }}" required>
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
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Password') }}" type="password" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Role --</option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
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

