<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="{{asset('designImages/ab.jpg')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">التسويق الدوائي</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"><?php $username = explode(' ',Auth::user()->user_name_third); ?>
                @if (Auth::user()->user_image)
                    <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{asset('designImages/user.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
            <a href="/admin/profile/{{Auth::user()->id}}" class="d-block">
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
                $index = strpos($p,'/',6);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="{{url('admin/displayAllUsers')}}" 
            class="nav-link {{  $p == 'admin/displayAllUsers' || 
                                $p =='admin/addUser' ||
                                $path =='admin/showUserDetails'||
                                $path =='admin/editUser' ? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة الحسابات
                </p>
            </a>
        </li>
        
        <li class="nav-item {{ $p == 'admin/manageCompanies' || 
                                $p == 'admin/companyAdd' ||
                                $p == 'admin/manageCategory' ||
                                $p == 'admin/categoryAdd' ||
                                $p == 'admin/itemAdd' ||
                                $p == 'admin/manageItem' ||
                                $path == 'admin/addUseExist' ||
                                $path == 'admin/addUse' ||
                                $path == 'admin/editUse' ||
                                $path == 'admin/companyEdit' ||
                                $path == 'admin/categoryEdit' ||
                                $path == 'admin/itemUses' ||
                                $path == 'admin/showCompanyDetails' ||
                                $path == 'admin/showCategoryDetails' ||
                                $path == 'admin/showItemDetails' ||
                                $path == 'admin/itemEdit'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'admin/manageCompanies' || 
                                $p == 'admin/companyAdd' ||
                                $p == 'admin/categoryAdd' ||
                                $p == 'admin/manageCategory' ||
                                $p == 'admin/itemAdd' ||
                                $p == 'admin/manageItem' ||
                                $path == 'admin/addUseExist' ||
                                $path == 'admin/addUse' ||
                                $path == 'admin/editUse' ||
                                $path == 'admin/companyEdit' ||
                                $path == 'admin/categoryEdit' ||
                                $path == 'admin/itemUses' ||
                                $path == 'admin/showCompanyDetails' ||
                                $path == 'admin/showCategoryDetails' ||
                                $path == 'admin/showItemDetails' ||
                                $path == 'admin/itemEdit'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>ادارة الشركات<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/manageCompanies')}}" 
                class="nav-link {{  $p == 'admin/manageCompanies' ||
                                    $p == 'admin/companyAdd' ||
                                $path == 'admin/showCompanyDetails' ||
                                    $path == 'admin/companyEdit' ? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الشركات</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/manageCategory')}}" 
                class="nav-link {{  $p == 'admin/manageCategory'||
                                    $p == 'admin/categoryAdd' ||
                                $path == 'admin/showCategoryDetails' ||
                                    $path == 'admin/categoryEdit' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/manageItem')}}" 
                    class="nav-link {{  $p == 'admin/manageItem'||
                                        $p == 'admin/itemAdd' ||
                                        $path == 'admin/addUseExist' ||
                                        $path == 'admin/editUse' ||
                                        $path == 'admin/addUse' ||
                                        $path == 'admin/itemUses' ||
                                        $path == 'admin/showItemDetails' ||
                                        $path == 'admin/itemEdit' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الاصناف</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ $p == 'admin/manageMainAreas' || 
                                $p == 'admin/addMainArea' || 
                                $p == 'admin/manageSubAreas' ||
                                $path == 'admin/addSubArea' || 
                                $path == 'admin/editMainArea' ||
                                $path == 'admin/editSubArea' ||
                                $path =='admin/showMainareaDetails'||
                                $path =='admin/showSubareaDetails'||
                                $path =='admin/showSubareaReps'||
                                $path =='admin/addSubareaReps'||
                                $path == 'admin/supAreas'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'admin/manageMainAreas' ||
                                $p == 'admin/addMainArea' || 
                                $p == 'admin/manageSubAreas' || 
                                $path == 'admin/addSubArea' || 
                                $path == 'admin/editMainArea'||
                                $path == 'admin/editSubArea' ||
                                $path =='admin/showMainareaDetails'||
                                $path =='admin/showSubareaDetails'||
                                $path =='admin/showSubareaReps'||
                                $path =='admin/addSubareaReps'||
                                $path == 'admin/supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/manageMainAreas')}}" 
                class="nav-link {{  $p == 'admin/manageMainAreas' ||
                                    $p == 'admin/addMainArea' || 
                                    $path == 'admin/editMainArea' ||
                                    $path =='admin/showMainareaDetails'||
                                    $path == 'admin/supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/manageSubAreas')}}" 
                class="nav-link {{  $p == 'admin/manageSubAreas'||
                                    $path == 'admin/addSubArea' || 
                                    $path =='admin/showSubareaDetails'||
                                    $path =='admin/showSubareaReps'||
                                    $path =='admin/addSubareaReps'||
                                    $path == 'admin/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'admin/manageDoctors' || 
                                $p == 'admin/manageCustomers' ||
                                $p == 'admin/manageOrders' ||
                                $p == 'admin/addDoctor' ||
                                $p == 'admin/addCustomer' ||
                                $p == 'admin/addOrder' ||
                                $path == 'admin/editDoctor' ||
                                $path == 'admin/editCustomer'||
                                $path == 'admin/showDoctorDetails'||
                                $path == 'admin/showCustomerDetails'||
                                $path == 'admin/showOrderDetails'||
                                $path == 'admin/editOrder'? 'menu-open' : ''
                            }}">
            <a href="#"class="nav-link {{  $p == 'admin/manageDoctors' || 
                                $p == 'admin/manageCustomers' ||
                                $p == 'admin/manageOrders' ||
                                $p == 'admin/addDoctor' ||
                                $p == 'admin/addCustomer' ||
                                $p == 'admin/addOrder' ||
                                $path == 'admin/editDoctor' ||
                                $path == 'admin/editCustomer'||
                                $path == 'admin/showDoctorDetails'||
                                $path == 'admin/showCustomerDetails'||
                                $path == 'admin/showOrderDetails'||
                                $path == 'admin/editOrder'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة العملاء
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/admin/manageDoctors"
                    class="nav-link {{  $p == 'admin/manageDoctors' || 
                                        $p == 'admin/addDoctor' ||
                                        $path == 'admin/showDoctorDetails'||
                                        $path == 'admin/editDoctor'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>الاطباء</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/manageCustomers"
                        class="nav-link {{  $p == 'admin/manageCustomers' ||
                                            $p == 'admin/addCustomer' ||
                                            $path == 'admin/showCustomerDetails'||
                                            $path == 'admin/editCustomer'? 'active' : ''
                                        }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>العملاء</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/manageOrders"
                    class="nav-link {{  $p == 'admin/manageOrders' ||
                                        $p == 'admin/addOrder' ||
                                        $path == 'admin/showOrderDetails'||
                                        $path == 'admin/editOrder'? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>الطلبيات</p>
                    </a>
                </li>
            </ul
            >
        </li>
        <li class="nav-item">
            <a href="{{url('admin/manageSamples')}}" 
            class="nav-link {{  $p == 'admin/manageSamples' ||
                                $p == 'admin/addSample' ||
                                $path == 'admin/editSample' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة العينات
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{url('admin/manageTasks')}}" 
            class="nav-link {{  $p == 'admin/manageTasks' ||
                                $p == 'admin/addTask' ||
                                $path == 'admin/editTask' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة المهام
                </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{url('admin/manageCustomers')}}" 
            class="nav-link {{  $p == 'admin/manageCustomers' ||
                                $p == 'admin/addCustomer' ||
                                $path == 'admin/editCustomer' ? 'active' : ''  }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                ادارة العملاء
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{url('admin/managePlanTypes')}}" 
            class="nav-link {{  $p == 'admin/managePlanTypes' ||
                                $p == 'admin/addPlanType' ||
                                $path == 'admin/editPlanType' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة الخطط
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('admin/manageSpecialistsDoctors')}}" 
            class="nav-link {{  $p == 'admin/manageSpecialistsDoctors' ||
                                $p == 'admin/addSpecialist' ||
                                $path == 'admin/editSpecialist' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة التخصصات
                </p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>