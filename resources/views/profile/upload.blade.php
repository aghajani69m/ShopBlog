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
        <a href="#"><b>آپلود عکس</b></a> <br>
    </div>
@include('admin.layouts.errors')
<!-- User name -->
    <div class="lockscreen-name">{{$user->name }}</div>


    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="{{!is_null(auth()->user()->image) ? auth()->user()->image : "/dist/img/avatar5.png"}}" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" action="{{ route('profile.upload.image') }}" method = "POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <input name="image" type="file" class="form-control" >

                <div class="input-group-append">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        عکس خود را انتخاب کنید
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
