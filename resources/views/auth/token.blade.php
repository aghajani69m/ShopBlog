{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        Two Factor Auth--}}
{{--                    </div>--}}
{{--                    <div class="card-header">--}}
{{--                        <strong>Your Code is : {{$code}}</strong>--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        <form action="{{ route('2fa.token') }}" method="POST">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="token" class="col-form-label">Token</label>--}}
{{--                                <input type="text" class="form-control @error('token') is-invalid @enderror" name="token" placeholder="enter your token">--}}
{{--                                @error('token')--}}
{{--                                   <span class="invalid-feedback">--}}
{{--                                       <strong>{{ $message }}</strong>--}}
{{--                                   </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <button class="btn btn-primary">Validate token</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>اهراز هویت | صفحه قفل</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="../../dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="../../dist/css/custom-style.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="#"><b>اهراز هویت دو مرحله ای</b></a> <br>
        <h6><b>کد تایید : {{$code}}</b></h6>
    </div>
@include('admin.layouts.errors')
<!-- User name -->
{{--    <div class="lockscreen-name">{{ auth()->user()->name }}</div>--}}


    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="../../dist/img/user1-128x128.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="{{ route('2fa.token') }}" method = "POST">
            @csrf

            <div class="input-group">
                <input name="token" type="text" class="form-control" placeholder="کد تایید">

                <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        رمز پیامک شده به شماره موبایل خود را وارد کنید
    </div>
    {{--    <div class="text-center">--}}
    {{--        <a href="login.html">و یا با یک یوزرنیم دیگر وارد شوید</a>--}}
    {{--    </div>--}}

</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
