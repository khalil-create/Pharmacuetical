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
            <div class="image"><?php $username = explode(' ',Auth::user()->user_name_third); ?>
            <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/managerMarketing/profile/{{Auth::user()->id}}" class="d-block">{{$username[0]}} {{Auth::user()->user_surname}}
                    {{-- <br> --}}
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
                                $path =='managerMarketing/mainAreaSupervised'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المشرفين
                <span class="badge badge-info right">6</span>
                </p>
            </a>
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
                                $p == 'managerMarketing/addSample' ||
                                $path =='managerMarketing/supervisorSamples'||
                                $path =='managerMarketing/editSample'? 'active' : '' 
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
        <li class="nav-item {{ $p == 'managerMarketing/manageCompanies' || 
                                $p == 'managerMarketing/companyAdd' ||
                                $p == 'managerMarketing/manageCategory' ||
                                $p == 'managerMarketing/categoryAdd' ||
                                $path == 'managerMarketing/itemAdd' ||
                                $path == 'managerMarketing/manageItem' ||
                                $path == 'managerMarketing/addUseExist' ||
                                $path == 'managerMarketing/companyEdit' ||
                                $path == 'managerMarketing/categryEdit' ||
                                $path == 'managerMarketing/itemUses' ||
                                $path == 'managerMarketing/editItems'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'managerMarketing/manageCompanies' || 
                                $p == 'managerMarketing/companyAdd' ||
                                $p == 'managerMarketing/categoryAdd' ||
                                $p == 'managerMarketing/manageCategory' ||
                                $path == 'managerMarketing/itemAdd' ||
                                $path == 'managerMarketing/manageItem' ||
                                $path == 'managerMarketing/addUseExist' ||
                                $path == 'managerMarketing/companyEdit' ||
                                $path == 'managerMarketing/categryEdit' ||
                                $path == 'managerMarketing/itemUses' ||
                                $path == 'managerMarketing/itemEdit'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة الشركات
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('managerMarketing/manageCompanies')}}" 
                class="nav-link {{  $p == 'managerMarketing/manageCompanies' ||
                                    $p == 'managerMarketing/companyAdd' ||
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
                                    $path == 'managerMarketing/categoryEdit' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('managerMarketing/manageItem',1)}}" 
                    class="nav-link {{  $p == 'managerMarketing/manageItem/1'||
                                        $p == 'managerMarketing/itemAdd/1' ||
                                        $path == 'managerMarketing/addUseExist' ||
                                        $path == 'managerMarketing/itemUses' ||
                                        $path == 'managerMarketing/itemEdit' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>اصناف لديها فئات</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('managerMarketing/manageItem',0)}}" 
                    class="nav-link {{  $p == 'managerMarketing/manageItem/0'||
                                        $p == 'managerMarketing/itemAdd/0' ||
                                        $path == 'managerMarketing/itemUsesNoCat' ||
                                        $path == 'managerMarketing/addUseNoCat' ||
                                        $path == 'managerMarketing/editUseNoCat' ||
                                        $path == 'managerMarketing/itemEditNoCat' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>اصناف ليس لديها فئات</p>
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
                                    $path == 'managerMarketing/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
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
