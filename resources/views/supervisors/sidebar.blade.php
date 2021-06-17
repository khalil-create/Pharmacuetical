
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
            $index = 4;
            if($p != 'home'){
                $index = strpos($p,'/',12);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="/supervisor/manageRepresentatives" 
            class="nav-link {{  $p == 'supervisor/manageRepresentatives' || 
                                $p == 'supervisor/addRepresentative' ||
                                $path == 'supervisor/showMainareas' ||
                                $path == 'supervisor/storeRepMainArea' ||
                                $path =='supervisor/editRepresentative'? 'active' : '' 
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                متابعة المناديب
                <span class="badge badge-info right">6</span>
                </p>
            </a>
        </li>
        <li class="nav-item {{ $p == 'supervisor/manageCompanies' || 
                                $p == 'supervisor/companyAdd' ||
                                $p == 'supervisor/manageCategory' ||
                                $p == 'supervisor/categoryAdd' ||
                                $p == 'supervisor/manageItem' ||
                                $p == 'supervisor/itemAdd' ||
                                $path == 'supervisor/companyEdit' ||
                                $path == 'supervisor/categryEdit' ||
                                $path == 'supervisor/itemUses' ||
                                $path == 'supervisor/itemEdit'? 'menu-open' : ''
                            }}">
            <a
            class="nav-link {{  $p == 'supervisor/manageCompanies' || 
                                $p == 'supervisor/companyAdd' ||
                                $p == 'supervisor/categoryAdd' ||
                                $p == 'supervisor/manageCategory' ||
                                $p == 'supervisor/manageItem' ||
                                $p == 'supervisor/itemAdd' ||
                                $path == 'supervisor/companyEdit' ||
                                $path == 'supervisor/categryEdit' ||
                                $path == 'supervisor/itemUses' ||
                                $path == 'supervisor/itemEdit'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة الشركات
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/manageCompanies" 
                class="nav-link {{  $p == 'supervisor/manageCompanies' ||
                                    $p == 'supervisor/companyAdd' ||
                                    $path == 'supervisor/companyEdit' ? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الشركات</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/supervisor/manageCategory" 
                class="nav-link {{  $p == 'supervisor/manageCategory'||
                                    $p == 'supervisor/categoryAdd' ||
                                    $path == 'supervisor/categoryEdit' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/manageItem" 
                    class="nav-link {{  $p == 'supervisor/manageItem'||
                                        $p == 'supervisor/itemAdd' ||
                                        $path == 'supervisor/itemUses' ||
                                        $path == 'supervisor/itemEdit' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الاصناف</p>
                    </a>
                    </li>
            </ul>
        </li>
        <li class="nav-item {{ $p == 'supervisor/manageMainAreas' || 
                                $p == 'supervisor/addMainArea' || 
                                $p == 'supervisor/manageSubAreas' ||
                                $path == 'supervisor/addSubArea' || 
                                $path == 'supervisor/editMainArea' ||
                                $path == 'supervisor/supAreas' ||
                                $path == 'supervisor/editSubArea' ||
                                $path == 'supervisor/supAreas'? 'menu-open' : ''
                            }}">
            <a
            class="nav-link {{  $p == 'supervisor/manageMainAreas' ||
                                $p == 'supervisor/addMainArea' || 
                                $p == 'supervisor/manageSubAreas' || 
                                $path == 'supervisor/addSubArea' || 
                                $path == 'supervisor/supAreas' || 
                                $path == 'supervisor/editMainArea'||
                                $path == 'supervisor/editSubArea' ||
                                $path == 'supervisor/supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/manageMainAreas" 
                class="nav-link {{  $p == 'supervisor/manageMainAreas' ||
                                    $p == 'supervisor/addMainArea' ||
                                    $path == 'supervisor/supAreas' || 
                                    $path == 'supervisor/editMainArea' ||
                                    $path == 'supervisor/supAreas'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/supervisor/manageSubAreas" 
                class="nav-link {{  $p == 'supervisor/manageSubAreas'||
                                    $path == 'supervisor/addSubArea' ||  
                                    $path == 'supervisor/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/supervisor/manageSamples"
            class="nav-link {{  $p == 'supervisor/manageSamples' ||
                                $p == 'supervisor/addSample' ||
                                $path == 'supervisor/editSample' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة العينات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/supervisor/manageStudies" 
            class="nav-link {{  $p == 'supervisor/manageStudies' ||
                                $p == 'supervisor/addStudy' ||
                                $path == 'supervisor/studyStrengths' ||
                                $path == 'supervisor/addStrength' ||
                                $path == 'supervisor/addStrengthsExist' ||
                                $path == 'supervisor/editStrength' ||
                                $path == 'supervisor/editStudies' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الدراسات العلمية
                </p>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{url('manageCustomers')}}"
            class="nav-link {{  $p == 'manageCustomers' ||
                                $p == 'addCustomer' ||
                                $path == 'editCustomer' ? 'active' : ''  }}">
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
