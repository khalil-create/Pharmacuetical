<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="../assets/css/font-awesome.css" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet" />
  <link href="../assets/css/bootstrap-rtl.min.css" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="wrapper">
    <div>
      {{-- style="text-align: right;margin-left: 1010px;" --}}
      <div class="sidebar" data-color="blue"><!--Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"-->
        <div class="logo">
          <a href="#" class="simple-text logo-mini">
            CT
          </a>
          <a href="#" class="simple-text logo-normal">
            Creative Tim
          </a>
        </div>
        <div class="sidebar-wrapper" id="sidebar-wrapper">
          <ul class="nav">
            @php
              $p = request()->path();
              $path2 = substr($p,0,8);
            @endphp
            <li class="{{ request()->path() == 'displayAllUsers' || $path2 =='editUser' || $path2 =='addUser' ? 'active' : '' }}">
              <a href="{{url('/displayAllUsers')}}">
                <i class="now-ui-icons design_app"></i>
                <p>ادارة الحسابات</p>
              </a>
            </li>
            
            <li class="{{ request()->path() == 'manageAreas'? 'active' : '' }}">
              <a href="{{url('/manageAreas')}}">
                <i class="now-ui-icons education_atom"></i>
                <p>ادارة المناطق</p>
              </a>
            </li>
            <li class="{{ request()->path() == 'displayAllCompanies' ? 'active' : '' }}">
              <a href="./map.html">
                <i class="now-ui-icons location_map-big"></i>
                <p>ادارة الشركات</p>
              </a>
            </li>
            <li class="{{ request()->path() == 'displayAllItems' ? 'active' : '' }}">
              <a href="./notifications.html">
                <i class="now-ui-icons ui-1_bell-53"></i>
                <p>ادارة الاصناف</p>
              </a>
            </li>
            @php
              $path2 = substr($p,0,14);
            @endphp
            <li class="{{ request()->path() == 'manageSupervisor' || $path2 =='editSupervisor' || $path2 == 'addSupervisor' ? 'active' : '' }}">
              <a href="{{url('/manageSupervisor')}}">
                <i class="now-ui-icons users_single-02"></i>
                <p>ادارة المشرفين</p>
              </a>
            </li>
            <li class="{{ request()->path() == 'displayAllRepresentatives' ? 'active' : '' }}">
              <a href="./tables.html">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p>ادارة المندوبين</p>
              </a>
            </li>
            <li>
              <a href="./typography.html">
                <i class="now-ui-icons text_caps-small"></i>
                <p>ادارة العينات </p>
              </a>
            </li>
            <li class="active-pro">
              <a href="./upgrade.html">
                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                <p>Upgrade to PRO</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- <div class="main-panel" id="main-panel"> --}}
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle float-right">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Table List</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class=" navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="بحث">
                <div class="input-group-append" >
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold" ></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block" >Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
          @yield('content')
        
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
          </div>
        </div>
      </footer> 
    </div>



  



  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>

  @yield('scripts')
</body>

</html>