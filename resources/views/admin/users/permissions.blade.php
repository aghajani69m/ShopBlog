@component('admin.layouts.content' , ['title' => 'ثبت دسترسی'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">لیست کاربران</a></li>
        <li class="breadcrumb-item active">ثبت دسترسی</li>
    @endslot
    @slot('script')
        <script>
            $('#roles').select2({

                'placeholder' : 'مقام مورد نظر را انتخاب کنید'
            })
            $('#permissions').select2({

                'placeholder' : 'دسترسی های مورد نظر را انتخاب کنید'

            })
        </script>
    @endslot

    <div class="row">
        <div class="col-lg-12">
            @include('admin.layouts.errors')
            <div class="card">

                <form class="form-horizontal" action="{{ route('admin.users.permissions.store' , $user->id) }}" method="POST">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">ثبت دسترسی</h3>
                    </div>
                    <div class="form-group">
                        <label for="roles" class="col-sm-2 control-label">مقام ها</label>
                        <select class="form-control" name="roles" id="roles" >
                            @foreach(\App\Models\Role::all() as $role)
                                <option value="{{$role->id}}"  {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{$role->name}} - {{$role->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permissions" class="col-sm-2 control-label">دسترسی ها</label>
                        <select class="form-control" name="permissions[]" id="permissions" multiple>
                            @foreach(\App\Models\Permission::all() as $permission)
                                <option value="{{$permission->id}}"  {{ in_array($permission->id , $user->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{$permission->name}} - {{$permission->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endcomponent
