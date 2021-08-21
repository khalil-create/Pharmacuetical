@php use App\Arrays\Arrays; @endphp
@extends('layouts.index')
@section('title')
    ادارة المستخدمين
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة المستخدمين</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/displayAllUsers">ادارة المستخدمين</a></li>
                    <li class="breadcrumb-item active">المستخدمين</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة مستخدم</h3>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <form method="POST" action="{{ url('admin/storeUser') }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body border">
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">الاسم</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <input type="text" value="{{ old('usernamethird') }}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
                                                            @if ($errors->has('usernamethird'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" value="{{ old('usersurname') }}" name="usersurname" class="form-control" placeholder="اللقب">
                                                            @if ($errors->has('usersurname'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            @php
                                                $managerMarketing = true; //manager marketing was added
                                                $managerSales = true; //manager sales was added
                                                foreach ($manager as $m) {
                                                    if($m->user->user_type == 'مدير تسويق')
                                                        $managerMarketing = false; //manager marketing was not added
                                                    else if($m->user->user_type == 'مدير مبيعات')
                                                        $managerSales = false; //manager sales was not added
                                                }
                                            @endphp
                                            <div class="form-group">
                                                <label for="usertype">الصفة الوظيفية</label>
                                                    <select onchange="showList()" id="usertype" name="usertype" class="custom-select rounded-0">
                                                        @if($managerMarketing)
                                                            <option value="مدير تسويق" {{old('usertype') == 'مدير تسويق' ? 'selected':''}}>
                                                                مدير تسويق
                                                            </option>
                                                        @endif
                                                        @if($managerSales)
                                                            <option value="مدير مبيعات" {{old('usertype') == 'مدير مبيعات' ? 'selected':''}}>
                                                                مدير مبيعات
                                                            </option>
                                                        @endif
                                                        <option value="مشرف" {{old('usertype') == 'مشرف' ? 'selected':''}}>
                                                            مشرف
                                                        </option>
                                                        @if(!$managerSales)
                                                        <option value="مندوب مبيعات" {{old('usertype') == 'مندوب مبيعات' ? 'selected':''}}>
                                                            مندوب مبيعات
                                                        </option>
                                                        @endif
                                                        @if($supervisors)
                                                        <option value="مندوب علمي" {{old('usertype') == 'مندوب علمي' ? 'selected':''}}>
                                                            مندوب علمي
                                                        </option>
                                                            <option value="مدير فريق" {{old('usertype') == 'مدير فريق' ? 'selected':''}}>
                                                                مدير فريق
                                                            </option>
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('usertype'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('usertype') }}</small>
                                                        </span>
                                                    @endif
                                            </div>
                                            @if($supervisors->count() > 0)
                                                <div class="form-group" id="supervisor" hidden>
                                                    <label for="supervisor_id" class="col-md-4 control-label">المشرف</label>
                                                            <select id="teemleaders" name="supervisor_id" class="form-control custom-select rounded-0">
                                                                @foreach($supervisors as $row)
                                                                    <option value="{{$row->id}}" {{old('supervisor_id') == $row->id ? 'selected':''}}>{{ $row->user->user_name_third }} {{$row->user->user_surname}}</option>
                                                                @endforeach
                                                            </select>
                                                        @if ($errors->has('supervisor_id'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('supervisor_id') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="">الجنس</label>
                                                <div class="radiobox">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="ذكر" name="sex" checked>
                                                        <label class="form-check-label">ذكر</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sex" value="انثى" {{old('sex') == 'انثى' ? 'checked':''}}>
                                                        <label class="form-check-label">انثى</label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('sex'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('sex') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="userimage">تحميل الصورة</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" value="{{ old('userimage') }}" class="custom-file-input" name="userimage">
                                                        <label class="custom-file-label" for="userimage"></label>
                                                        @if ($errors->has('userimage'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">معلومات الهوية</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" value="{{ old('identitytype') }}" name="identitytype" class="form-control" placeholder="نوع الهوية">
                                                            @if ($errors->has('identitytype'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" value="{{ old('identitynumber') }}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
                                                            @if ($errors->has('identitynumber'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('identitynumber') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <input type="text" value="{{ old('email') }}" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-5">
                                                            <input id="phonenumber" value="{{ old('phone_number') }}" onkeyup="checkPhoneNumber()" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
                                                            <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                            @if ($errors->has('phone_number'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('phone_number') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                        <label class="control-label">المحافظة</label>
                                                        <select name="birthplace" class="form-control custom-select rounded-0">
                                                            @foreach (Arrays::getAllCities() as $city)
                                                                <option value="{{$city}}" {{ old('birthplace') == $city ? 'selected':'' }}>{{$city}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('birthplace'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                            </span>
                                                        @endif
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                        <label class="control-label">المديرية</label>
                                                            <input type="text" value="{{ old('town') }}" name="town" class="form-control" placeholder="المديرية">
                                                            @if ($errors->has('town'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label">العزلة</label>
                                                            <input type="text" value="{{ old('village') }}" name="village" class="form-control" placeholder="العزلة">
                                                            @if ($errors->has('village'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('village') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">تأريخ الميلاد</label>
                                                <input type="date" value="{{ old('birthdate') }}" class="form-control" name="birthdate">
                                                @if ($errors->has('birthdate'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">كلمة السر</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input id="password" value="{{ old('password') }}" type="password" name="password" class="form-control" placeholder="كلمة السر">
                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <input onkeyup="checkPassword()" value="{{ old('password_confirmation') }}" id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="التأكيد">
                                                            <small class="form-text text-danger" id="inalidPasswordConfirmation" hidden>{{'ليست متطابقه'}}</small>
                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                                حفظ<i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.card-body -->
                                </form><!-- /.form -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="footer">

    </div>
</div>
@endsection
<script>
    $(document).ready(function(){
        $('#password_confirmation').keyup(function(){
            var pwd = $('#password').val();
            var cpwd = $('#password_confirmation').val();

            if(cpwd != pwd){
                $('#ShowErrorPwd').html('not matches');
                return false;
            }
            else{
                $('#ShowErrorPwd').html('');
                return true;
            }
        });
    });
</script>