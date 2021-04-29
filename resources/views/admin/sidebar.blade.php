<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">التسويق الدوائي</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><?php  ?>
            <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{Auth::user()->user_name_third}} {{Auth::user()->user_surname}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="ابحث" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="{{url('home')}}" class="nav-link {{ request()->path() == 'home' ? 'active' : ''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                الصفحة الرئيسية
                </p>
            </a>
        </li>
        @php
            $p = request()->path();
            $index = strpos($p,'/');
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="{{url('displayAllUsers')}}" 
            class="nav-link {{  $p == 'displayAllUsers' || 
                                $path =='editUser' || 
                                $path =='addUser' ? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة الحسابات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('manageSupervisors')}}" 
            class="nav-link {{  $p == 'manageSupervisors' || 
                                $path =='editSupervisor' || 
                                $path =='mainAreaSupervised' || 
                                $path == 'addSupervisor' ? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المشرفين
                <span class="badge badge-info right">6</span>
                </p>
            </a>
        </li>
        <li class="nav-item {{ $p == 'manageMainAreas' || 
                                $p == 'manageSubAreas' ||
                                $path == 'editMainArea' ||
                                $path == 'editSubArea' ||
                                $path == 'supAreas'? 'menu-open' : ''
                            }}">
            <a href="{{url('manageMainAreas')}}" 
            class="nav-link {{  $p == 'manageMainAreas' ||
                                $p == 'manageSubAreas' || 
                                $path == 'editMainArea'||
                                $path == 'editSubArea' ||
                                $path == 'supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('manageMainAreas')}}" 
                class="nav-link {{  $p == 'manageMainAreas' ||
                                    $path == 'editMainArea' ||
                                    $path == 'supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('manageSubAreas')}}" 
                class="nav-link {{  $p == 'manageSubAreas'||
                                    $path == 'editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{url('manageItems')}}" class="nav-link {{ request()->path() == 'displayAllItems' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة الأصناف
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link {{ request()->path() == 'displayAllCompanies' ? 'active' : '' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                ادارة الشركات
                </p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>