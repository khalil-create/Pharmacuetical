@php
    use App\Traits\userTrait;
    use Carbon\Carbon;
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link"><i class="fas fa-home" title="الصفحة الرئيسية"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link"><i class="fas fa-refresh" title="تحديث"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <li class="nav-item dropdown user-menu">
        @php
            $name = explode(' ',Auth::user()->user_name_third);
        @endphp
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          {{-- <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="user-image img-circle elevation-2" alt="User Image"> --}}
          @if (Auth::user()->user_image)
              <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="user-image img-circle elevation-2" alt="User Image">
          @else
              <img src="{{asset('designImages/user.png')}}" class="user-image img-circle elevation-2" alt="User Image">
          @endif
          <span class="d-none d-md-inline">{{$name[0]}} {{Auth::user()->user_surname}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
              @if (Auth::user()->user_image)
                  <img src="{{asset('images/users/'.Auth::user()->user_image)}}" class="img-circle elevation-2" alt="User Image">
              @else
                  <img src="{{asset('designImages/user.png')}}" class="img-circle elevation-2" alt="User Image">
              @endif
            <p>
              {{$name[0]}} {{Auth::user()->user_surname}} - {{Auth::user()->user_type}}
              <small>عضو في الفريق منذ {{Auth::user()->created_at}}</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            @if(Auth::user()->user_type == 'أدمن')
              <a href="/admin/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @elseif(Auth::user()->user_type == 'مدير تسويق')
              <a href="/managerMarketing/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @elseif(Auth::user()->user_type == 'مدير مبيعات')
              <a href="/manageSales/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @elseif(Auth::user()->user_type == 'مشرف')
              <a href="/supervisor/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @elseif(Auth::user()->user_type == 'مندوب علمي')
              <a href="/representative/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @elseif(Auth::user()->user_type == 'مندوب مبيعات')
              <a href="/representative/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
            @endif
            <a href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          </li>
        </ul>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if(Auth::user()->unreadnotifications->count())
            <span class="badge badge-warning navbar-badge">{{Auth::user()->unreadnotifications->count()}}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
            @if(Auth::user()->unreadnotifications->count())
              {{Auth::user()->unreadnotifications->count()}} اشعار
            @else
              لايوجد لديك اي اشعار
            @endif
          </span>
          <div class="dropdown-divider"></div>
          @php $count = 0; @endphp
          @foreach (Auth::user()->unreadnotifications as $notify)
            @if($count >= 5)
              @break
            @endif
              @php
                  $route = userTrait::getRouteReadNotification($notify->data['title']);
                  $since = userTrait::getSinceTimePast($notify->updated_at);
                  $userType = userTrait::getUserType();
                  $route = $userType.$route;
                  $count++;
              @endphp
              <a href="{{route($route,['id' => $notify->id])}}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i>
                {{-- <div style="overflow-wrap: break-word;height: 100px;">{{$notify->data['content']}}</div> --}}
                {{$notify->data['content']}}
                <p class="text-sm text-muted"><i class="far fa-clock mr-2" style="margin-left: 10px"></i>{{ $since }}</p>
                {{-- <span class="float-right text-muted text-sm"></span> --}}
              </a>
          @endforeach
          <div class="dropdown-divider"></div>
          @if(Auth::user()->unreadnotifications->count())
            <a href="/Notifications/showAllUnReadNotifications" class="dropdown-item dropdown-footer">رؤية كل الاشعارات</a>
            <a href="/Notifications/markAllNotifyAsRead" class="dropdown-item dropdown-footer">Mark all notifications as read</a>
          @endif
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>