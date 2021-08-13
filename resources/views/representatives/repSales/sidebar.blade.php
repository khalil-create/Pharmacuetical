
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <a href="/home" class="brand-link">
        <imgsrc="{{asset('designImages/ab.jpg')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">التسويق الدوائي</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><?php $username = explode(' ',Auth::user()->user_name_third); ?>
            <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="/repSales/profile/{{Auth::user()->id}}" class="d-block">
                {{$username[0]}} {{Auth::user()->user_surname}}
                <br>
                <p class="text-bold text-sm"> {{Auth::user()->user_type}} </p>
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
            $profile = substr($p,0,7);
            if($p != 'home' && $p !='not-allowed' && $profile != 'profile'){
                $index = strpos($p,'/',13);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="/repSales/manageCustomers"
            class="nav-link {{  $p == 'repSales/manageCustomers' ||
                                $p == 'repSales/addCustomer' ||
                                $path == 'repSales/editCustomer'? 'active' : ''
                            }}" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>ادارة العملاء</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repSales/manageOrders"
            class="nav-link {{  $p == 'repSales/manageOrders' ||
                                $p == 'repSales/addOrder' ||
                                $path == 'repSales/editOrder'? 'active' : '' }}">
                <i class="fas fa-inbox nav-icon"></i>
                <p>ادارة الطلبيات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repSales/showChargedTasks"
            class="nav-link {{  
                                $p == 'repSales/showChargedTasks' ||
                                $path == 'repSales/performTask' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>مهام مطلوبه</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repSales/manageServices"
            class="nav-link {{  $p == 'repSales/manageServices' ||
                                $p == 'repSales/addService' ||
                                $path == 'repSales/editService'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>ادارة الخدمات</p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
