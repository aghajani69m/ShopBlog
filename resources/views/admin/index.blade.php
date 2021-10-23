@component('admin.layouts.content',['title' => 'پنل مدیریت'])
@slot('breadcrumb')
<li class="breadcrumb-item active">پنل مدیریت</li>
@endslot

<div class="card card-body box-profile">
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="{{!is_null($user->image) ? $user->image : "/dist/img/avatar5.png"}}" alt="User profile picture">
    </div>
    <h3 class="profile-username text-center"> {{" ". $user->name . " "}}</h3>

    <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item align-content-end">
            <a class="float-left">{{$user->email}}</a>
            <b>ایمیل :</b>

        </li>
        <li class="list-group-item">
            <b>تلفن همراه :</b> <a class="float-left">{{!is_null($user->phone_number )? $user->phone_number : "Not Set"}}</a>
        </li>
        <li class="list-group-item">
            <b>مقام :</b> <a class="float-left">
                @php
                if($user->isSuperAdmin()) $role = "ادمین اصلی" ;
                elseif($user->isAdmin()) $role = "ادمین";
                elseif($user->is_superuser) $role = "کاربر ویژه";
                elseif($user->is_staff) $role = "کارمند";
                else $role = "کاربر";
                @endphp
                {{$role}}
            </a>
        </li>

    </ul>

    {{-- <a href="{{ route('admin.users.edit' , auth()->user()->id) }}" class="btn btn-primary btn-block"><b>ویرایش</b></a>--}}
</div>
@endcomponent