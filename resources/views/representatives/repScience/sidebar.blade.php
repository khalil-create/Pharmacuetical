
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
            <a href="/repScience/profile/{{Auth::user()->id}}" class="d-block">
                {{$username[0]}} {{Auth::user()->user_surname}}
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
            $profile = substr($p,0,7);
            if($p != 'home' && $p !='not-allowed' && $profile != 'profile'){
                $index = strpos($p,'/',16);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item {{  $p == 'repScience/manageDoctors' || 
                                $p == 'repScience/manageCustomers' ||
                                $p == 'repScience/manageOrders' ||
                                $p == 'repScience/addDoctor' ||
                                $p == 'repScience/addCustomer' ||
                                $p == 'repScience/addOrder' ||
                                $path == 'repScience/editDoctor' ||
                                $path == 'repScience/editCustomer'||
                                $path == 'repScience/editOrder'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'repScience/manageDoctors' || 
                                $p == 'repScience/manageCustomers' ||
                                $p == 'repScience/manageOrders' ||
                                $p == 'repScience/addDoctor' ||
                                $p == 'repScience/addCustomer' ||
                                $p == 'repScience/addOrder' ||
                                $path == 'repScience/editDoctor' ||
                                $path == 'repScience/editCustomer'||
                                $path == 'repScience/editOrder'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة العملاء
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/repScience/manageDoctors"
                    class="nav-link {{  $p == 'repScience/manageDoctors' || 
                                        $p == 'repScience/addDoctor' ||
                                        $path == 'repScience/editDoctor'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الدكاتره</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/repScience/manageCustomers"
                    class="nav-link {{  $p == 'repScience/manageCustomers' ||
                                        $p == 'repScience/addCustomer' ||
                                        $path == 'repScience/editCustomer'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>العملاء</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/repScience/manageOrders"
                    class="nav-link {{  $p == 'repScience/manageOrders' ||
                                        $p == 'repScience/addOrder' ||
                                        $path == 'repScience/editOrder'? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>
                        الطلبيات
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'repScience/manageCompetitors' || 
                                $p == 'repScience/manageAlternatives' ||
                                $p == 'repScience/manageCompetitionServices' ||
                                $p == 'repScience/managePromotionMaterials' ||
                                $p == 'repScience/addAlternative' ||
                                $p == 'repScience/addCompetitionService' ||
                                $p == 'repScience/addPromotionMaterial' ||
                                $path == 'repScience/editAlternative' ||
                                $path == 'repScience/editCompetitionService'||
                                $path == 'repScience/editPromotionMaterial'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'repScience/manageCompetitors' || 
                                $p == 'repScience/manageAlternatives' ||
                                $p == 'repScience/manageCompetitionServices' ||
                                $p == 'repScience/managePromotionMaterials' ||
                                $p == 'repScience/addAlternative' ||
                                $p == 'repScience/addCompetitionService' ||
                                $p == 'repScience/addPromotionMaterial' ||
                                $path == 'repScience/editAlternative' ||
                                $path == 'repScience/editCompetitionService'||
                                $path == 'repScience/editPromotionMaterial'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المنافسين
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/repScience/manageAlternatives"
                    class="nav-link {{  $p == 'repScience/manageAlternatives' || 
                                        $p == 'repScience/addAlternative' ||
                                        $path == 'repScience/editAlternative'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>بدائل الأصناف</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/repScience/manageCompetitionServices"
                    class="nav-link {{  $p == 'repScience/manageCompetitionServices' ||
                                        $p == 'repScience/addCompetitionService' ||
                                        $path == 'repScience/editCompetitionService'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الخدمات المنافسه</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/repScience/managePromotionMaterials"
                    class="nav-link {{  $p == 'repScience/managePromotionMaterials' ||
                                        $p == 'repScience/addPromotionMaterial' ||
                                        $path == 'repScience/editPromotionMaterial'? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>المواد الترويجية</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/repScience/managePlans"
            class="nav-link {{  $p == 'repScience/managePlans' ||
                                $p == 'repScience/addPlan' ||
                                $path == 'repScience/planDetials' ||
                                $path == 'repScience/editPlanCustomer' ||
                                $path == 'repScience/editPlan'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة الخطط
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/manageServices"
            class="nav-link {{  $p == 'repScience/manageServices' ||
                                $p == 'repScience/addService' ||
                                $path == 'repScience/editService'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الخدمات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/manageVisits"
            class="nav-link {{  $p == 'repScience/manageVisits' ||
                                $p == 'repScience/addVisit' ||
                                $path == 'repScience/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الزيارات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/manageCourses"
            class="nav-link {{  $p == 'repScience/manageCourses'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                المواد التدريبية
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/manageTests"
            class="nav-link {{  $p == 'repScience/manageTests' ||
                                $path == 'repScience/repTests' ||
                                $path == 'repScience/storeRepTest' ||
                                $path == 'repScience/showTestResult'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>الاختبارات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/showStudies"
            class="nav-link {{  $p == 'repScience/showStudies'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الدراسات العلمية
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/showSalesObjectives"
            class="nav-link {{  $p == 'repScience/showSalesObjectives'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                الاهداف البيعية
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/repScience/showChargedTasks"
            class="nav-link {{  
                                $p == 'repScience/showChargedTasks' ||
                                $path == 'repScience/performTask' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                المهام المكلفة
                </p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
