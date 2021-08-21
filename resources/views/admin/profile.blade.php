@extends('layouts.index')
@section('title')
    البروفايل
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper content-header">
    <!-- Content Header (Page header) -->
    <div class="">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>البروفايل</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="/admin/profile/{{Auth::user()->id}}">البروفايل الشخصي</a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <span class="card-title" style="float: right">بروفايلي</span>
            <div class="card-tools float-right">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <!-- Profile Image -->
                <div class="card card-widget widget-user">
                  <div class="widget-user-header bg-info">
                    @php $username = explode(' ',$user->user_name_third); @endphp
                    <h3 class="widget-user-username">{{$username[0]}} {{$user->user_surname}}</h3>
                    <h5 class="widget-user-desc">{{$user->user_type}}</h5>
                  </div>
                  <div class="widget-user-image text-center">
                    <img class="img-circle elevation-2 "
                    @if(Auth::user()->user_image)
                        src="{{asset('images/users/'.$user->user_image)}}"
                    @else
                        src="{{asset('designImages/user.png')}}"
                    @endif>
                  </div>
                  <div class="card-footer">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                          <b>المستخدمين</b> <a class="float-right">{{App\Models\User::all()->count()}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>المندوبيين</b> <a class="float-right">{{App\Models\Representative::all()->count()}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>العملاء</b> <a class="float-right">{{App\Models\Customer::where('statues',true)->get()->count()+App\Models\Doctor::where('statues',true)->get()->count()}}</a>
                      </li>
                      <li class="list-group-item">
                          <b>الشركات</b> <a class="float-right">{{App\Models\Company::all()->count()}}</a>
                      </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>{{$user->user_name_third}} {{$user->user_surname}}</b></a>
                  </div><!-- /.card-footer -->
                </div><!-- /.card -->
              </div>
              <div class="col-md-6">
                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div> <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> مكان وتأريخ الميلاد</strong>
                    <p class="text-muted">
                      {{$user->birthplace}} - {{$user->town}} - {{$user->village}} - {{$user->birthdate}}
                    </p>
                    
                    <hr>
                    <strong><i class="fas fa-male mr-1"></i> الجنس</strong>
                    <p class="text-muted">{{$user->sex}}</p>
                    
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> البريد الالكتروني</strong>
                    <p class="text-muted">{{$user->email}}</p>

                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> رقم الهاتف</strong>
                    <p class="text-muted">{{$user->phone_number}}</p>

                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i>الهوية</strong>
                    <p class="text-muted">{{$user->identity_type}}: {{$user->identity_number}}</p>
                  </div><!-- /.card-body -->
                </div><!-- /.card -->
              </div><!-- /.col -->
{{--
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تعديل البيانات </a></li>
                    </ul>
                  </div><!-- /.card-header -->

                  <div class="card-body">
                    <div class="tab-content">
                      {{-- <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                              <a href="#">Jonathan Burke Jr.</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                          </div>
                          <!-- /.user-block -->
                          <p>
                            Lorem ipsum represents a long-held tradition for designers,
                            typographers and the like. Some people hate it and argue for
                            its demise, but others ignore the hate as they create awesome
                            tools to help create filler text for everyone from bacon lovers
                            to Charlie Sheen fans.
                          </p>

                          <p>
                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                            <span class="float-right">
                              <a href="#" class="link-black text-sm">
                                <i class="far fa-comments mr-1"></i> Comments (5)
                              </a>
                            </span>
                          </p>

                          <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->

                      </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                          <!-- timeline time label -->
                          <div class="time-label">
                            <span class="bg-danger">
                              10 Feb. 2014
                            </span>
                          </div>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-primary"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 12:05</span>

                              <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                              <div class="timeline-body">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                quora plaxo ideeli hulu weebly balihoo...
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-user bg-info"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                              <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                              </h3>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-comments bg-warning"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                              <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                              <div class="timeline-body">
                                Take me to your leader!
                                Switzerland is small and neutral!
                                We are more like Germany, ambitious and misunderstood!
                              </div>
                              <div class="timeline-footer">
                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <!-- timeline time label -->
                          <div class="time-label">
                            <span class="bg-success">
                              3 Jan. 2014
                            </span>
                          </div>
                          <!-- /.timeline-label -->
                          <!-- timeline item -->
                          <div>
                            <i class="fas fa-camera bg-purple"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                              <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                              <div class="timeline-body">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                                <img src="https://placehold.it/150x100" alt="...">
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->
                          <div>
                            <i class="far fa-clock bg-gray"></i>
                          </div>
                        </div>
                      </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="settings">
                        <div class="row">
                            <div class="form-group">
                              <form action="/admin/profileUpdate/{{$user->id}}" class="form" method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  {{method_field('PUT')}}
                                  <div class="col-md-6">
                                      <div class="khalil">
                                          <div class="card-header">
                                              <h3 class="card-title" style="float: right">الاسم</h3>
                                          </div>
                                          <div class="card-body">
                                              <div class="row">
                                                  <div class="col-8">
                                                      <input type="text" value="{{$user->user_name_third}}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
                                                      @if ($errors->has('usernamethird'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                                  <div class="col-4">
                                                      <input type="text" value="{{$user->user_surname}}" name="usersurname" class="form-control" placeholder="اللقب">
                                                      @if ($errors->has('usersurname'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- /.card-body -->
                                      </div><br>
                                      <div class="form-group">
                                          <label for="">الجنس</label>
                                          <?php
                                              $male = '';
                                              $female = '';
                                              if($user->sex == 'ذكر') $male = 'checked';
                                              else $female = 'checked';
                                          ?>
                                          <div class="radiobox">
                                              <div class="form-check">
                                                  <input class="form-check-input" type="radio" {{$male}} value="ذكر" name="sex">
                                                  <label class="form-check-label">ذكر</label>
                                              </div>
                                              <div class="form-check">
                                              <input class="form-check-input" type="radio" {{$female}} name="sex" value="انثى">
                                              <label class="form-check-label"> {{$female}}انثى</label>
                                              </div>
                                          </div>
                                      </div><br>
                                      <div class="form-group">
                                          <label for="userimage">تحميل الصورة</label>
                                          <div class="input-group">
                                              <div class="custom-file">
                                                  <input type="file" class="custom-file-input" value="{{asset('images/users/'.$user->user_image)}}" name="userimage">
                                                  <label class="custom-file-label" for="userimage"></label>
                                                  @if ($errors->has('userimage'))
                                                      <span class="help-block">
                                                          <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                      </span>
                                                  @endif
                                              </div>
                                          </div>
                                      </div><br>
                                      <div class="khalil">
                                          <div class="card-header">
                                              <h3 class="card-title" style="float: right">كلمة السر</h3>
                                          </div>
                                          <div class="card-body">
                                              <div class="row">
                                                  <div class="col-6">
                                                      <input id="password" type="password" name="password" class="form-control" placeholder="كلمة السر">
                                                      @if ($errors->has('password'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                                  <div class="col-6">
                                                      <input onkeyup="checkPassword()" id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="التأكيد">
                                                      <small class="form-text text-danger" id="inalidPasswordConfirmation" hidden>{{'ليست متطابقه'}}</small>
                                                      @if ($errors->has('password_confirmation'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- /.card-body -->
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="khalil">
                                          <div class="card-header">
                                              <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                          </div>
                                          <div class="card-body">
                                              <div class="row">
                                                  <div class="col-4">
                                                      <input type="text" value="{{$user->birthplace}}" name="birthplace" class="form-control" placeholder="المحافظة">
                                                      @if ($errors->has('birthplace'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                                  <div class="col-4">
                                                      <input type="text" value="{{$user->town}}" name="town" class="form-control" placeholder="المديرية">
                                                      @if ($errors->has('town'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                                  <div class="col-4">
                                                      <input type="text" value="{{$user->village}}" name="village" class="form-control" placeholder="العزلة">
                                                      @if ($errors->has('village'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('village') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- /.card-body -->
                                      </div><br>
                                      <div class="form-group">
                                          <label for="birthdate">تأريخ الميلاد</label>
                                          <input type="date" class="form-control" value="{{$user->birthdate}}" name="birthdate">
                                          @if ($errors->has('birthdate'))
                                              <span class="help-block">
                                                  <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                              </span>
                                          @endif
                                      </div>
                                      <div class="khalil">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-7">
                                                    <input type="text" value="{{$user->email}}" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-5">
                                                    <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{$user->phone_number}}" type="text" name="phonenumber" class="form-control" placeholder="رقم الهاتف">
                                                    <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                    @if ($errors->has('phonenumber'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('phonenumber') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                      </div><br>
                                      <div class="khalil">
                                          <div class="card-header">
                                              <h3 class="card-title" style="float: right">معلومات الهوية</h3>
                                          </div>
                                          <div class="card-body">
                                              <div class="row">
                                                  <div class="col-6">
                                                      <input type="text" value="{{$user->identity_type}}" name="identitytype" class="form-control" placeholder="نوع الهوية">
                                                      @if ($errors->has('identitytype'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                                  <div class="col-6">
                                                      <input type="text" value="{{$user->identity_number}}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
                                                      @if ($errors->has('identitynumber'))
                                                          <span class="help-block">
                                                              <small class="form-text text-danger">{{ $errors->first('identitynumber') }}</small>
                                                          </span>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- /.card-body -->
                                      </div><br>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group" >
                                          <button type="submit" class="btn btn-primary font">
                                              تعديل <i class="fas fa-edit"></i>
                                          </button>
                                      </div>
                                  </div>
                              </form>
                            </div><!-- /.form-group -->
                        </div><!-- /.row -->
                      </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                  </div><!-- /.card-body -->

                </div><!-- /.card -->
              </div> <!-- /.col -->
--}}
            </div><!-- /.row -->
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection
@section('script')
@endsection
