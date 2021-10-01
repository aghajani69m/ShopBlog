<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin.') }}" class="nav-link {{ isActive('admin.') }}">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>پنل مدیریت</p>
                        </a>
                    </li>
                    @canany(['show-users','create-user'])
                    <li class="nav-item has-treeview {{ isActive(['admin.users.index' , 'admin.users.create' , 'admin.users.edit'] , 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.users.index' , 'admin.users.create' , 'admin.users.edit'] ) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('show-users')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                            @endcan
                            @can('create-user')
                            <li class="nav-item">
                                <a href="{{ route('admin.users.create') }}" class="nav-link {{ isActive('admin.users.create') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد کاربر</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany
                    @canany(['show-permossions','create-permission' , 'show-roles','create-role'])
                    <li class="nav-item has-treeview {{ isActive(['admin.permissions.index' , 'admin.permissions.create' , 'admin.permissions.edit','admin.roles.index' , 'admin.roles.create' , 'admin.roles.edit'] , 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.permissions.index' , 'admin.permissions.create' , 'admin.permissions.edit','admin.roles.index' , 'admin.roles.create' , 'admin.roles.edit'] ) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                اجازه دسترسی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('create-permission')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.create') }}" class="nav-link {{ isActive('admin.permissions.create') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد دسترسی</p>
                                </a>
                            </li>
                            @endcan
                            @can('show-permissions')
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>همه دسترسی ها</p>
                                </a>
                            </li>
                            @endcan
                                @can('create-role')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.create') }}" class="nav-link {{ isActive('admin.roles.create') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ایجاد مقام</p>
                                </a>
                            </li>
                                @endcan
                            @can('show-roles')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>همه مقام ها</p>
                                </a>
                            </li>
                                @endcan
                        </ul>
                    </li>
                    @endcanany
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

