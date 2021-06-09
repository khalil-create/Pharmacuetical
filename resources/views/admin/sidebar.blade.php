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
            <a href="/home" class="nav-link {{ request()->path() == 'home' ? 'active' : ''}}">
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
            <a href="{{url('admin/displayAllUsers')}}" 
            class="nav-link {{  $p == 'admin/displayAllUsers' || 
                                $p =='admin/addUser' ||
                                $path =='admin/editUser' ? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة الحسابات
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{url('manageManagers')}}" 
            class="nav-link {{  $p == 'manageManagers' || 
                                $p =='addManager' ||
                                $path =='editManager' ? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة مدراء الشركة
                </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{url('manageSupervisors')}}" 
            class="nav-link {{  $p == 'manageSupervisors' || 
                                $p == 'addSupervisor' ||
                                $path =='editSupervisor' || 
                                $path =='mainAreaSupervised'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المشرفين
                <span class="badge badge-info right">6</span>
                </p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{url('manageRepresentatives')}}" 
            class="nav-link {{  $p == 'manageRepresentatives' || 
                                $p == 'addRepresentative' ||
                                $path == 'showMainareas' ||
                                $path == 'storeRepMainArea' ||
                                $path =='editRepresentative'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المناديب
                <span class="badge badge-info right">6</span>
                </p>
            </a>
        </li> --}}
        <li class="nav-item {{ $p == 'admin/manageMainAreas' || 
                                $p == 'admin/addMainArea' || 
                                $p == 'admin/addSubArea' || 
                                $p == 'admin/manageSubAreas' ||
                                $path == 'admin/editMainArea' ||
                                $path == 'admin/editSubArea' ||
                                $path == 'admin/supAreas'? 'menu-open' : ''
                            }}">
            <a
            class="nav-link {{  $p == 'admin/manageMainAreas' ||
                                $p == 'admin/addMainArea' || 
                                $p == 'admin/addSubArea' || 
                                $p == 'admin/manageSubAreas' || 
                                $path == 'admin/editMainArea'||
                                $path == 'admin/editSubArea' ||
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
                                    $path == 'admin/supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/manageSubAreas')}}" 
                class="nav-link {{  $p == 'admin/manageSubAreas'||
                                    $p == 'admin/addSubArea' || 
                                    $path == 'admin/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ $p == 'admin/manageCompany' || 
                                $p == 'admin/addCompany' ||
                                $p == 'admin/manageCategories' ||
                                $p == 'admin/addCategory' ||
                                $p == 'admin/manageItems' ||
                                $p == 'admin/addItem' ||
                                $path == 'admin/editCompany' ||
                                $path == 'admin/editCategries' ||
                                $path == 'admin/itemUses' ||
                                $path == 'admin/editItems'? 'menu-open' : ''
                            }}">
            <a
            class="nav-link {{  $p == 'admin/manageCompany' || 
                                $p == 'admin/addCompany' ||
                                $p == 'admin/addCategory' ||
                                $p == 'admin/manageCategories' ||
                                $p == 'admin/manageItems' ||
                                $p == 'admin/addItem' ||
                                $path == 'admin/editCompany' ||
                                $path == 'admin/editCategry' ||
                                $path == 'admin/itemUses' ||
                                $path == 'admin/editItem'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة الشركات
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('admin/manageCompany')}}" 
                class="nav-link {{  $p == 'admin/manageCompany' ||
                                    $p == 'admin/addCompany' ||
                                    $path == 'admin/editCompany' ? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الشركات</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('admin/manageCategories')}}" 
                class="nav-link {{  $p == 'admin/manageCategories'||
                                    $p == 'admin/addCategory' ||
                                    $path == 'admin/editCategry' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/manageItems')}}" 
                    class="nav-link {{  $p == 'admin/manageItems'||
                                        $p == 'admin/addItem' ||
                                        $path == 'admin/itemUses' ||
                                        $path == 'admin/editItem' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الاصناف</p>
                    </a>
                    </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{url('admin/manageStudies')}}" 
            class="nav-link {{  $p == 'admin/manageStudies' ||
                                $p == 'admin/addStudy' ||
                                $path == 'admin/studyStrengths' ||
                                $path == 'admin/addStrength' ||
                                $path == 'admin/addStrengthsExist' ||
                                $path == 'admin/editStrength' ||
                                $path == 'admin/editStudies' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الدراسات العلمية
                </p>
            </a>
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
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>