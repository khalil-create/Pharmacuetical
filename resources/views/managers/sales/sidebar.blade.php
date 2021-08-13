
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <a href="/home" class="brand-link">
        <img src="{{asset('designImages/ab.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="/managerSales/profile/{{Auth::user()->id}}" class="d-block">
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
            <a href="/home" class="nav-link {{ request()->path() == 'home' ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
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
            <a href="/managerSales/manageRepresentatives"
                class="nav-link {{  $p == 'managerSales/manageRepresentatives' || 
                                    $p == 'managerSales/addRepresentative' ||
                                    $path == 'managerSales/showSubareas' ||
                                    $path == 'managerSales/addRepSubareas' ||
                                    $path =='managerSales/editRepresentative'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>مندوبيين المبيعات</p>
            </a>
        </li>
        <li class="nav-item {{ $p == 'managerSales/manageMainAreas' || 
                                $p == 'managerSales/addMainArea' || 
                                $p == 'managerSales/manageSubAreas' ||
                                $path == 'managerSales/addSubArea' || 
                                $path == 'managerSales/editMainArea' ||
                                $path == 'managerSales/supAreas' ||
                                $path == 'managerSales/editSubArea' ||
                                $path == 'managerSales/showSubareaReps' ||
                                $path == 'managerSales/supAreas'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'managerSales/manageMainAreas' ||
                                $p == 'managerSales/addMainArea' || 
                                $p == 'managerSales/manageSubAreas' || 
                                $path == 'managerSales/addSubArea' || 
                                $path == 'managerSales/supAreas' || 
                                $path == 'managerSales/editMainArea'||
                                $path == 'managerSales/showSubareaReps'||
                                $path == 'managerSales/addSubareaReps'||
                                $path == 'managerSales/editSubArea' ||
                                $path == 'managerSales/supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/managerSales/manageMainAreas" 
                class="nav-link {{  $p == 'managerSales/manageMainAreas' ||
                                    $p == 'managerSales/addMainArea' ||
                                    $path == 'managerSales/supAreas' || 
                                    $path == 'managerSales/editMainArea' ||
                                    $path == 'managerSales/supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/managerSales/manageSubAreas" 
                class="nav-link {{  $p == 'managerSales/manageSubAreas'||
                                    $path == 'managerSales/addSubArea' ||  
                                    $path == 'managerSales/showSubareaReps'||
                                    $path == 'managerSales/addSubareaReps'|| 
                                    $path == 'managerSales/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/managerSales/manageCustomers"
            class="nav-link {{  $p == 'managerSales/manageCustomers' ||
                                $p == 'managerSales/addCustomer' ||
                                $path == 'managerSales/editCustomer'? 'active' : ''
                            }}" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>ادارة العملاء</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/managerSales/manageOrders"
            class="nav-link {{  $p == 'managerSales/manageOrders' ||
                                $p == 'managerSales/addOrder' ||
                                $path == 'managerSales/editOrder'? 'active' : '' }}">
                <i class="fas fa-inbox nav-icon"></i>
                <p>ادارة الطلبيات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/managerSales/manageTasks" 
            class="nav-link {{  $p == 'managerSales/manageTasks' || 
                                $p == 'managerSales/addTask' ||
                                $path =='managerSales/editTask'? 'active' : '' 
                            }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>ادارة المهام</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/managerSales/manageServices"
            class="nav-link {{  $p == 'managerSales/manageServices' ||
                                $p == 'managerSales/addService' ||
                                $path == 'managerSales/editService'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>ادارة الخدمات</p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
