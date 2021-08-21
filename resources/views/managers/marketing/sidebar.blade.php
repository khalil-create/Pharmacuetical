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
                <a href="/managerMarketing/profile/{{Auth::user()->id}}" class="d-block">{{$username[0]}} {{Auth::user()->user_surname}}
                    {{-- <br> --}}
                    <p class="text-bold text-sm"> {{Auth::user()->user_type}} </p>
                    {{-- <p class="text-bold text-sm"> {{Auth::user()->user_type}} </p> --}}
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
            <a href="{{url('/home')}}" class="nav-link {{ request()->path() == 'home' ? 'active' : ''}}">
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
                $index = strpos($p,'/',17);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="{{url('managerMarketing/manageSupervisors')}}" 
            class="nav-link {{  $p == 'managerMarketing/manageSupervisors' || 
                                $p == 'managerMarketing/addSupervisor' ||
                                $path =='managerMarketing/editSupervisor' || 
                                $path =='managerMarketing/showSupervisorDetails' || 
                                $path =='managerMarketing/mainAreaSupervised'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>ادارة المشرفين</p>
            </a>
        </li>
        <li class="nav-item {{ $p == 'managerMarketing/manageCompanies' || 
                                $p == 'managerMarketing/companyAdd' ||
                                $p == 'managerMarketing/manageCategory' ||
                                $p == 'managerMarketing/categoryAdd' ||
                                $p == 'managerMarketing/itemAdd' ||
                                $p == 'managerMarketing/manageItem' ||
                                $path == 'managerMarketing/addUseExist' ||
                                $path == 'managerMarketing/addUse' ||
                                $path == 'managerMarketing/editUse' ||
                                $path == 'managerMarketing/companyEdit' ||
                                $path == 'managerMarketing/categoryEdit' ||
                                $path == 'managerMarketing/itemUses' ||
                                $path == 'managerMarketing/showCompanyDetails' ||
                                $path == 'managerMarketing/showCategoryDetails' ||
                                $path == 'managerMarketing/showItemDetails' ||
                                $path == 'managerMarketing/itemEdit'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'managerMarketing/manageCompanies' || 
                                $p == 'managerMarketing/companyAdd' ||
                                $p == 'managerMarketing/categoryAdd' ||
                                $p == 'managerMarketing/manageCategory' ||
                                $p == 'managerMarketing/itemAdd' ||
                                $p == 'managerMarketing/manageItem' ||
                                $path == 'managerMarketing/addUseExist' ||
                                $path == 'managerMarketing/editUse' ||
                                $path == 'managerMarketing/addUse' ||
                                $path == 'managerMarketing/companyEdit' ||
                                $path == 'managerMarketing/categoryEdit' ||
                                $path == 'managerMarketing/itemUses' ||
                                $path == 'managerMarketing/showCompanyDetails' ||
                                $path == 'managerMarketing/showCategoryDetails' ||
                                $path == 'managerMarketing/showItemDetails' ||
                                $path == 'managerMarketing/itemEdit'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>ادارة الشركات<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('managerMarketing/manageCompanies')}}" 
                class="nav-link {{  $p == 'managerMarketing/manageCompanies' ||
                                    $p == 'managerMarketing/companyAdd' ||
                                $path == 'managerMarketing/showCompanyDetails' ||
                                    $path == 'managerMarketing/companyEdit' ? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الشركات</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('managerMarketing/manageCategory')}}" 
                class="nav-link {{  $p == 'managerMarketing/manageCategory'||
                                    $p == 'managerMarketing/categoryAdd' ||
                                $path == 'managerMarketing/showCategoryDetails' ||
                                    $path == 'managerMarketing/categoryEdit' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('managerMarketing/manageItem')}}" 
                    class="nav-link {{  $p == 'managerMarketing/manageItem'||
                                        $p == 'managerMarketing/itemAdd' ||
                                        $path == 'managerMarketing/addUseExist' ||
                                        $path == 'managerMarketing/editUse' ||
                                        $path == 'managerMarketing/addUse' ||
                                        $path == 'managerMarketing/itemUses' ||
                                        $path == 'managerMarketing/showItemDetails' ||
                                        $path == 'managerMarketing/itemEdit' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الاصناف</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ $p == 'managerMarketing/manageMainAreas' || 
                                $p == 'managerMarketing/addMainArea' || 
                                $p == 'managerMarketing/manageSubAreas' ||
                                $path == 'managerMarketing/addSubArea' || 
                                $path == 'managerMarketing/editMainArea' ||
                                $path == 'managerMarketing/supAreas' ||
                                $path == 'managerMarketing/editSubArea' ||
                                $path == 'managerMarketing/showSubareaReps' ||
                                $path == 'managerMarketing/addSubareaReps' ||
                                $path == 'managerMarketing/showMainareaDetails' ||
                                $path == 'managerMarketing/showSubareaDetails' ||
                                $path == 'managerMarketing/supAreas'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'managerMarketing/manageMainAreas' ||
                                $p == 'managerMarketing/addMainArea' || 
                                $p == 'managerMarketing/manageSubAreas' || 
                                $path == 'managerMarketing/addSubArea' || 
                                $path == 'managerMarketing/supAreas' || 
                                $path == 'managerMarketing/editMainArea'||
                                $path == 'managerMarketing/editSubArea' ||
                                $path == 'managerMarketing/showSubareaReps' ||
                                $path == 'managerMarketing/addSubareaReps' ||
                                $path == 'managerMarketing/showMainareaDetails' ||
                                $path == 'managerMarketing/showSubareaDetails' ||
                                $path == 'managerMarketing/supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('managerMarketing/manageMainAreas')}}" 
                class="nav-link {{  $p == 'managerMarketing/manageMainAreas' ||
                                    $p == 'managerMarketing/addMainArea' ||
                                    $path == 'managerMarketing/supAreas' || 
                                    $path == 'managerMarketing/editMainArea' ||
                                    $path == 'managerMarketing/showMainareaDetails' ||
                                    $path == 'managerMarketing/supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('managerMarketing/manageSubAreas')}}" 
                class="nav-link {{  $p == 'managerMarketing/manageSubAreas'||
                                    $path == 'managerMarketing/addSubArea' ||
                                    $path == 'managerMarketing/showSubareaReps' ||
                                    $path == 'managerMarketing/addSubareaReps' ||
                                    $path == 'managerMarketing/showSubareaDetails' || 
                                    $path == 'managerMarketing/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'managerMarketing/manageRepresentatives' || 
                                $p == 'managerMarketing/addRepresentative' ||
                                $p == 'managerMarketing/manageRepItems' ||
                                $path == 'managerMarketing/editRepItems' ||
                                $path == 'managerMarketing/showSubareas' ||
                                $path == 'managerMarketing/addRepSubareas' ||
                                $path == 'managerMarketing/showRepDetails' ||
                                $path == 'managerMarketing/storeRepMainArea' ||
                                $path =='managerMarketing/editRepresentative'||
                                $p == 'managerMarketing/manageSalesRepresentatives' || 
                                $p == 'managerMarketing/addSalesRepresentative' ||
                                // $p == 'managerMarketing/manageSalesRepItems' ||
                                // $path == 'managerMarketing/editSalesRepItems' ||
                                $path == 'managerMarketing/showSalesRepSubareas' ||
                                $path == 'managerMarketing/addSalesRepSubareas' ||
                                $path == 'managerMarketing/showSalesRepDetails' ||
                                // $path == 'managerMarketing/storeSalesRepMainArea' ||
                                $path =='managerMarketing/editSalesRepresentative'? 'menu-open' : '' 
                            }}">
            <a href="#"
                class="nav-link {{  $p == 'managerMarketing/manageRepresentatives' || 
                                    $p == 'managerMarketing/addRepresentative' ||
                                    $p == 'managerMarketing/manageRepItems' ||
                                    $path == 'managerMarketing/editRepItems' ||
                                    $path == 'managerMarketing/showSubareas' ||
                                    $path == 'managerMarketing/addRepSubareas' ||
                                    $path == 'managerMarketing/showRepDetails' ||
                                    $path == 'managerMarketing/storeRepMainArea' ||
                                    $path =='managerMarketing/editRepresentative'||
                                    $p == 'managerMarketing/manageSalesRepresentatives' || 
                                    $p == 'managerMarketing/addSalesRepresentative' ||
                                    // $p == 'managerMarketing/manageSalesRepItems' ||
                                    // $path == 'managerMarketing/editSalesRepItems' ||
                                    $path == 'managerMarketing/showSalesRepSubareas' ||
                                    $path == 'managerMarketing/addSalesRepSubareas' ||
                                    $path == 'managerMarketing/showSalesRepDetails' ||
                                    // $path == 'managerMarketing/storeSalesRepMainArea' ||
                                    $path =='managerMarketing/editSalesRepresentative'? 'active' : ''
                                }}">
                <i class="nav-icon fas fa-users"></i>
                <p>ادارة المندوبيين<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/managerMarketing/manageRepresentatives" 
                        class="nav-link {{  $p == 'managerMarketing/manageRepresentatives' || 
                                            $p == 'managerMarketing/addRepresentative' ||
                                            $path == 'managerMarketing/showMainareas' ||
                                            $path == 'managerMarketing/showSubareas' ||
                                            $path == 'managerMarketing/addRepSubareas' ||
                                            $path == 'managerMarketing/showRepDetails' ||
                                            $path =='managerMarketing/editRepresentative'? 'active' : '' 
                                        }}" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>المندوبيين العلميين</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/managerMarketing/manageSalesRepresentatives" 
                        class="nav-link {{  $p == 'managerMarketing/manageSalesRepresentatives' ||
                                            $p == 'managerMarketing/addSalesRepresentative' ||
                                            $path == 'managerMarketing/showSalesRepMainareas' ||
                                            $path == 'managerMarketing/showSalesRepSubareas' ||
                                            $path == 'managerMarketing/addSalesRepSubareas' ||
                                            $path == 'managerMarketing/showSalesRepDetails' ||
                                            $path =='managerMarketing/editSalesRepresentative'? 'active' : '' 
                                        }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>مندوبيين المبيعات</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/managerMarketing/manageRepItems"
                    class="nav-link {{  $p == 'managerMarketing/manageRepItems'||
                                        $p == 'managerMarketing/addRepItems' ||
                                        $p == 'managerMarketing/manageRepItems' ||
                                        $path == 'managerMarketing/editRepItems' ||
                                        $path == 'managerMarketing/editRepItems' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>اصناف المندوبيين</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'managerMarketing/manageDoctors' || 
                                $p == 'managerMarketing/manageCustomers' ||
                                $p == 'managerMarketing/manageOrders' ||
                                $p == 'managerMarketing/addDoctor' ||
                                $p == 'managerMarketing/addCustomer' ||
                                $p == 'managerMarketing/addOrder' ||
                                $path == 'managerMarketing/editDoctor' ||
                                $path == 'managerMarketing/editCustomer'||
                                $path == 'managerMarketing/showDoctorDetails'||
                                $path == 'managerMarketing/showCustomerDetails'||
                                $path == 'managerMarketing/showOrderDetails'||
                                $path == 'managerMarketing/editOrder'? 'menu-open' : ''
                            }}">
            <a href="#"class="nav-link {{  $p == 'managerMarketing/manageDoctors' || 
                                $p == 'managerMarketing/manageCustomers' ||
                                $p == 'managerMarketing/manageOrders' ||
                                $p == 'managerMarketing/addDoctor' ||
                                $p == 'managerMarketing/addCustomer' ||
                                $p == 'managerMarketing/addOrder' ||
                                $path == 'managerMarketing/editDoctor' ||
                                $path == 'managerMarketing/editCustomer'||
                                $path == 'managerMarketing/showDoctorDetails'||
                                $path == 'managerMarketing/showCustomerDetails'||
                                $path == 'managerMarketing/showOrderDetails'||
                                $path == 'managerMarketing/editOrder'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة العملاء
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/managerMarketing/manageDoctors"
                    class="nav-link {{  $p == 'managerMarketing/manageDoctors' || 
                                        $p == 'managerMarketing/addDoctor' ||
                                        $path == 'managerMarketing/showDoctorDetails'||
                                        $path == 'managerMarketing/editDoctor'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>الاطباء</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/managerMarketing/manageCustomers"
                        class="nav-link {{  $p == 'managerMarketing/manageCustomers' ||
                                            $p == 'managerMarketing/addCustomer' ||
                                            $path == 'managerMarketing/showCustomerDetails'||
                                            $path == 'managerMarketing/editCustomer'? 'active' : ''
                                        }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>العملاء</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/managerMarketing/manageOrders"
                    class="nav-link {{  $p == 'managerMarketing/manageOrders' ||
                                        $p == 'managerMarketing/addOrder' ||
                                        $path == 'managerMarketing/showOrderDetails'||
                                        $path == 'managerMarketing/editOrder'? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>الطلبيات</p>
                    </a>
                </li>
            </ul
            >
        </li>
        <li class="nav-item">
            <a href="{{url('managerMarketing/manageTasks')}}" 
            class="nav-link {{  $p == 'managerMarketing/manageTasks' || 
                                $p == 'managerMarketing/addTask' ||
                                $path =='managerMarketing/editTask'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المهام
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('managerMarketing/manageSamples')}}" 
            class="nav-link {{  $p == 'managerMarketing/manageSamples' || 
                                $path == 'managerMarketing/addSupervisorSample' ||
                                $path == 'managerMarketing/addSample' ||
                                $path =='managerMarketing/supervisorSamples'||
                                $path =='managerMarketing/editSupervisorSample'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة العينات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('managerMarketing/managePlanTypes')}}" 
            class="nav-link {{  $p == 'managerMarketing/managePlanTypes' ||
                                $p == 'managerMarketing/addPlanType' ||
                                $path == 'managerMarketing/editPlanType' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة الخطط
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('managerMarketing/manageSalesObjectives')}}" 
            class="nav-link {{  $p == 'managerMarketing/manageSalesObjectives' ||
                                $p == 'managerMarketing/addSalesObjective' ||
                                $path == 'managerMarketing/editSalesObjective'||
                                $path == 'managerMarketing/distributeSalesObjective' ? 'active' : ''  }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                ادارة الاهداف البيعية
                </p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
