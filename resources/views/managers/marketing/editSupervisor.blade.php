@extends('layouts.index')
@section('title')
    تعديل المشرف
@endsection

@section('content')
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- /.content-header -->
    <div>
        <section class="content">
                <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default" style="margin-left: 20px;">
                    <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل بيانات المشرف</h3>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <form action="/supervisorUpdate/{{$user->id}}" class="form" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="card-body">
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
                                </div>
                                <div class="form-group">
                                    <label for="">الجنس</label>
                                    <?php
                                        $sex = 'checked';
                                    ?>
                                    <div class="radiobox">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="ذكر" name="sex" checked>
                                            <label class="form-check-label" 
                                            @if ($user->sex=='ذكر')
                                                {{$sex}}
                                            @endif
                                            >ذكر</label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" value="انثى">
                                        <label class="form-check-label"
                                        @if ($user->sex=='انثى')
                                            {{$sex}}
                                        @endif
                                        >انثى</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
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
                                                    <input id="phonenumber" value="{{$user->phone_number}}" type="text" name="phonenumber" class="form-control" placeholder="رقم الهاتف">
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
                                    </div>
                                </div>
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">كلمة السر</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="password" name="password" class="form-control" placeholder="كلمة السر">
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="التأكيد">
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
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                        تعديل <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                            </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6" style="margin-top:20px">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" value="{{$user->email}}" name="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">رقم الهاتف</label>
                                        <input type="text" class="form-control" value="{{$user->phone_number}}" name="phonenumber">
                                        @if ($errors->has('phonenumber'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('phonenumber') }}</small>
                                            </span>
                                        @endif
                                    </div>
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
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">تأريخ الميلاد</label>
                                        <input type="date" class="form-control" value="{{$user->birthdate}}" name="birthdate">
                                    </div>
                                    <div class="form-group">
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
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                    <label for="town">المديريه</label>
                                    <input type="text" class="form-control" value="{{$user->town}}" name="town">
                                    </div>
                                    <div class="form-group">
                                    <label for="village">العزلة</label>
                                    <input type="text" class="form-control" value="{{$user->village}}" name="village">
                                    </div> --}}
                                    {{-- <div class="form-group margin-top">
                                    <label for="identitytype">نوع الهوية</label>
                                    <input type="text" class="form-control" value="{{$user->identity_type}}" name="identitytype">
                                    </div>
                                    <div class="form-group">
                                        <label for="identitynumber">رقم الهوية</label>
                                        <input type="text" class="form-control" value="{{$user->identity_number}}" name="identitynumber">
                                    </div>
                                </div> --}}
                                <div class="form-group">
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
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </form>
                        <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                    the plugin.
                    </div>
                </div>
                <!-- /.card -->
                </div>
            <!-- /.container-fluid -->
        </section>
    </div>
</div>
@endsection
@section('scripts')
    
@endsection