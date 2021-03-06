
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <img src="{{asset('designImages/ab.jpg')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        {{-- <imgsrc="{{asset('designImages/ab.jpg')}}" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
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
            <a href="/supervisor/profile/{{Auth::user()->id}}" class="d-block">
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
            $path2 = 'home';
            $profile = substr($p,0,7);
            if($p != 'home' && $p !='not-allowed' && $profile != 'profile'){
                $index = strpos($p,'/',12);
                $index2 = strpos($p,'/',10);
                $path2 = substr($p,0,$index2+9);
            }
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item {{  $p == 'supervisor/manageRepresentatives' || 
                                $p == 'supervisor/addRepresentative' ||
                                $p == 'supervisor/manageRepItems' ||
                                $path == 'supervisor/editRepItems' ||
                                $path == 'supervisor/showSubareas' ||
                                $path == 'supervisor/addRepSubareas' ||
                                $path == 'supervisor/showRepDetails' ||
                                $path == 'supervisor/storeRepMainArea' ||
                                $path =='supervisor/editRepresentative'? 'menu-open' : '' 
                            }}">
            <a href="#"
                class="nav-link {{  $p == 'supervisor/manageRepresentatives' || 
                                    $p == 'supervisor/addRepresentative' ||
                                    $p == 'supervisor/manageRepItems' ||
                                    $path == 'supervisor/editRepItems' ||
                                    $path == 'supervisor/showSubareas' ||
                                    $path == 'supervisor/addRepSubareas' ||
                                    $path == 'supervisor/showRepDetails' ||
                                    $path == 'supervisor/storeRepMainArea' ||
                                    $path =='supervisor/editRepresentative'? 'active' : ''
                                }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    ادارة المندوبيين
                    <i class="right fas fa-angle-left"></i>
                    </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/supervisor/manageRepresentatives" 
                        class="nav-link {{  $p == 'supervisor/manageRepresentatives' || 
                                            $p == 'supervisor/addRepresentative' ||
                                            $path == 'supervisor/showMainareas' ||
                                            $path == 'supervisor/showSubareas' ||
                                            $path == 'supervisor/addRepSubareas' ||
                                            $path == 'supervisor/showRepDetails' ||
                                            $path =='supervisor/editRepresentative'? 'active' : '' 
                                        }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>المندوبيين العلميين</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/manageRepItems"
                    class="nav-link {{  $p == 'supervisor/manageRepItems'||
                                        $p == 'supervisor/addRepItems' ||
                                        $p == 'supervisor/manageRepItems' ||
                                        $path == 'supervisor/editRepItems' ||
                                        $path == 'supervisor/editRepItems' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>اصناف المندوبيين</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'supervisor/manageDoctors' || 
                                $p == 'supervisor/manageCustomers' ||
                                $p == 'supervisor/manageOrders' ||
                                $p == 'supervisor/addDoctor' ||
                                $p == 'supervisor/addCustomer' ||
                                $p == 'supervisor/addOrder' ||
                                $path == 'supervisor/editDoctor' ||
                                $path == 'supervisor/editCustomer'||
                                $path == 'supervisor/showDoctorDetails'||
                                $path == 'supervisor/showCustomerDetails'||
                                $path == 'supervisor/showOrderDetails'||
                                $path == 'supervisor/editOrder'? 'menu-open' : ''
                            }}">
            <a href="#"class="nav-link {{  $p == 'supervisor/manageDoctors' || 
                                $p == 'supervisor/manageCustomers' ||
                                $p == 'supervisor/manageOrders' ||
                                $p == 'supervisor/addDoctor' ||
                                $p == 'supervisor/addCustomer' ||
                                $p == 'supervisor/addOrder' ||
                                $path == 'supervisor/editDoctor' ||
                                $path == 'supervisor/editCustomer'||
                                $path == 'supervisor/showDoctorDetails'||
                                $path == 'supervisor/showCustomerDetails'||
                                $path == 'supervisor/showOrderDetails'||
                                $path == 'supervisor/editOrder'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة العملاء
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/manageDoctors"
                    class="nav-link {{  $p == 'supervisor/manageDoctors' || 
                                        $p == 'supervisor/addDoctor' ||
                                        $path == 'supervisor/showDoctorDetails'||
                                        $path == 'supervisor/editDoctor'? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-user nav-icon"></i>
                        <p>الاطباء</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/manageCustomers"
                        class="nav-link {{  $p == 'supervisor/manageCustomers' ||
                                            $p == 'supervisor/addCustomer' ||
                                            $path == 'supervisor/showCustomerDetails'||
                                            $path == 'supervisor/editCustomer'? 'active' : ''
                                        }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>العملاء</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/manageOrders"
                    class="nav-link {{  $p == 'supervisor/manageOrders' ||
                                        $p == 'supervisor/addOrder' ||
                                        $path == 'supervisor/showOrderDetails'||
                                        $path == 'supervisor/editOrder'? 'active' : '' }}">
                        <i class="fas fa-inbox nav-icon"></i>
                        <p>الطلبيات</p>
                    </a>
                </li>
            </ul
            >
        </li>
        <li class="nav-item {{  $p == 'supervisor/manageCompanies' || 
                                $p == 'supervisor/companyAdd' ||
                                $p == 'supervisor/manageCategory' ||
                                $p == 'supervisor/categoryAdd' ||
                                $p == 'supervisor/manageItem' ||
                                $p == 'supervisor/itemAdd' ||
                                $path == 'supervisor/companyEdit' ||
                                $path == 'supervisor/categoryEdit' ||
                                $path == 'supervisor/itemUses' ||
                                // $path == 'supervisor/itemUsesNoCat' ||
                                $path == 'supervisor/addUse' ||
                                $path == 'supervisor/addUseExist' ||
                                $path == 'supervisor/itemEdit' ||
                                $path == 'supervisor/editUse' ||
                                // $path == 'supervisor/editUseNoCat' ||
                                $path == 'supervisor/showCompanyDetails' ||
                                $path == 'supervisor/showCategoryDetails' ||
                                $path == 'supervisor/showItemDetails' ? 'menu-open' : ''
                            }}">
            <a href="#"
                class="nav-link {{  $p == 'supervisor/manageCompanies' || 
                                    $p == 'supervisor/companyAdd' ||
                                    $p == 'supervisor/categoryAdd' ||
                                    $p == 'supervisor/manageCategory' ||
                                    $p == 'supervisor/manageItem' ||
                                    $p == 'supervisor/itemAdd' ||
                                    $path == 'supervisor/companyEdit' ||
                                    $path == 'supervisor/categoryEdit' ||
                                    $path == 'supervisor/itemUses' ||
                                    $path == 'supervisor/addUseExist' ||
                                    $path == 'supervisor/addUse' ||
                                    $path == 'supervisor/itemUses' ||
                                    $path == 'supervisor/itemEdit'||
                                    $path == 'supervisor/editUse' ||
                                    // $path == 'supervisor/editUseNoCat' ||
                                    $path == 'supervisor/showCompanyDetails' ||
                                    $path == 'supervisor/showCategoryDetails' ||
                                    $path == 'supervisor/showItemDetails' ? 'active' : ''
                                }}">
                    <i class="nav-icon far fa-building"></i>
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
                                        $path == 'supervisor/showCompanyDetails'||
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
                                    $path == 'supervisor/showCategoryDetails' ||
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
                                        $path == 'supervisor/addUseExist' ||
                                        $path == 'supervisor/addUse' ||
                                        $path == 'supervisor/editUse' ||
                                        $path == 'supervisor/showItemDetails' ||
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
                                $path == 'supervisor/showSubareaReps'||
                                $path == 'supervisor/addSubareaReps'|| 
                                $path == 'supervisor/showMainareaDetails' ||
                                $path == 'supervisor/showSubareaDetails' ||
                                $path == 'supervisor/supAreas'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'supervisor/manageMainAreas' ||
                                $p == 'supervisor/addMainArea' || 
                                $p == 'supervisor/manageSubAreas' || 
                                $path == 'supervisor/addSubArea' || 
                                $path == 'supervisor/supAreas' || 
                                $path == 'supervisor/editMainArea'||
                                $path == 'supervisor/showSubareaReps'||
                                $path == 'supervisor/addSubareaReps'|| 
                                $path == 'supervisor/editSubArea' ||
                                $path == 'supervisor/showMainareaDetails' ||
                                $path == 'supervisor/showSubareaDetails' ||
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
                                    $path == 'supervisor/showMainareaDetails' ||
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
                                    $path == 'supervisor/showSubareaReps'||
                                    $path == 'supervisor/addSubareaReps'|| 
                                    $path == 'supervisor/showSubareaDetails' ||
                                    $path == 'supervisor/editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'supervisor/manageChargedTasks' ||
                                $p == 'supervisor/manageDistributedTasks' || 
                                $p == 'supervisor/addDistributedTask' || 
                                $path == 'supervisor/editDistributedTask' || 
                                $path =='supervisor/performTask'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'supervisor/manageChargedTasks' || 
                                $p == 'supervisor/manageDistributedTasks' ||
                                $p == 'supervisor/addDistributedTask' ||
                                $path == 'supervisor/editDistributedTask' ||
                                $path =='supervisor/performTask'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المهام
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/manageChargedTasks" 
                class="nav-link {{  $p == 'supervisor/manageChargedTasks' || 
                                    $p == 'supervisor/addTask' ||
                                    $path =='supervisor/performTask'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مهام مطلوبه</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/supervisor/manageDistributedTasks" 
                class="nav-link {{  $p == 'supervisor/manageDistributedTasks' || 
                                    $p == 'supervisor/addDistributedTask' ||
                                    $path == 'supervisor/editDistributedTask' ||
                                    $path =='supervisor/editTask' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>تكاليف</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'supervisor/managePlanTypes' ||
                                $p == 'supervisor/manageRepsPlans' || 
                                $p == 'supervisor/addPlanType' || 
                                $p == 'supervisor/addRepPlan' || 
                                $path == 'supervisor/planDetials' || 
                                $path == 'supervisor/editRepPlan'|| 
                                $path2 == 'supervisor/editPlan' ||
                                $path == 'supervisor/editPlanType' ? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'supervisor/managePlanTypes' || 
                                $p == 'supervisor/manageRepsPlans' || 
                                $p == 'supervisor/addPlanType' || 
                                $p == 'supervisor/addRepPlan' || 
                                $path == 'supervisor/planDetials' || 
                                $path == 'supervisor/editRepPlan'|| 
                                $path2 == 'supervisor/editPlan' ||
                                $path == 'supervisor/editPlanType' ? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة الخطط
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/managePlanTypes" 
                class="nav-link {{  $p == 'supervisor/managePlanTypes' ||
                                    $p == 'supervisor/addPlanType' || 
                                    $p == 'supervisor/editPlanType'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>انواع الخطط</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="/supervisor/manageRepsPlans" 
                class="nav-link {{  $p == 'supervisor/manageRepsPlans' ||
                                    $p == 'supervisor/addRepPlan' ||
                                    $path == 'supervisor/planDetials' || 
                                    $path2 == 'supervisor/editPlan' ||
                                    $path == 'supervisor/editRepPlan'? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>خطط المندوبين</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{  $p == 'supervisor/manageTrainingCourses' ||
                                $p == 'supervisor/addCourse' ||
                                $p == 'supervisor/manageStudies' ||
                                $p == 'supervisor/addStudy' ||
                                $p == 'supervisor/manageTests'||
                                $p == 'supervisor/addTest' ||
                                $path == 'supervisor/editCourse'||
                                $path == 'supervisor/studyStrengths' ||
                                $path == 'supervisor/addStrength' ||
                                $path == 'supervisor/addStrengthsExist' ||
                                $path == 'supervisor/editStrength' ||
                                $path == 'supervisor/editStudies' ||
                                $path == 'supervisor/manageTestReps' ||
                                $path == 'supervisor/addTestReps' ||
                                $path == 'supervisor/editTestReps' ||
                                $path == 'supervisor/showStudyDetails' ||
                                $path2 == 'supervisor/manageTe' ||
                                $path2 == 'supervisor/manageQu' ||
                                $path2 == 'supervisor/addTest' ||
                                $path2 == 'supervisor/editQues' ||
                                $path2 == 'supervisor/editTest' ||
                                $path2 == 'supervisor/showReps' ||
                                $path == 'supervisor/editTest'? 'menu-open' : ''
                            }}">
            <a href="#"
            class="nav-link {{  $p == 'supervisor/manageTrainingCourses' ||
                                $p == 'supervisor/addCourse' ||
                                $p == 'supervisor/manageStudies' ||
                                $p == 'supervisor/addStudy' ||
                                $p == 'supervisor/manageTests'||
                                $p == 'supervisor/addTest' ||
                                $path == 'supervisor/studyStrengths' ||
                                $path == 'supervisor/editCourse'||
                                $path == 'supervisor/addStrength' ||
                                $path == 'supervisor/addStrengthsExist' ||
                                $path == 'supervisor/editStrength' ||
                                $path == 'supervisor/editStudies' ||
                                $path == 'supervisor/manageTestReps' ||
                                $path == 'supervisor/addTestReps' ||
                                $path == 'supervisor/editTestReps' ||
                                $path == 'supervisor/showStudyDetails' ||
                                $path2 == 'supervisor/manageTe' ||
                                $path2 == 'supervisor/manageQu' ||
                                $path2 == 'supervisor/addTest' ||
                                $path2 == 'supervisor/editQues' ||
                                $path2 == 'supervisor/editTest' ||
                                $path2 == 'supervisor/showReps' ||
                                $path == 'supervisor/editTest'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة بناء القدرات
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="/supervisor/manageTests" 
                class="nav-link {{  $p == 'supervisor/manageTests'||
                                    $p == 'supervisor/addTest' ||
                                    $path == 'supervisor/manageTestReps' ||
                                    $path == 'supervisor/addTestReps' ||
                                    $path == 'supervisor/editTestReps' ||
                                    $path2 == 'supervisor/manageTe' ||
                                    $path2 == 'supervisor/manageQu' ||
                                    $path2 == 'supervisor/addTest' ||
                                    $path2 == 'supervisor/editTest' ||
                                    $path2 == 'supervisor/editQues' ||
                                    $path2 == 'supervisor/showReps' ||
                                    $path == 'supervisor/editTest'? 'active' : '' 
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الاختبارات</p>
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
                                        $path == 'supervisor/showStudyDetails' ||
                                        $path == 'supervisor/editStudies' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الدراسات العلمية</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/supervisor/manageTrainingCourses" 
                    class="nav-link {{  $p == 'supervisor/manageTrainingCourses' ||
                                        $p == 'supervisor/addCourse' ||
                                        $path == 'supervisor/editCourse' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>المواد التدريبية</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/supervisor/manageServices"
            class="nav-link {{  $p == 'supervisor/manageServices' ||
                                $p == 'supervisor/addService' ||
                                $path == 'supervisor/showServiceDetails' ||
                                $path == 'supervisor/editService'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>الخدمات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/supervisor/manageVisits"
            class="nav-link {{  $p == 'supervisor/manageVisits' ||
                                $p == 'supervisor/addVisit' ||
                                $path == 'supervisor/showVisitDetails'||
                                $path == 'supervisor/editVisit'? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p> الزيارات</p>
            </a>
        {{-- </li>
        <li class="nav-item">
            <a href="/supervisor/manageTrainingCourses"
            class="nav-link {{  $p == 'supervisor/manageTrainingCourses' ||
                                $p == 'supervisor/addCourse' ||
                                $path == 'supervisor/editCourse' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة المواد التدريبية
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="/supervisor/manageSamples"
            class="nav-link {{  $p == 'supervisor/manageSamples' ||
                                $p == 'supervisor/addSample' ||
                                $path == 'supervisor/divideSample' ||
                                $path == 'supervisor/displaySampleReps' ||
                                $path == 'supervisor/editDividedSample' ||
                                $path == 'supervisor/editSample' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p> ادارة العينات</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('supervisor/manageSalesObjectives')}}" 
            class="nav-link {{  $p == 'supervisor/manageSalesObjectives' ||
                                $path == 'supervisor/divideSalesObjective' ||
                                $path == 'supervisor/displaySalesObjectiveReps' ||
                                $path == 'supervisor/addDividedSalesObjective' ||
                                $path == 'supervisor/editDividedsalesObjective'? 'active' : ''  }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>ادارة الاهداف البيعية</p>
            </a>
        {{-- </li>
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
        </li> --}}

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
