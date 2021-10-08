@extends('profile.layout')

@section('main')

    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user1-128x128.jpg" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>


        {{--        <p class="text-muted text-center">{{ auth()->user()->description }}</p>--}}

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>دنبال شونده</b> <a class="float-right">۱,۳۲۲</a>
            </li>
            <li class="list-group-item">
                <b>دنبال کننده</b> <a class="float-right">۵۴۳</a>
            </li>
            <li class="list-group-item">
                <b>دوستان</b> <a class="float-right">۱۳,۲۸۷</a>
            </li>
        </ul>

        {{--        <a href="{{ route('admin.users.edit' , auth()->user()->id) }}" class="btn btn-primary btn-block"><b>ویرایش</b></a>--}}
    </div>
@endsection
