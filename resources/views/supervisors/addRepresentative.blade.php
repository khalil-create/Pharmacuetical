@extends('layouts.index')
@section('title')
    اضافة مندوب
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
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
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">إضافة مندوب</h3>
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
                    @if (session('error'))
                        <div class="alert alert-danger notify-error">
                            {{ session('error') }}
                        </div>
                    @endif
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <form method="POST" action="{{ url('supervisor/storeRepresentative') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">الاسم</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
                                                @if ($errors->has('usernamethird'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="usersurname" class="form-control" placeholder="اللقب">
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
                            </div>
                            <div class="form-group">
                                <label for="usertype">الصفة الوظيفية </label>
                                    <select onchange="showListInRep()" id="usertype" name="usertype" class="custom-select rounded-0">
                                        <option value="مندوب علمي">
                                            مندوب علمي
                                        </option>
                                        <option value="مدير فريق">
                                            مدير فريق
                                        </option>
                                    </select>
                                    @if ($errors->has('usertype'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('usertype') }}</small>
                                        </span>
                                    @endif
                            </div>
                            @if($isExistTeamLeader)
                                <div class="form-group" id="teemLeadersList">
                                    <label class="col-md-4 control-label">مدير الفريق</label>
                                            <select id="teamleader" name="teemleader_id" class="form-control custom-select rounded-0">
                                                @foreach($rep as $row)
                                                    @if($row->user_type == 'مدير فريق')
                                                        <option value="{{$row->representatives->id}}">
                                                            {{ $row->user_name_third }} {{$row->user_surname}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @if ($errors->has('teemleader_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('teemleader_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="subareasIds" class="col-md-12 control-label">المناطق الفرعية <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من منطقة)</span></label>
                                <select name="subareasIds[]" class="form-control custom-select rounded-0" multiple>
                                    @php
                                        $n = 1;
                                    @endphp
                                    @foreach ($subareas as $row)
                                        <option value="{{$row->id}}">{{$n++}}{{'- '}} {{$row->name_sub_area}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('subareasIds'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('subareasIds') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">الجنس</label>
                                <div class="radiobox">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="ذكر" name="sex" checked>
                                        <label class="form-check-label">ذكر</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" value="انثى">
                                        <label class="form-check-label">انثى</label>
                                    </div>
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
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    اضافة <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6" style="margin-top:20px">
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-7">
                                                <input type="text" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-5">
                                                <input id="phonenumber" type="text" name="phonenumber" class="form-control" placeholder="رقم الهاتف">
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
                            <div class="form-group">
                                <label for="userimage">تحميل الصورة</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="userimage">
                                        <label class="custom-file-label" for="userimage"></label>
                                    </div>
                                </div>
                                @if ($errors->has('userimage'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" name="birthplace" class="form-control" placeholder="المحافظة">
                                                @if ($errors->has('birthplace'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="town" class="form-control" placeholder="المديرية">
                                                @if ($errors->has('town'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="village" class="form-control" placeholder="العزلة">
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
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="birthdate">تأريخ الميلاد</label>
                                    <input type="date" class="form-control" name="birthdate">
                                    @if ($errors->has('birthdate'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                        </span>
                                    @endif
                                </div>
                                {{-- <div class="form-group">
                                    <label for="identitytype">نوع الهوية</label>
                                    <input type="text" class="form-control" name="identitytype">
                                </div>
                                <div class="form-group">
                                    <label for="identitynumber">رقم الهوية</label>
                                    <input type="text" class="form-control" name="identitynumber">
                                </div> --}}
                                <div class="form-group">
                                    <div class="khalil">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">معلومات الهوية</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" name="identitytype" class="form-control" placeholder="نوع الهوية">
                                                    @if ($errors->has('identitytype'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="identitynumber" class="form-control" placeholder="رقم الهوية">
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