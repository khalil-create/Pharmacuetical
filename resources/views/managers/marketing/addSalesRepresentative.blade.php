<<<<<<< HEAD
@php use App\Arrays\Arrays; @endphp
=======
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
@extends('layouts.index')
@section('title')
    ادارة مندوبين المبيعات
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة مندوبين المبيعات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/managerMarketing/manageSalesRepresentatives">ادارة مندوبيين المبيعات</a></li>
                <li class="breadcrumb-item active">مندوبين المبيعات</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة مندوب مبيعات</h3>
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
                        <div class="form-group">
                            <form method="POST" action="{{ url('managerMarketing/storeSalesRepresentative') }}"  enctype="multipart/form-data">
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
<<<<<<< HEAD
                                                        <input type="text" name="usernamethird" value="{{ old('usernamethird') }}" class="form-control" placeholder="الاسم الثلاثي">
=======
                                                        <input type="text" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('usernamethird'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-4">
<<<<<<< HEAD
                                                        <input type="text" name="usersurname" value="{{ old('usersurname') }}" class="form-control" placeholder="اللقب">
=======
                                                        <input type="text" name="usersurname" class="form-control" placeholder="اللقب">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('usersurname'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
<<<<<<< HEAD
                                            </div><!-- /.card-body -->
=======
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label">اختر منطقته الرئيسية</label>
                                            <select name="mainarea_id" class="form-control custom-select rounded-0">
                                                @foreach ($mainareas as $row)
                                                    <option value="{{$row->id}}">{{$row->name_main_area}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('mainarea_id'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('mainarea_id') }}</small>
                                                </span>
                                            @endif
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        </div>
                                        <div class="form-group">
                                            <label for="">الجنس</label>
                                            <div class="radiobox">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="ذكر" name="sex" checked>
                                                    <label class="form-check-label">ذكر</label>
                                                </div>
                                                <div class="form-check">
<<<<<<< HEAD
                                                    <input class="form-check-input" type="radio" name="sex" value="انثى" {{ old('sex') == 'انثى' ? 'checked':''}}>
=======
                                                    <input class="form-check-input" type="radio" name="sex" value="انثى">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                    <label class="form-check-label">انثى</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userimage">تحميل الصورة</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="userimage">
                                                    <label class="custom-file-label" for="userimage"></label>
<<<<<<< HEAD
=======
                                                    @if ($errors->has('userimage'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                        </span>
                                                    @endif
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
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
<<<<<<< HEAD
                                                        <input type="text" name="identitytype" value="{{ old('identitytype') }}" class="form-control" placeholder="نوع الهوية">
=======
                                                        <input type="text" name="identitytype" class="form-control" placeholder="نوع الهوية">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('identitytype'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-6">
<<<<<<< HEAD
                                                        <input type="text" name="identitynumber" value="{{ old('identitynumber') }}" class="form-control" placeholder="رقم الهوية">
=======
                                                        <input type="text" name="identitynumber" class="form-control" placeholder="رقم الهوية">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('identitynumber'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('identitynumber') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
<<<<<<< HEAD
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div><!-- /.col-md -->
=======
                                            </div><!-- /.card-body -->
                                        </div>
                                    </div><!-- /.col-md-6  -->
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                    <div class="col-md-6">
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-7">
<<<<<<< HEAD
                                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control"  placeholder="البريد الإلكتروني">
=======
                                                        <input type="text" name="email" class="form-control" placeholder="البريد الإلكتروني">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                            </span>
                                                        @endif
<<<<<<< HEAD
                                                    </div>
                                                    <div class="col-5">
                                                        <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{ old('phone_number') }}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
=======
                                                        @isset($error)
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $error }}</small>
                                                            </span>
                                                        @endisset
                                                    </div>
                                                    <div class="col-5">
                                                        <input id="phonenumber"  onkeyup="checkPhoneNumber()" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                        @if ($errors->has('phone_number'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('phone_number') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
<<<<<<< HEAD
                                            </div>
                                            <!-- /.card-body -->
=======
                                            </div><!-- /.card-body -->
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        </div>
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
<<<<<<< HEAD
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
=======
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
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('town'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
<<<<<<< HEAD
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">العزلة</label>
                                                        <input type="text" value="{{ old('village') }}" name="village" class="form-control" placeholder="العزلة">
=======
                                                    <div class="col-4">
                                                        <input type="text" name="village" class="form-control" placeholder="العزلة">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('village'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('village') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
<<<<<<< HEAD
                                            </div><!-- /.card-body -->
                                        </div>
                                        <div class="form-group">
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
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font">
                                                حفظ<i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
=======
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdate">تأريخ الميلاد</label>
                                            <input type="date" class="form-control" name="birthdate">
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
                                            </div><!-- /.card-body -->
                                        </div>
                                    </div><!-- /.col-md-6  -->
                                    <div class="col-md-8">
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font"">
                                                حفظ <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.col-md-8  -->
                                            </div><!-- /.card-body  -->
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                            </form><!-- /.form -->
                        </div><!-- /.form-group -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
    Footer
    </div>
</div><!-- /.content-header -->
@endsection
@section('scripts')
    
@endsection