
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
            <a href="#" class="d-block">
                {{Auth::user()->user_name_third}} {{Auth::user()->user_surname}}
                <br>
                <b> {{Auth::user()->user_type}} </b>
            </a>
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
            $index = 4;
            if($p != 'home' && $p !='not-allowed'){
                $index = strpos($p,'/',16);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item {{  $p == 'representative/manageDoctors' || 
                                $p == 'representative/manageCustomers' ||
                                $p == 'representative/manageOrders' ||
                                $p == 'representative/addDoctor' ||
                                $p == 'representative/addCustomer' ||
                                $p == 'representative/addOrder' ||
                                $path == 'representative/editDoctor' ||
                                $path == 'representative/editCustomer'||
                                $path == 'representative/editOrder'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'representative/manageDoctors' || 
                                $p == 'representative/manageCustomers' ||
                                $p == 'representative/manageOrders' ||
                                $p == 'representative/addDoctor' ||
                                $p == 'representative/addCustomer' ||
                                $p == 'representative/addOrder' ||
                                $path == 'representative/editDoctor' ||
                                $path == 'representative/editCustomer'||
                                $path == 'representative/editOrder'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة العملاء
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/representative/manageDoctors"
                    class="nav-link {{  $p == 'representative/manageDoctors' || 
                                        $p == 'representative/addDoctor' ||
                                        $path == 'representative/editDoctor'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الدكاتره</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/representative/manageCustomers"
                    class="nav-link {{  $p == 'representative/manageCustomers' ||
                                        $p == 'representative/addCustomer' ||
                                        $path == 'representative/editCustomer'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>العملاء</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/representative/manageOrders"
                    class="nav-link {{  $p == 'representative/manageOrders' ||
                                        $p == 'representative/addOrder' ||
                                        $path == 'representative/editOrder'? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                        الطلبيات
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/representative/manageServices"
            class="nav-link {{  $p == 'representative/manageServices' ||
                                $p == 'representative/addService' ||
                                $path == 'representative/editService'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الخدمات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/representative/manageVisits"
            class="nav-link {{  $p == 'representative/manageVisits' ||
                                $p == 'representative/addVisit' ||
                                $path == 'representative/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الزيارات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/representative/manageCourses"
            class="nav-link {{  $p == 'representative/manageCourses' ||
                                $p == 'representative/addVisit' ||
                                $path == 'representative/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                المواد التدريبية
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/representative/manageTests"
            class="nav-link {{  $p == 'representative/manageTests' ||
                                $path == 'representative/repTests' ||
                                $path == 'representative/storeRepTest' ||
                                $path == 'representative/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الاختبارات
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="/representative/showStudies"
            class="nav-link {{  $p == 'representative/showStudies' ||
                                $path == 'representative/repTests' ||
                                $path == 'representative/storeRepTest' ||
                                $path == 'representative/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الدراسات العلمية
                </p>
            </a>
        </li> --}}
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
