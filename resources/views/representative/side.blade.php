@extends('layouts.index')
{{-- @section('title')
    ادارة الحسابات
@endsection --}}
@section('content')

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
            <a href="#" class="d-block">{{Auth::user()->user_name_third}} {{Auth::user()->user_surname}}</a>
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
            $index = strpos($p,'/');
            $path = substr($p,0,$index);
        @endphp
        <li class="nav-item">
            <a href="{{url('displayAllUsers')}}"
            class="nav-link {{  $p == 'displayAllUsers' ||
                                $path =='editUser' ||
                                $path =='addUser' ? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                ادارة الحسابات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('manageSupervisors')}}"
            class="nav-link {{  $p == 'manageSupervisors' ||
                                $path =='editSupervisor' ||
                                $path =='mainAreaSupervised' ||
                                $path == 'addSupervisor' ? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                ادارة المندوبين
                <span class="badge badge-info right">6</span>
                </p>
            </a>
        </li>
        <li class="nav-item {{ $p == 'manageMainAreas' ||
                                $p == 'addMainArea' ||
                                $p == 'addSubArea' ||
                                $p == 'manageSubAreas' ||
                                $path == 'editMainArea' ||
                                $path == 'editSubArea' ||
                                $path == 'supAreas'? 'menu-open' : ''
                            }}">
            <a href="{{url('manageMainAreas')}}"
            class="nav-link {{  $p == 'manageMainAreas' ||
                                $p == 'addMainArea' ||
                                $p == 'addSubArea' ||
                                $p == 'manageSubAreas' ||
                                $path == 'editMainArea'||
                                $path == 'editSubArea' ||
                                $path == 'supAreas'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة المناطق
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('manageMainAreas')}}"
                class="nav-link {{  $p == 'manageMainAreas' ||
                                    $p == 'addMainArea' ||
                                    $path == 'editMainArea' ||
                                    $path == 'supAreas'? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الرئيسية</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('manageSubAreas')}}"
                class="nav-link {{  $p == 'manageSubAreas'||
                                    $p == 'addSubArea' ||
                                    $path == 'editSubArea' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>المناطق الفرعية</p>
                </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ $p == 'manageCompany' ||
                                $p == 'addCompany' ||
                                $p == 'manageCategories' ||
                                $p == 'addCategories' ||
                                $p == 'manageItems' ||
                                $p == 'addItems' ||
                                $path == 'editCompany' ||
                                $path == 'editCategries' ||
                                $path == 'editItems'? 'menu-open' : ''
                            }}">
            <a href="{{url('manageCompany')}}"
            class="nav-link {{  $p == 'manageCompany' ||
                                $p == 'addCompany' ||
                                $p == 'addCategory' ||
                                $p == 'manageCategories' ||
                                $p == 'manageItems' ||
                                $p == 'addItem' ||
                                $path == 'editCompany' ||
                                $path == 'editCategry' ||
                                $path == 'editItem'? 'active' : ''
                            }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                ادارة الشركات
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('manageCompany')}}"
                class="nav-link {{  $p == 'manageCompany' ||
                                    $p == 'addCompany' ||
                                    $path == 'editCompany' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>الشركات</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('manageCategories')}}"
                class="nav-link {{  $p == 'manageCategories'||
                                    $p == 'addCategory' ||
                                    $path == 'editCategry' ? 'active' : ''
                                }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>مجموعات الاصناف</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('manageItems')}}"
                    class="nav-link {{  $p == 'manageItems'||
                                        $p == 'addItem' ||
                                        $path == 'editItem' ? 'active' : ''
                                    }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>الاصناف</p>
                    </a>
                    </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{url('manageSamples')}}"
            class="nav-link {{  $p == 'manageSamples' ||
                                $p == 'addSample' ||
                                $path == 'editSample' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                ادارة العينات
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('manageCustomers')}}"
            class="nav-link {{  $p == 'manageCustomers' ||
                                $p == 'addCustomer' ||
                                $path == 'editCustomer' ? 'active' : ''  }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                ادارة العملاء
                </p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@endsection
