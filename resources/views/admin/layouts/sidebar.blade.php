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
                    <img src="{{isset(auth()->user()->image) ? auth()->user()->image : "/dist/img/avatar5.png"}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('profile')}}" class="d-block">{{ auth()->user()->name }}</a>
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
                    @can('show-users')
                    <li class="nav-item has-treeview {{ isActive(['admin.users.index' , 'admin.users.create' , 'admin.users.edit'] , 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.users.index' , 'admin.users.create' , 'admin.users.edit'] ) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                کاربران
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کاربران</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @canany(['show-permossions', 'show-roles'])
                    <li class="nav-item has-treeview {{ isActive(['admin.permissions.index' , 'admin.permissions.create' , 'admin.permissions.edit','admin.roles.index' , 'admin.roles.create' , 'admin.roles.edit'] , 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.permissions.index' , 'admin.permissions.create' , 'admin.permissions.edit','admin.roles.index' , 'admin.roles.create' , 'admin.roles.edit'] ) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                اجازه دسترسی
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>همه دسترسی ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.index') }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>همه مقام ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @can('show-comments-list')
                        <li class="nav-item has-treeview {{ isActive(['admin.comments.index' , 'admin.comments.unapproved','admin.comments.userShow' ] , 'menu-open') }}">
                            <a href="#" class="nav-link {{ isActive(['admin.comments.index' , 'admin.comments.unapproved','admin.comments.userShow' ] ) }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    نظرات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('edit-comment')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.comments.index') }}" class="nav-link {{ isActive('admin.comments.index') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>نظرات تایید شده</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.comments.unapproved') }}" class="nav-link {{ isActive('admin.comments.unapproved') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>نظرات رد شده</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('show-user-comments')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.comments.userShow') }}" class="nav-link {{ isActive('admin.comments.userShow') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>نظرات من</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                    @endcan
                    @can('show-categories')
                        <li class="nav-item has-treeview {{ isActive('admin.categories.index' , 'menu-open') }}">
                            <a href="#" class="nav-link {{ isActive('admin.categories.index') }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    دسته بندی ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ isActive('admin.categories.index') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>لیست دسته ها</p>
                                        </a>
                                    </li>

                            </ul>
                        </li>
                    @endcan
                    @can('show-products-list')
                        <li class="nav-item has-treeview {{ isActive(['admin.products.index','admin.products.userShow'] , 'menu-open') }}">
                            <a href="#" class="nav-link {{ isActive(['admin.products.index','admin.products.userShow']) }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    محصولات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('show-products')
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ isActive('admin.products.index') }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست محصولات</p>
                                    </a>
                                </li>
                                @endcan
                                @can('show-user-products')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products.userShow') }}" class="nav-link {{ isActive('admin.products.userShow') }}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>محصولات من</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcan
                    @can('show-discounts')
                        <li class="nav-item has-treeview {{ isActive('admin.discount.index' , 'menu-open') }}">
                            <a href="#" class="nav-link {{ isActive('admin.discount.index') }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    تخفیف ها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.discount.index') }}" class="nav-link {{ isActive('admin.discount.index') }}">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست تخفیف ها</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endcan
                    @can('show-orders')
                    <li class="nav-item has-treeview {{ isActive(['admin.orders.index',] , 'menu-open') }}">
                        <a href="#" class="nav-link {{ isActive(['admin.orders.index']) }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                بخش سفارشات
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index' , ['type' => 'unpaid']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'unpaid'])) }} ">
                                    <i class="fa fa-circle-o nav-icon text-warning"></i>
                                    <p>پرداخت نشده
                                        <span class="badge badge-warning right">{{ \App\Models\Order::whereStatus('unpaid')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index' , ['type' => 'paid']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'paid'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-info"></i>
                                    <p>پرداخت شده
                                        <span class="badge badge-info right">{{ \App\Models\Order::whereStatus('paid')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index'  , ['type' => 'preparation']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'preparation'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-primary"></i>
                                    <p>در حال پردازش
                                        <span class="badge badge-primary right">{{ \App\Models\Order::whereStatus('preparation')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index' , ['type' => 'posted']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'posted'])) }}">
                                    <i class="fa fa-circle-o nav-icon text text-light"></i>
                                    <p>ارسال شده
                                        <span class="badge badge-light right">{{ \App\Models\Order::whereStatus('posted')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index' , ['type' => 'received']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'received'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-success"></i>
                                    <p>دریافت شده
                                        <span class="badge badge-success right">{{ \App\Models\Order::whereStatus('received')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index' , ['type' => 'canceled']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'canceled'])) }}">
                                    <i class="fa fa-circle-o nav-icon text-danger"></i>
                                    <p>کنسل شده
                                        <span class="badge badge-danger right">{{ \App\Models\Order::whereStatus('canceled')->count() }}</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>

