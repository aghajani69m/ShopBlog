{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{-- <div class="row justify-content-center">--}}
{{-- <div class="col-md-8">--}}
{{-- <div class="card">--}}
{{-- <div class="card-header">{{ __('Register') }}</div>--}}

{{-- <div class="card-body">--}}
{{-- <form method="POST" action="{{ route('register') }}">--}}
{{-- @csrf--}}

{{-- <div class="form-group row">--}}
{{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{-- @error('name')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row">--}}
{{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{-- @error('email')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row">--}}
{{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{-- @error('password')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row">--}}
{{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group col-md-8 offset-md-4 mb-3">--}}
{{-- @recaptcha--}}

{{-- @error('g-recaptcha-response')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}

{{-- <div class="form-group row mb-0">--}}
{{-- <div class="col-md-6 offset-md-4">--}}
{{-- <button type="submit" class="btn btn-primary">--}}
{{-- {{ __('Register') }}--}}
{{-- </button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
{{--@endsection--}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | صفحه ثبت نام</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="/dist/css/custom-style.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <b>ثبت نام در سایت</b>
        </div>
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">ثبت نام کاربر جدید</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="name" type="text" class="form-control" placeholder="نام و نام خانوادگی" value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <span class="fa fa-user input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="ایمیل" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" class="form-control" placeholder="رمز عبور" required>
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password_confirmation" type="password" class="form-control" placeholder="تکرار رمز عبور">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> با <a href="#">شرایط</a> موافق هستم
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت نام</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- یا -</p>
                    {{-- <a href="#" class="btn btn-block btn-primary">--}}
                    {{-- <i class="fa fa-facebook mr-2"></i>--}}
                    {{-- ثبت نام با اکانت فیس بود--}}
                    {{-- </a>--}}
                    <a href="{{ route('auth.google') }}" class="btn btn-block btn-danger">
                        <i class="fa fa-google-plus mr-2"></i>
                        ثبت نام با گوگل
                    </a>
                </div>

                <a href="{{route('login')}}" class="text-center">من قبلا ثبت نام کرده ام</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            })
        })
    </script>
</body>

</html>