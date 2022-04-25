
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('assert/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Laravel</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("assert/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('home')}}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{route('home')}}" class="nav-link {{Route::is('home') || Route::is('home')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @hasPermission('index-user')
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link {{Route::is('users.*') || Route::is('user.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                @endhasPermission
                @hasPermission('index-role')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link {{Route::is('roles.*') || Route::is('roles.*')  ? 'active' : ''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
                @endhasPermission
                @hasPermission('index-product')
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link {{Route::is('products.*') || Route::is('products.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                @endhasPermission
                @hasPermission('index-category')
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link {{Route::is('categories.*') || Route::is('categories.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Categories
                        </p>
                    </a>

                </li>
                @endhasPermission
            </ul>
        </nav>
    </div>
</aside>
